<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Repositories\CustomerInterface;
use App\Repositories\DepartmentsInterface;
use App\Repositories\ModulesInterface;
use App\Repositories\RolesInterface;
use App\Repositories\UserInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var UserInterface
     */
    private $user;
    /**
     * @var DepartmentsInterface
     */
    private $departments;
    /**
     * @var RolesInterface
     */
    private $roles;
    /**
     * @var ModulesInterface
     */
    private $modules;
    /**
     * @var CustomerInterface
     */
    private $customer;

    /**
     * UsersController constructor.
     * @param UserInterface $user
     * @param DepartmentsInterface $departments
     * @param RolesInterface $roles
     * @param ModulesInterface $modules
     * @param CustomerInterface $customer
     */
    public function __construct(UserInterface $user, DepartmentsInterface $departments, RolesInterface $roles, ModulesInterface $modules, CustomerInterface $customer)
    {

        $this->user = $user;
        $this->departments = $departments;
        $this->roles = $roles;
        $this->modules = $modules;
        $this->customer = $customer;
    }

    public function index()
    {
        $users = $this->user->all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roles->all();
        $modules = $this->modules->all();
        $customers = $this->customer->all();
        return view('users.create', compact('roles', 'modules', 'customers'));
    }
    public function edit($id)
    {
        $user = $this->user->getOne($id);
        $roles = $this->roles->all();
        $modules = $this->modules->all();
        $customers = $this->customer->all();
        return view('users.edit', compact('roles', 'modules', 'customers', 'user'));
    }
    public function status($id, Request $request)
    {
        $data = $request->all();
        $data['id'] = $id;
        return $this->user->updateStatus($data);
    }

    public function store(UserRequest $request)
    {
        $data = $request->all();

        $response = $this->user->store($data);

        if($response) {
            $request->session()->flash('alert-success', 'User has been created/updated successfully.');
            return redirect()->route('users.index');
        } else {
            $request->session()->flash('alert-danger', 'Error while updating/creating User.');
            return redirect()->route('users.index');
        }
    }
}