<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\User;

class UserRepository implements UserInterface
{
    /**
     * @var User
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all()
    {
        return $this->model->all();
    }
    public function allCount()
    {
        return $this->model->count();
    }

    public function getOne($id)
    {
        return $this->model->find($id);
    }

    public function updateStatus($data)
    {
        $user = $this->getOne($data['id']);
        $user->status = ($data['status'] == "true") ? 1 : 0;
        $user->save();

        return $user;
    }

    public function store($data)
    {
        if(isset($data['id'])) {
            $this->model = $this->model->find($data['id']);
            $this->model->modules()->detach();
            $this->model->roles()->detach();
        }

        $this->model->name = $data['name'];
        $this->model->email = $data['email'];
        $this->model->department_id = isset($data['department_id']) ? $data['department_id'] : null;
        $this->model->customer_id = isset($data['customer_id']) ? $data['customer_id'] : null;
        if(isset($data['password'])) {
            $this->model->password = bcrypt($data['password']);
        }
        $this->model->save();

        $this->model->modules()->attach($data['modules']);
        $this->model->roles()->attach($data['roles']);

        return $this->model;

    }
}