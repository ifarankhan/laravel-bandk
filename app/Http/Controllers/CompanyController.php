<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CompanyRequest;
use App\Repositories\CompanyInterface;
use App\Repositories\CustomerInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @var CustomerInterface
     */
    private $company;
    /**
     * @var CustomerInterface
     */
    private $customer;


    /**
     * CompanyController constructor.
     * @param CompanyInterface $company
     * @param CustomerInterface $customer
     */
    public function __construct(CompanyInterface $company, CustomerInterface $customer)
    {
        $this->company = $company;
        $this->customer = $customer;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        setSearchInSession($search);
        $allCustomers = $this->customer->all();
        $companies = $this->company->search($search);
        return view('companies.index', compact('allCustomers','companies', 'search'));
    }

    public function create()
    {
        $allCustomers = $this->customer->all();
        return view('companies.create', compact('allCustomers'));
    }
    public function edit($id)
    {
        $company = $this->company->getOne($id);
        $allCustomers = $this->customer->all();
        return view('companies.edit', compact('company', 'allCustomers'));
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        $response = $this->company->store($data);

        if($response) {
            $request->session()->flash('alert-success', getTranslation('company_create_success_message'));
            return redirect()->route('company.index');
        } else {
            $request->session()->flash('alert-danger', getTranslation('company_create_error_message'));
            return redirect()->route('company.index');
        }
    }

    public function details($id)
    {
        $company = $this->company->getOne($id);
        return view('companies.details', compact('company'));
    }

    public function customerCompanies($customerId)
    {
        $user = \Auth::user();
        $companies = $user->companies;
        if(in_array('ADMIN', getUserRoles($user))) {
            return $this->company->customerCompany($customerId);
        }

        return $this->company->getUserCompanyData($companies);
    }

    public function delete($id)
    {
        $response = $this->company->delete($id);

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