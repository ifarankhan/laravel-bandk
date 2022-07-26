<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\Events\SendUpdatePasswordEmailEvent;
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
        if (session('customer_id')) {
            $query = $query->where('customer_id', session('customer_id'));
        }
        return $query->get();
    }
    public function allCount($search = [])
    {
        $query = $this->model;
        if (isset($search['customer_id'])) {
            $query = $query->where('customer_id', $search['customer_id']);
        }
        return $query->count();
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
            $this->model->companies()->detach();
        }

        $this->model->name = $data['name'];
        $this->model->email = $data['email'];
        $this->model->username = $data['username'];
        $this->model->department_id = isset($data['department_id']) ? $data['department_id'] : null;
        $this->model->customer_id = isset($data['customer_id']) ? $data['customer_id'] : null;
        $this->model->phone_number = isset($data['phone_number']) ? $data['phone_number'] : null;

        $this->model->departments = (count($data['departments']) > 0) ? json_encode($data['departments']) : null;
        if(isset($data['password'])) {
            $this->model->password = bcrypt($data['password']);
        }
        $this->model->save();

        $this->model->modules()->attach($data['modules']);
        $this->model->roles()->attach($data['roles']);
        $this->model->companies()->attach($data['companies']);

        if(!isset($data['id'])) {
            try {
                event(new SendWelcomeEmailEvent($data, $data['email']));
            } catch (\Exception $e) {
                return [
                    'email' => false
                ];
            }

        } else {
            if(!empty($data['password'])) {
                event(new SendUpdatePasswordEmailEvent($data, $data['email']));
            }
        }

        return $this->model;

    }

    public function getUserAllData($user)
    {
        $data =  $this->model->with(['customer', 'department', 'company'])->find($user->id);
        $userDepartments = json_decode($data->departments);
        $customerDepartments = ($data->customer) ? $data->customer->departments : [];
        //dd($customerDepartments->pluck('id')->toArray(), $userDepartments);

        if(count($customerDepartments) > 0) {
            foreach ($customerDepartments as $key => $customerDepartment) {
                //dump((string)$customerDepartment->id);
                if(!in_array((string)$customerDepartment->id, $userDepartments)) {
                    unset($customerDepartments[$key]);
                }
            }
        }

        return $customerDepartments;
    }

    public function getUserDepartments($user)
    {
        $department = $this->getUserAllData($user);

        return $department->pluck('id')->toArray();
    }
}