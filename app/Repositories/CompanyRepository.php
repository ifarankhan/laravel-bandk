<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\Company;
use function foo\func;
use Illuminate\Support\Collection;

class CompanyRepository implements CompanyInterface
{
    private $model;

    public function __construct(Company $customer)
    {
        $this->model = $customer;
    }

    public function all()
    {
        return $this->model->get();
    }
    public function search($search)
    {
        $query = $this->model;
        if(session('customer_id')) {
            $query = $query->where('customer_id', session('customer_id'));
        }
        return $query->get();
    }
    public function allCount()
    {
        return $this->model->count();
    }

    public function getOne($id)
    {
        return $this->model->with(['customer'])->find($id);
    }

    public function getUserCompanyData($companies)
    {
        $userDepartments = (\Auth::user()->departments) ? json_decode((\Auth::user()->departments)) : [];
        $companiesIds = $companies->pluck('company_id')->toArray();

        $companies = $this->model->whereIn('id', $companiesIds)->with(['departments'])->get();

        if(count($companies) > 0) {
            foreach ($companies as $key => $company) {
                $userDepartmentsArray = [];
                if(count($company->departments) > 0) {
                    foreach ($company->departments as $k => $department) {
                        if(in_array($department->id, $userDepartments)) {
                            $userDepartmentsArray[] = $department;
                        }
                    }
                    usort($userDepartmentsArray, 'sortMyArray');
                    /*foreach ($userDepartmentsArray as $key => $dep) {
                        $userDepartmentsArray[$key]['order'] = $key + 1;
                    }*/
                    $collect = collect($userDepartmentsArray);

                    unset($companies[$key]->departments);
                    $companies[$key]->departments = $collect;
                }

            }
        }

        return $companies;
    }

    public function customerCompany($customer_id)
    {
        $companies = $this->model->where('customer_id', $customer_id)->orderBy('name', 'ASC')->get();

        if(count($companies) > 0 ) {
            return $companies;
        }
        return [];
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
        $this->model->customer_id = isset($data['customer_id']) ? $data['customer_id'] : null;
        $this->model->emails = (count($emails) > 0) ? json_encode($emails) : null;
        $this->model->is_send_email = isset($data['is_send_email']) ? true : false;

        $this->model->save();

        return $this->model;

    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }
}