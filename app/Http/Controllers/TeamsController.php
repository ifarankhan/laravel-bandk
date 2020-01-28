<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ClaimTypeRequest;
use App\Http\Requests\TeamRequest;
use App\Repositories\CategoryInterface;
use App\Repositories\ClaimTypesInterface;
use App\Repositories\CompanyInterface;
use App\Repositories\CustomerInterface;
use App\Repositories\TeamsInterface;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * @var TeamsInterface
     */
    private $teams;
    /**
     * @var CustomerInterface
     */
    private $customer;
    /**
     * @var CompanyInterface
     */
    private $company;

    /**
     * TeamsController constructor.
     * @param TeamsInterface $teams
     * @param CustomerInterface $customer
     * @param CompanyInterface $company
     */
    public function __construct(TeamsInterface $teams, CustomerInterface $customer, CompanyInterface $company)
    {
        $this->teams = $teams;
        $this->customer = $customer;
        $this->company = $company;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        setSearchInSession($search);
        $teams = $this->teams->search($search);
        $customers = $this->customer->all();

        return view('teams.index', compact('teams', 'customers', 'search'));
    }
    public function create()
    {
        $customers = $this->customer->all();
        return view('teams.create', compact('customers'));
    }
    public function edit($id)
    {
        $team = $this->teams->getOne($id);
        $customers = $this->customer->all();
        return view('teams.edit', compact('team', 'customers'));
    }

    public function customerTeams($id)
    {
        $teams =  $this->teams->customerTeams($id);
        $companies = $this->company->customerCompany($id);

        return [
            'teams' => $teams,
            'companies' => $companies
        ];
    }

    public function store(TeamRequest $request)
    {
        $data = $request->all();
        $response = $this->teams->store($data);

        if($response) {
            $request->session()->flash('alert-success',getTranslation('team_created_successfully'));
            return redirect()->route('team.index');
        } else {
            $request->session()->flash('alert-danger', getTranslation('team_error_while_creating'));
            return redirect()->route('team.index');
        }
    }
    public function delete($id)
    {
        $response = $this->teams->delete($id);

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