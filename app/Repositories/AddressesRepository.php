<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 12:14 AM
 */

namespace App\Repositories;


use App\Addresses;

class AddressesRepository implements AddressesInterface
{
    /**
     * @var Addresses
     */
    private $model;

    /**
     * AddressesRepository constructor.
     * @param Addresses $addresses
     */
    public function __construct(Addresses $addresses)
    {
        $this->model = $addresses;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getAddressByDepartmentWise()
    {
        $addresses = $this->all();
        $data = [];
        foreach ($addresses as $address) {
            $data[$address->department_id][$address->id]['address_1'] = $address->address_1;
            $data[$address->department_id][$address->id]['address_2'] = json_decode($address->address_2);
            $data[$address->department_id][$address->id]['postal_no'] = $address->postal_no;
        }

        return $data;
    }
}