<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\Events\SendWelcomeEmailEvent;
use App\Mail\SendWelcomeEmailMail;
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
        $roles = getUserRoles(\Auth::user());
        $query = $this->model;
        if(in_array('AGENT', $roles) && \Auth::user()->customer) {
            $query = $query->where('customer_id', \Auth::user()->customer->id);
        }
        return $query->get();
    }
    public function search($search)
    {
        $query = $this->model;
        if (isset($search['customer_id'])) {
            $query = $query->where('customer_id', $search['customer_id']);
        }
        return $query->get();
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

        if(!isset($data['id'])) {
            event(new SendWelcomeEmailEvent($data, $data['email']));
        }

        return $this->model;

    }

    public function getUserAllData($user)
    {
        $data =  $this->model->with(['customer', 'customer.departments'])->find($user->id);
        //return $data;
        return ($data->customer) ? $data->customer->departments : [];
    }
}