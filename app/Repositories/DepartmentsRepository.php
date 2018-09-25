<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 12:11 AM
 */

namespace App\Repositories;


use App\Addresses;
use App\Departments;

class DepartmentsRepository implements DepartmentsInterface
{
    /**
     * @var Departments
     */
    private $model;
    /**
     * @var AddressesInterface
     */
    private $addresses;

    /**
     * DepartmentsRepository constructor.
     * @param Departments $departments
     * @param AddressesInterface $addresses
     */
    public function __construct(Departments $departments, AddressesInterface $addresses)
    {

        $this->model = $departments;
        $this->addresses = $addresses;
    }

    public function all()
    {
        $query = $this->model;
        $roles = getUserRoles(\Auth::user());
        if(in_array('AGENT', $roles) && \Auth::user()->customer) {
            $query = $query->where('customer_id', \Auth::user()->customer->id);
        }
        return $query->with(['addresses'])->get(['id', 'name', 'code']);
    }

    public function getOne($id)
    {
        return $this->model->with(['addresses'])->find($id);
    }

    public function store($data)
    {
        if(isset($data['id'])) {
            $this->model = $this->model->find($data['id']);
        }

        $this->model->name = $data['name'];
        $this->model->code = $data['code'];
        $this->model->customer_id = $data['customer_id'];

        $this->model->save();

        if(count($data['addresses']) > 0) {
            foreach ($data['addresses'] as $key => $address) {
                $addressObj = null;
                $addressObj = $this->addresses->getAddressByIdDepartmentId($key, $this->model->id);
                if($addressObj) {
                    $addressObj->address     = isset($address['address']) ? $address['address'] : '';
                    $addressObj->zip_code    = isset($address['zip_code']) ? $address['zip_code'] : null;
                    $addressObj->city        = isset($address['city']) ? $address['city'] : null;
                    $addressObj->build_year  = isset($address['build_year']) ? $address['build_year'] : null;
                    $addressObj->m2          = isset($address['m2']) ? $address['m2'] : null;
                    $addressObj->save();
                } else {
                    $add = new Addresses();
                    $add->address     = isset($address['address']) ? $address['address'] : '';
                    $add->zip_code    = isset($address['zip_code']) ? $address['zip_code'] : null;
                    $add->city        = isset($address['city']) ? $address['city'] : null;
                    $add->build_year  = isset($address['build_year']) ? $address['build_year'] : null;
                    $add->m2          = isset($address['m2']) ? $address['m2'] : null;
                    $add->department_id = $this->model->id;
                    $add->save();
                }
            }
        }
        return $this->model;

    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }

    public function getCustomerDepartment($customer_id)
    {
        $departments = $this->model->where('customer_id', $customer_id)->get();

        if(count($departments) > 0 ) {
            return $departments;
        }
        return [];
    }
}