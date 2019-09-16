<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Repositories\CompanyInterface;
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
     * @var CompanyInterface
     */
    private $company;

    /**
     * UsersController constructor.
     * @param UserInterface $user
     * @param DepartmentsInterface $departments
     * @param RolesInterface $roles
     * @param ModulesInterface $modules
     * @param CustomerInterface $customer
     * @param CompanyInterface $company
     */
    public function __construct(UserInterface $user, DepartmentsInterface $departments, RolesInterface $roles, ModulesInterface $modules, CustomerInterface $customer, CompanyInterface $company)
    {

        $this->user = $user;
        $this->departments = $departments;
        $this->roles = $roles;
        $this->modules = $modules;
        $this->customer = $customer;
        $this->company = $company;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = $this->user->search($search);
        $customers = $this->customer->all();
        return view('users.index', compact('users', 'customers', 'search'));
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
        $companies = $this->company->customerCompany($user->customer_id);
        return view('users.edit', compact('roles', 'modules', 'customers', 'user', 'companies'));
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
            if(isset($response['email'])) {
                $request->session()->flash('alert-success', getTranslation('user_create_success_message_but_not_email'));
            } else {
                $request->session()->flash('alert-success', getTranslation('user_create_success_message'));
            }
            $request->session()->flash('alert-success', getTranslation('user_create_success_message'));
            return redirect()->route('users.index');
        } else {
            $request->session()->flash('alert-danger', getTranslation('user_create_error_message'));
            return redirect()->route('users.index');
        }
    }
}