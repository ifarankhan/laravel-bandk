<?php

/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 12:04 AM
 */
namespace App\Repositories;

use App\Modules;

class ModulesRepository implements ModulesInterface
{
    /**
     * @var Roles
     */
    private $model;



    public function __construct(Modules $modules)
    {
        $this->model = $modules;
    }

    public function all()
    {
        return $this->model->orderBy('name', 'ASC')->get();
    }

}