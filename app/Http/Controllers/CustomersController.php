<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CustomerRequest;
use App\Repositories\CategoryInterface;
use App\Repositories\CustomerInterface;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * @var CustomerInterface
     */
    private $customer;


    /**
     * CustomersController constructor.
     * @param CustomerInterface $customer
     */
    public function __construct(CustomerInterface $customer)
    {
        $this->customer = $customer;
    }

    public function index()
    {
        $customers = $this->customer->all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $parents = $this->customer->all();
        return view('customers.create', compact('parents'));
    }
    public function edit($id)
    {
        $customer = $this->customer->getOne($id);
        return view('customers.edit', compact('customer'));
    }

    public function store(CustomerRequest $request)
    {
        $data = $request->all();
        $response = $this->customer->store($data);

        if($response) {
            $request->session()->flash('alert-success', 'Customer has been created/updated successfully.');
            return redirect()->route('customer.index');
        } else {
            $request->session()->flash('alert-danger', 'Error while updating/creating customer.');
            return redirect()->route('customer.index');
        }
    }

    public function delete($id)
    {
        $response = $this->customer->delete($id);

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