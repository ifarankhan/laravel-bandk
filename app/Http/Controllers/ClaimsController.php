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
     * ClaimsController constructor.
     * @param ClaimInterface $claim
     * @param ClaimConversationInterface $claimConversation
     */
    public function __construct(ClaimInterface $claim, ClaimConversationInterface $claimConversation)
    {
        $this->claim = $claim;
        $this->claimConversation = $claimConversation;
    }

    public function index()
    {
        $claims = $this->claim->all();
        return view('claims.index', compact('claims'));
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