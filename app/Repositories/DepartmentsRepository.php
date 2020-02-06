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

    public function search($search)
    {
        //dd($search);
        $query = $this->model;
        if(session('customer_id')) {
            $query = $query->where('customer_id', session('customer_id'));
        }
        if(isset($search['company_id']) && !empty($search['company_id'])) {
            $query = $query->where('company_id', $search['company_id']);
        }
        if(isset($search['department_id']) && !empty($search['department_id'])) {
            $query = $query->where('id', $search['department_id']);
        }

        $departments = $query->whereNull('deleted_at')->orderBy('name', 'ASC')->get();
        $newDepartments = [];
        if(count($departments) > 0) {
            foreach ($departments as $department) {
                $newDepartments[] = $department;
            }
            usort($newDepartments, 'sortMyArray');
        }

        return $newDepartments;
    }

    public function all()
    {
        $query = $this->model;
        $roles = getUserRoles(\Auth::user());
        if(in_array('AGENT', $roles) && \Auth::user()->customer) {
            if(\Auth::user()->departments) {
                $query = $query->whereIn('id', json_decode(\Auth::user()->departments));
            } else {
                $query = $query->where('customer_id', \Auth::user()->customer->id);
            }
        }
        $departments = $query->whereNull('deleted_at')->with(['addresses'])->orderBy('name', 'ASC')->get(['id', 'name', 'code']);
        $newDepartments = [];
        if(count($departments) > 0) {
            foreach ($departments as $department) {
                $newDepartments[] = $department;
            }
            usort($newDepartments, 'sortMyArray');
        }

        return $newDepartments;
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
        $this->model->team_id = $data['team_id'];
        if( isset($data['policy_number']) ) {
            $this->model->policy_number = $data['policy_number'];
        }

        $this->model->customer_id = $data['customer_id'];
        $this->model->company_id = $data['company_id'];

        $this->model->save();

        if(count($data['addresses']) > 0) {
            foreach ($data['addresses'] as $key => $address) {
                $addressObj = null;
                $addressObj = $this->addresses->getAddressByIdDepartmentId($key, $this->model->id);
                if($addressObj) {
                    if(empty(trim($address['address'])) && empty(trim($address['zip_code'])) && empty(trim($address['city'])) && empty(trim($address['build_year'])) && empty(trim($address['m2']))) {
                        $addressObj->delete();
                    } else {
                        $addressObj->address     = isset($address['address']) ? $address['address'] : '';
                        $addressObj->zip_code    = isset($address['zip_code']) ? $address['zip_code'] : null;
                        $addressObj->city        = isset($address['city']) ? $address['city'] : null;
                        $addressObj->build_year  = isset($address['build_year']) ? $address['build_year'] : null;
                        $addressObj->m2          = isset($address['m2']) ? $address['m2'] : null;
                        $addressObj->save();
                    }

                } else {
                    if(!empty(trim($address['address'])) || !empty(trim($address['zip_code'])) || !empty(trim($address['city'])) || !empty(trim($address['build_year'])) || !empty(trim($address['m2']))) {
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
        }
        return $this->model;

    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }

    public function getCustomerDepartment($customer_id)
    {
        $departments = $this->model->where('customer_id', $customer_id)->orderBy('name', 'ASC')->get();

        if(count($departments) > 0 ) {
            return $departments;
        }
        return [];
    }
    public function getCompanyDepartment($companyId)
    {
        $ids = explode(',', $companyId);
        $departments = $this->model->whereIn('company_id', $ids)->orderBy('name', 'ASC')->get();
        if(count($departments) > 0 ) {
            return $departments;
        }
        return [];
    }
    public function getCompanyAssignedDepartments($companyId)
    {
        $roles = \Auth::user()->roles;
        $isAdmin = false;

        foreach ($roles as $role) {
            if($role->name == 'ADMIN') {
                $isAdmin = true;
            }
        }
        $userDepartments = (\Auth::user()->departments) ? json_decode((\Auth::user()->departments)) : [];
        $ids = explode(',', $companyId);
        $departments = $this->model->whereIn('company_id', $ids)->orderBy('name', 'ASC')->get();
        $userDepartmentsArray = [];
        if(count($departments) > 0 && !$isAdmin) {
            foreach ($departments as $k => $department) {
                if(in_array($department->id, $userDepartments)) {
                    $userDepartmentsArray[] = $department;
                }
            }
            usort($userDepartmentsArray, 'sortMyArray');
        } else {
            foreach ($departments as $k => $department) {
                $userDepartmentsArray[] = $department;
            }
            usort($userDepartmentsArray, 'sortMyArray');
        }
        return $userDepartmentsArray;
    }


}