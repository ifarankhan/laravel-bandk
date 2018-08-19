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
use App\Repositories\DepartmentsInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{


    /**
     * @var DepartmentsInterface
     */
    private $departments;

    /**
     * DepartmentController constructor.
     * @param DepartmentsInterface $departments
     */
    public function __construct(DepartmentsInterface $departments)
    {

        $this->departments = $departments;
    }

    public function index()
    {
        $departments = $this->departments->all();
        return view('department.index', compact('departments'));
    }

    public function create()
    {
        $parents = $this->departments->all();
        return view('department.create', compact('parents'));
    }
    public function edit($id)
    {
        $department = $this->departments->getOne($id);
        return view('department.edit', compact('department'));
    }

    public function store(DepartmentRequest $request)
    {
        $data = $request->all();
        $response = $this->departments->store($data);

        if($response) {
            $request->session()->flash('alert-success', 'Department has been created/updated successfully.');
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
}