<?php

/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 12:04 AM
 */
namespace App\Repositories;

use App\Roles;

class RolesRepository implements RolesInterface
{
    /**
     * @var Roles
     */
    private $model;


    /**
     * RolesRepository constructor.
     * @param Roles $roles
     */
    public function __construct(Roles $roles)
    {
        $this->model = $roles;
    }

    public function all()
    {
        return $this->model->orderBy('name', 'ASC')->get();
    }

}