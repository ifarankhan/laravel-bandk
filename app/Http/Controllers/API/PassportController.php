<?php

namespace App\Http\Controllers\API;

use App\Claims;
use App\Repositories\AddressesInterface;
use App\Repositories\ClaimInterface;
use App\Repositories\ClaimMechanicsInterface;
use App\Repositories\ClaimTypesInterface;
use App\Repositories\DepartmentsInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{
    public $successStatus = 200;
    /**
     * @var ClaimTypesInterface
     */
    private $claimTypes;
    /**
     * @var ClaimMechanicsInterface
     */
    private $claimMechanics;
    /**
     * @var DepartmentsInterface
     */
    private $departments;
    /**
     * @var AddressesInterface
     */
    private $addresses;
    /**
     * @var ClaimInterface
     */
    private $claim;

    /**
     * PassportController constructor.
     * @param ClaimInterface $claim
     * @param ClaimTypesInterface $claimTypes
     * @param ClaimMechanicsInterface $claimMechanics
     * @param DepartmentsInterface $departments
     * @param AddressesInterface $addresses
     */
    public function __construct(ClaimInterface $claim,
                                ClaimTypesInterface $claimTypes,
                                ClaimMechanicsInterface $claimMechanics,
                                DepartmentsInterface $departments,
                                AddressesInterface $addresses)
    {
        $this->claim = $claim;
        $this->claimTypes = $claimTypes;
        $this->claimMechanics = $claimMechanics;
        $this->departments = $departments;
        $this->addresses = $addresses;
    }

    /*
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login() {

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(
                [
                    'status' => $this->successStatus,
                    'message' => 'Login Successfully.',
                    'data' => [
                        'token' => $success['token'],
                        'name' => $user->name,
                        'roles' => ($user->roles) ? $user->roles : [],
                        'modules' => ($user->modules) ? $user->modules: [],
                    ]

                ],
                $this->successStatus
            );
        }
        else {
            return response()->json(['message' => 'Email or password is wrong', 'status' => 401, "data" =>  null], $this->successStatus);
        }
    }

    /*
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()],401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return response()->json(
            [
                'status' => $this->successStatus,
                'message' => 'Register Successfully.',
                'data' => [
                    'token' => $success['token'],
                    'name' => $success['name']
                ]
            ],
            $this->successStatus
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClaimFormData() {
        $claimTypes = $this->claimTypes->all();
        $claimMechanics = $this->claimMechanics->all();
        $departments = $this->departments->all();
        return response()->json(
            [
                'message' => 'Claim data',
                'status' => $this->successStatus,
                'data' => [
                    'claim_types' => $claimTypes,
                    'claim_mechanics' => $claimMechanics,
                    'departments' => $departments,
                ]
            ], $this->successStatus);
    }

    public function createClaim(Request $request)
    {
        $data = $request->all();

        $response = $this->claim->createClaim($data);

        if($response) {
            return response()->json(
                [
                    'status' => $this->successStatus,
                    'message' => 'Claim created successfully',
                    'data' => null
                ], $this->successStatus);
        }
    }

}