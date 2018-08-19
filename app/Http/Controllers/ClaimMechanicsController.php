<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ClaimMechanicRequest;
use App\Repositories\CategoryInterface;
use App\Repositories\ClaimMechanicsInterface;
use App\Repositories\ClaimTypesInterface;
use Illuminate\Http\Request;

class ClaimMechanicsController extends Controller
{


    /**
     * @var ClaimMechanicsInterface
     */
    private $claimMechanics;

    /**
     * ClaimMechanicsController constructor.
     * @param ClaimMechanicsInterface $claimMechanics
     */
    public function __construct(ClaimMechanicsInterface $claimMechanics)
    {

        $this->claimMechanics = $claimMechanics;
    }

    public function index()
    {
        $claimMechanics = $this->claimMechanics->all();
        return view('claim_mechanics.index', compact('claimMechanics'));
    }

    public function create()
    {
        $parents = $this->claimMechanics->all();
        return view('claim_mechanics.create', compact('parents'));
    }
    public function edit($id)
    {
        $claimMechanic = $this->claimMechanics->getOne($id);
        return view('claim_mechanics.edit', compact('claimMechanic'));
    }

    public function store(ClaimMechanicRequest $request)
    {
        $data = $request->all();
        $response = $this->claimMechanics->store($data);

        if($response) {
            $request->session()->flash('alert-success', 'Claim mechanic has been created/updated successfully.');
            return redirect()->route('claim-mechanic.index');
        } else {
            $request->session()->flash('alert-danger', 'Error while updating/creating claim mechanic.');
            return redirect()->route('claim-mechanic.index');
        }
    }

    public function delete($id)
    {
        $response = $this->claimMechanics->delete($id);

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