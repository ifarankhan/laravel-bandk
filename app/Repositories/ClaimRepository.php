<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\ClaimImages;
use App\Claims;
use App\Events\SendEmailToCustomerUsers;

class ClaimRepository implements ClaimInterface
{
    /**
     * @var Claims
     */
    private $model;
    /**
     * @var ClaimImages
     */
    private $claimImages;

    /**
     * ClaimRepository constructor.
     * @param Claims $claims
     * @param ClaimImages $claimImages
     */
    public function __construct(Claims $claims, ClaimImages $claimImages)
    {
        $this->model = $claims;
        $this->claimImages = $claimImages;
    }

    public function getOne($id)
    {
        return $this->model->with(['conversations', 'conversations.files', 'customer', 'images', 'type', 'department', 'address1', 'mechanicsType'])->find($id);
    }

    public function search($search)
    {
        $userRoles = (\Auth::user()->roles) ? \Auth::user()->roles->pluck('name')->toArray() : [];
        $query = $this->model;
        if($search && isset($search['claim_type_id'])) {
            $query = $query->where('claim_type_id', $search['claim_type_id']);
        }
        if($search && isset($search['department_id'])) {
            $query = $query->where('department_id', $search['department_id']);
        }
        if($search && isset($search['customer_id'])) {
            $query = $query->where('customer_id', $search['customer_id']);
        }
        if($search && isset($search['user_id'])) {
            $query = $query->where('user_id', $search['user_id']);
        }
        if($search && isset($search['date'])) {
            $query = $query->where('created_at','>=', date('Y-m-d 00:00:00',strtotime($search['date'])))->where('created_at', '<=', date('Y-m-d 23:59:00',strtotime($search['date'])));
        }

        if(in_array('AGENT', $userRoles)) {

            if(\Auth::user()->customer) {
                $query = $query->where('customer_id', \Auth::user()->customer->id);
            }

        }

        return $query->orderBy('created_at', 'DESC')->get();

    }
    public function all($user = null)
    {
        return $this->model->all();
    }
    public function openClaimsOfUser($userId)
    {
        return $this->model->with(['conversations', 'conversations.files', 'customer', 'images', 'type', 'department', 'address1', 'mechanicsType'])->where('user_id' ,$userId)->where('status','OPEN')->get();
    }
    public function allCount($user = null)
    {
        return $this->model->count();
    }

    public function otherFields($data)
    {

        $claim = $this->getOne($data['id']);

        if(isset($data['rekv_nummer'])) {
            $claim->rekv_nummer = $data['rekv_nummer'];
        } if(isset($data['selsskab_skade_nummer'])) {
            $claim->selsskab_skade_nummer = $data['selsskab_skade_nummer'];
        } if(isset($data['estimate'])) {
            $claim->estimate = $data['estimate'];
        }if(isset($data['status'])) {
            $claim->status = $data['status'];
        }

        return $claim->save();
    }

    public function todayClaimsQuery()
    {
        return $this->model->where('created_at','>=' ,date('Y-m-d'));
    }
    public function todayCount($user = null)
    {
        $query = $this->todayClaimsQuery();
        return $query->count();
    }
    public function todayClaims($user = null)
    {
        $query = $this->todayClaimsQuery();
        return $query->orderBy('id', 'DESC')->get();
    }
    public function createClaim($data)
    {
        $data['user_id'] = \Auth::user()->id;
        if(isset($data['claim_mechanic_id']) && $data['claim_mechanic_id'] == '-1') {
            $data['claim_mechanic_id'] = null;
        }
        $date = null;
        if(isset($data['date']) && isset($data['from_web'])) {
            $date = str_replace('/', '-', $data['date']);
            $date = date('Y-m-d', strtotime($date));
        } elseif (isset($data['date']) && !isset($data['from_web'])) {
            $date = date('Y-m-d', $data['date']);
        }
        $data['date'] = $date;
        if(!isset($data['customer_id'])) {
            $data['customer_id'] = \Auth::user()->customer_id;
        }

        if(isset($data['id'])) {
            $claim = $this->getOne($data['id']);
            if($claim) {
                $claim->update($data);
            }

        } else {
            $claim = $this->model->create($data);
        }


        if(isset($data['images']) && count($data['images']) > 0) {
            foreach ($data['images'] as $image) {
                $this->claimImages = new ClaimImages();
                $uniqueFileName = uniqid() . $image->getClientOriginalName();//.'.'.$image->getClientOriginalExtension();
                $image->move(config('app.path_to_upload') , $uniqueFileName);
                $this->claimImages->image = $uniqueFileName;
                $this->claimImages->claim_id = $claim->id;
                $this->claimImages->save();
            }
        }

        if(!isset($data['from_web']) && isset($data['deleted_image_ids']) && strlen($data['deleted_image_ids']) > 0) {
            $data['deleted_image_ids'] = trime($data['deleted_image_ids']);
            $deleted_image_ids = explode(',', $data['deleted_image_ids']);
            $image = $this->deleteImageBulk($deleted_image_ids);
        }
        $customer = ($claim->customer) ? $claim->customer : null;

        if(!is_null($customer) && !empty($customer->emails)) {
            $emails = json_decode($customer->emails, true);

            foreach ($emails as $email) {
                if($email && $email != '') {
                    event(new SendEmailToCustomerUsers($customer, $claim, $email));
                }
            }
        }

        return $claim;
    }

    function updateStatus($data)
    {
        $claim = $this->getOne($data['id']);
        $claim->status = $data['status'];
        return $claim->save();
    }

    public function deleteImage($id)
    {
        $image = ClaimImages::find($id);
        if($image) {
            return $image->delete();
        }
        return false;

    }
    public function deleteImageBulk($ids)
    {
        return ClaimImages::destroy($ids);
    }
}