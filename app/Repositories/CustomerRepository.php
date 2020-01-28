<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\Customer;

class CustomerRepository implements CustomerInterface
{
    private $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function all()
    {
        $query = $this->model;
        if(isset($search['customer_id'])) {
            $query = $query->where('id', $search['customer_id']);
        }
        $customers = $query->whereNull('deleted_at')->orderBy('name', 'ASC')->get();
        return $customers;
    }
    public function search($search)
    {
        $query = $this->model;
        if(session('customer_id')) {
            $query = $query->where('id', session('customer_id'));
        }
        $customers = $query->whereNull('deleted_at')->orderBy('name', 'ASC')->get();
        return $customers;
    }
    public function allCount($search = [])
    {
        $query = $this->model;
        if(isset($search['customer_id'])) {
            $query = $query->where('id', $search['customer_id']);
        }

        return $query->count();
    }

    public function getOne($id)
    {
        return $this->model->with(['claims'])->find($id);
    }
    public function getFirst()
    {
        return $this->model->first();
    }

    public function store($data)
    {
        $emails = [];
        if(isset($data['id'])) {
            $this->model = $this->model->find($data['id']);
        }
        if(count($data['emails']) > 0) {
            foreach ($data['emails'] as $email) {
                if(!empty($email)) {
                    $emails[] = $email;
                }
            }
        }


        $this->model->name = isset($data['name']) ? $data['name'] : null;
        $this->model->address = isset($data['address']) ? $data['address'] : null;
        $this->model->city = isset($data['city']) ? $data['city'] : null;
        $this->model->zip_code = isset($data['zip_code']) ? $data['zip_code'] : null;
        $this->model->contact_person = isset($data['contact_person']) ? $data['contact_person'] : null;
        $this->model->bank_number = isset($data['bank_number']) ? $data['bank_number'] : null;
        $this->model->account_number = isset($data['account_number']) ? $data['account_number'] : null;
        $this->model->insurance_company_name = isset($data['insurance_company_name']) ? $data['insurance_company_name'] : null;
        $this->model->policy_number = isset($data['policy_number']) ? $data['policy_number'] : null;
        $this->model->insurance_number = isset($data['insurance_number']) ? $data['insurance_number'] : null;
        $this->model->bnk_insurance_number = isset($data['bnk_insurance_number']) ? $data['bnk_insurance_number'] : null;
        $this->model->emails = (count($emails) > 0) ? json_encode($emails) : null;
        $this->model->is_send_email = isset($data['is_send_email']) ? true : false;
        $this->model->shared_link = (isset($data['shared_link']) && !empty($data['shared_link'])) ? $data['shared_link'] : null;

        if(isset($data['logo'])) {
            $uniqueFileName = uniqid() . $data['logo']->getClientOriginalName();//.'.'.$image->getClientOriginalExtension();
            $data['logo']->move(config('app.path_to_upload').'/icons/' , $uniqueFileName);

            $this->model->logo = $uniqueFileName;
        }

        $this->model->save();

        return $this->model;

    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }
}