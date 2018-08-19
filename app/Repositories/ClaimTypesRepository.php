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
    public function getOne($id)
    {
        return $this->model->find($id);
    }
    public function all()
    {
        return $this->model->orderBy('name', 'ASC')->get(['id', 'name']);
    }

    public function store($data)
    {
        if(isset($data['id'])) {
            $this->model = $this->model->find($data['id']);
        }

        $this->model->name = $data['name'];

        $this->model->save();

        return $this->model;

    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }

}