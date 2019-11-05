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
use App\Repositories\CompanyInterface;
use App\Repositories\CustomerInterface;
use App\Repositories\DepartmentsInterface;
use App\Repositories\TeamsInterface;
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
     * @var CompanyInterface
     */
    private $company;

    /**
     * DepartmentController constructor.
     * @param DepartmentsInterface $departments
     * @param CustomerInterface $customer
     * @param CompanyInterface $company
     */
    public function __construct(DepartmentsInterface $departments, CustomerInterface $customer, CompanyInterface $company)
    {

        $this->departments = $departments;
        $this->customer = $customer;
        $this->company = $company;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        setSearchInSession($search);
        $departments = $this->departments->search($search);
        $customers = $this->customer->all();
        return view('department.index', compact('departments', 'customers', 'search'));
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
            $request->session()->flash('alert-success', '<strong>'.getTranslation('department_create_success_message').'<a class="btn btn-danger" href="'.route('users.index').'">here</a></strong>');
            return redirect()->route('department.index');
        } else {
            $request->session()->flash('alert-danger', getTranslation('department_create_error_message'));
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
    public function companyDepartments($id)
    {
        return $this->departments->getCompanyAssignedDepartments($id);
    }
    public function customerGroupedDepartments($id)
    {
        $department =  $this->departments->getCompanyDepartment($id);
        $departmentGroup = [];
        if(count($department) > 0) {
            foreach ($department as $dep) {
                $team = 'No Team';
                if(!is_null($dep->team_id)) {
                    $team = $dep->team->name;
                }
                $departmentGroup[$team][] = $dep;
            }
        }

        return $departmentGroup;
    }
}