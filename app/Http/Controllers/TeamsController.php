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
     * TeamsController constructor.
     * @param TeamsInterface $teams
     * @param CustomerInterface $customer
     */
    public function __construct(TeamsInterface $teams, CustomerInterface $customer)
    {
        $this->teams = $teams;
        $this->customer = $customer;
    }

    public function index()
    {
        $teams = $this->teams->all();

        return view('teams.index', compact('teams'));
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
        return $this->teams->customerTeams($id);
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
}