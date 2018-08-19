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