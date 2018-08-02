<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 12:11 AM
 */

namespace App\Repositories;


use App\Departments;

class DepartmentsRepository implements DepartmentsInterface
{
    /**
     * @var Departments
     */
    private $model;

    /**
     * DepartmentsRepository constructor.
     * @param Departments $departments
     */
    public function __construct(Departments $departments)
    {

        $this->model = $departments;
    }

    public function all()
    {
        return $this->model->with(['addresses', 'addresses.subAddresses'])->get(['id', 'name', 'code']);
    }
}