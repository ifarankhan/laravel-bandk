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
        return $this->model->with(['addresses', 'addresses.subAddress'])->get(['id', 'name', 'code']);
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

        $this->model->save();

        if(count($data['addresses']) > 0) {
            foreach ($data['addresses'] as $key => $address) {
                $addressObj = null;
                if(trim($address) != '') {
                    $addressObj = $this->addresses->getAddressByIdDepartmentId($key, $this->model->id);
                    if($addressObj) {
                        $addressObj->address = $address;
                        $addressObj->save();
                    } else {
                        $add = new Addresses();
                        $add->address = $address;
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
}