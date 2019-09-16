<?php

/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 12:04 AM
 */
namespace App\Repositories;

use App\Team;

class TeamsRepository implements TeamsInterface
{
    /**
     * @var Team
     */
    private $model;


    /**
     * TeamsRepository constructor.
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->model = $team;
    }
    public function getOne($id)
    {
        return $this->model->find($id);
    }

    public function search($search)
    {
        $query = $this->model;
        if(isset($search['customer_id'])) {
            $query = $query->where('customer_id', $search['customer_id']);
        }

        return $query->orderBy('name', 'ASC')->get();
    }

    public function all()
    {
        return $this->model->orderBy('name', 'ASC')->get();
    }

    public function store($data)
    {
        if(isset($data['id'])) {
            $team = $this->getOne($data['id']);
            $team->name = $data['name'];
            $team->customer_id = $data['customer_id'];
            return $team->save();
        }
        return $this->model->create($data);
    }

    public function customerTeams($customer_id)
    {
        $teams = $this->model->where('customer_id', $customer_id)->orderBy('name', 'ASC')->get();

        if(count($teams) > 0 ) {
            return $teams;
        }
        return [];
    }

}