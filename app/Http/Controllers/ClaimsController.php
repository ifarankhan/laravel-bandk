<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\ClaimConversationRequest;
use App\Http\Requests\ClaimRequests;
use App\Http\Requests\ClaimStatusRequests;
use App\Repositories\AddressesInterface;
use App\Repositories\ClaimConversationInterface;
use App\Repositories\ClaimInterface;
use App\Repositories\ClaimMechanicsInterface;
use App\Repositories\ClaimTypesInterface;
use App\Repositories\DepartmentsInterface;
use Illuminate\Http\Request;

class ClaimsController extends Controller
{

    /**
     * @var ClaimInterface
     */
    private $claim;
    /**
     * @var ClaimConversationInterface
     */
    private $claimConversation;
    /**
     * @var ClaimTypesInterface
     */
    private $claimTypes;
    /**
     * @var DepartmentsInterface
     */
    private $departments;
    /**
     * @var ClaimMechanicsInterface
     */
    private $claimMechanics;
    /**
     * @var AddressesInterface
     */
    private $addresses;

    /**
     * ClaimsController constructor.
     * @param ClaimInterface $claim
     * @param ClaimConversationInterface $claimConversation
     * @param ClaimTypesInterface $claimTypes
     * @param DepartmentsInterface $departments
     * @param ClaimMechanicsInterface $claimMechanics
     * @param AddressesInterface $addresses
     */
    public function __construct(ClaimInterface $claim, ClaimConversationInterface $claimConversation,
                                ClaimTypesInterface $claimTypes, DepartmentsInterface $departments, ClaimMechanicsInterface $claimMechanics, AddressesInterface $addresses)
    {
        $this->claim = $claim;
        $this->claimConversation = $claimConversation;
        $this->claimTypes = $claimTypes;
        $this->departments = $departments;
        $this->claimMechanics = $claimMechanics;
        $this->addresses = $addresses;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $claimTypes = $this->claimTypes->all();
        $departments = $this->departments->all();
        $claims = $this->claim->search($search);
        return view('claims.index', compact('claims', 'departments', 'claimTypes', 'search'));
    }

    public function details($id)
    {
        $claim = $this->claim->getOne($id);
        return view('claims.details', compact('claim'));
    }

    public function addConversation(ClaimConversationRequest $request)
    {
        $data = $request->all();
        $response = $this->claimConversation->create($data);

        if($response) {
            $request->session()->flash('alert-success', 'Claim conversation has been created/updated successfully.');
            return redirect()->back();
        } else {
            $request->session()->flash('alert-danger', 'Error while updating/creating conversation.');
            return redirect()->back();
        }
    }

    public function create()
    {
        $departments = $this->departments->all();
        $mechanicsTypes = $this->claimMechanics->all();
        $types = $this->claimTypes->all();
        return view('claims.create', compact('departments', 'mechanicsTypes', 'types'));
    }

    public function store(ClaimRequests $request)
    {
        $data = $request->all();
        $response = $this->claim->createClaim($data);

        if($response) {
            $request->session()->flash('alert-success', 'Claim has been created.');
            return redirect()->route('claim.create');
        } else {
            $request->session()->flash('alert-danger', 'Error while creating claim.');
            return redirect()->route('claim.create');
        }
    }

    public function updateStatus(ClaimStatusRequests $request)
    {
        $data = $request->all();
        $response = $this->claim->updateStatus($data);

        if($response) {
            $request->session()->flash('alert-success', 'Claim status has been updated.');
            return redirect()->route('claim.details', ['id'=> $data['id']]);
        } else {
            $request->session()->flash('alert-danger', 'Error while update status of claim.');
            return redirect()->route('claim.details', ['id'=> $data['id']]);
        }
    }

    public function departmentAddress($id)
    {
        return $this->addresses->getAddressesByDepartment($id);
    }
}