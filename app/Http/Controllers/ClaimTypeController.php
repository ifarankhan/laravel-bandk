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
use App\Repositories\CategoryInterface;
use App\Repositories\ClaimTypesInterface;
use Illuminate\Http\Request;

class ClaimTypeController extends Controller
{


    /**
     * @var ClaimTypesInterface
     */
    private $claimTypes;

    /**
     * ClaimTypeController constructor.
     * @param ClaimTypesInterface $claimTypes
     */
    public function __construct(ClaimTypesInterface $claimTypes)
    {
        $this->claimTypes = $claimTypes;
    }

    public function index()
    {
        $claimTypes = $this->claimTypes->all();
        return view('claim_types.index', compact('claimTypes'));
    }

    public function create()
    {
        $parents = $this->claimTypes->all();
        return view('claim_types.create', compact('parents'));
    }
    public function edit($id)
    {
        $claimType = $this->claimTypes->getOne($id);
        return view('claim_types.edit', compact('claimType'));
    }

    public function store(ClaimTypeRequest $request)
    {
        $data = $request->all();
        $response = $this->claimTypes->store($data);

        if($response) {
            $request->session()->flash('alert-success', 'Claim Type has been created/updated successfully.');
            return redirect()->route('claim-type.index');
        } else {
            $request->session()->flash('alert-danger', 'Error while updating/creating claim type.');
            return redirect()->route('claim-type.index');
        }
    }

    public function delete($id)
    {
        $response = $this->claimTypes->delete($id);

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