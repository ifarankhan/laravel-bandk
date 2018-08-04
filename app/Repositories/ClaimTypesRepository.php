<?php

/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 12:04 AM
 */
namespace App\Repositories;

use App\ClaimTypes;

class ClaimTypesRepository implements ClaimTypesInterface
{
    /**
     * @var ClaimTypes
     */
    private $model;

    /**
     * ClaimTypesRepository constructor.
     * @param ClaimTypes $claimTypes
     */
    public function __construct(ClaimTypes $claimTypes)
    {
        $this->model = $claimTypes;
    }

    public function all()
    {
        return $this->model->orderBy('name', 'ASC')->get(['id', 'name']);
    }

}