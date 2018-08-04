<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 12:08 AM
 */

namespace App\Repositories;


use App\ClaimMechanics;

class ClaimMechanicsRepository implements ClaimMechanicsInterface
{
    /**
     * @var ClaimMechanics
     */
    private $model;

    /**
     * ClaimMechanicsRepository constructor.
     * @param ClaimMechanics $claimMechanics
     */
    public function __construct(ClaimMechanics $claimMechanics)
    {

        $this->model = $claimMechanics;
    }

    public function all()
    {
        return $this->model->orderBy('name', 'ASC')->get(['id', 'name']);
    }

}