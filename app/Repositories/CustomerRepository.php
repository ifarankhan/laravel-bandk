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
        return $this->model->get();
    }
    public function allCount()
    {
        return $this->model->count();
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
        if(isset($data['id'])) {
            $this->model = $this->model->find($data['id']);
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
        $this->model->emails = isset($data['emails']) ? json_encode($data['emails']) : null;

        $this->model->save();

        return $this->model;

    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }
}