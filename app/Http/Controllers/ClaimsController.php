<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\ClaimConversationRequest;
use App\Repositories\ClaimConversationInterface;
use App\Repositories\ClaimInterface;
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
     * ClaimsController constructor.
     * @param ClaimInterface $claim
     * @param ClaimConversationInterface $claimConversation
     * @param ClaimTypesInterface $claimTypes
     * @param DepartmentsInterface $departments
     */
    public function __construct(ClaimInterface $claim, ClaimConversationInterface $claimConversation,
                                ClaimTypesInterface $claimTypes, DepartmentsInterface $departments)
    {
        $this->claim = $claim;
        $this->claimConversation = $claimConversation;
        $this->claimTypes = $claimTypes;
        $this->departments = $departments;
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
}