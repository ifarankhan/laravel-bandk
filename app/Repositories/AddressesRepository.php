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
}