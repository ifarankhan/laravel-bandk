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
        return $this->model->with(['conversations', 'conversations.files', 'customer'])->find($id);
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
    public function allCount($user = null)
    {
        return $this->model->count();
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
        return $query->get();
    }
    public function createClaim($data)
    {
        $data['user_id'] = \Auth::user()->id;
        $date = null;
        if(isset($data['date']) && isset($date['from_web'])) {
            $date = str_replace('/', '-', $data['date']);
            $date = date('Y-m-d', strtotime($date));
        } elseif (isset($data['date']) && !isset($date['from_web'])) {
            $data['date'] = date('Y-m-d', $data['date']);
        }
        $data['date'] = $date;
        $data['customer_id'] = \Auth::user()->customer_id;
        $claim = $this->model->create($data);

        if(isset($data['images']) && count($data['images']) > 0) {
            foreach ($data['images'] as $image) {
                $this->claimImages = new ClaimImages();
                $uniqueFileName = uniqid() . $image->getClientOriginalName();
                $image->move(config('app.path_to_upload') , $uniqueFileName);
                $this->claimImages->image = $uniqueFileName;
                $this->claimImages->claim_id = $claim->id;
                $this->claimImages->save();
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
}