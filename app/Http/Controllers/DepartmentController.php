<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\CategoryRequest;
use App\Http\Requests\DepartmentRequest;
use App\Repositories\CategoryInterface;
use App\Repositories\CustomerInterface;
use App\Repositories\DepartmentsInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{


    /**
     * @var DepartmentsInterface
     */
    private $departments;
    /**
     * @var CustomerInterface
     */
    private $customer;

    /**
     * DepartmentController constructor.
     * @param DepartmentsInterface $departments
     * @param CustomerInterface $customer
     */
    public function __construct(DepartmentsInterface $departments, CustomerInterface $customer)
    {

        $this->departments = $departments;
        $this->customer = $customer;
    }

    public function index()
    {
        $departments = $this->departments->all();
        return view('department.index', compact('departments'));
    }

    public function create()
    {
        $parents = $this->departments->all();
        $customers = $this->customer->all();
        return view('department.create', compact('parents', 'customers'));
    }
    public function edit($id)
    {
        $department = $this->departments->getOne($id);
        $customers = $this->customer->all();
        return view('department.edit', compact('department', 'customers'));
    }

    public function store(DepartmentRequest $request)
    {
        $data = $request->all();
        $data['code'] = 0;
        $response = $this->departments->store($data);

        if($response) {
            $request->session()->flash('alert-success', '<strong>Department has been created/updated successfully. To go to users click '.'<a class="btn btn-danger" href="'.route('users.index').'">here</a></strong>');
            return redirect()->route('department.index');
        } else {
            $request->session()->flash('alert-danger', 'Error while updating/creating departments.');
            return redirect()->route('department.index');
        }
    }

    public function delete($id)
    {
        $response = $this->departments->delete($id);

        if($response) {
            return [
                'status' => '200',
                'success' => true
            ];
        }
        return [
            'status' => '200',
            'success' => false
        ];

    }

    public function customerDepartments($id)
    {
        return $this->departments->getCustomerDepartment($id);
    }
}