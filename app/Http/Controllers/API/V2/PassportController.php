<?php

namespace App\Http\Controllers\API\V2;

use App\ClaimImages;
use App\Claims;
use App\Http\Requests\ClaimCreationRequest;
use App\Repositories\AddressesInterface;
use App\Repositories\CategoryInterface;
use App\Repositories\ClaimInterface;
use App\Repositories\ClaimMechanicsInterface;
use App\Repositories\ClaimTypesInterface;
use App\Repositories\CompanyInterface;
use App\Repositories\ContentInterface;
use App\Repositories\CustomerInterface;
use App\Repositories\DepartmentsInterface;
use App\Repositories\UserInterface;
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
     * @var ContentInterface
     */
    private $content;
    /**
     * @var CategoryInterface
     */
    private $category;
    /**
     * @var CustomerInterface
     */
    private $customer;
    /**
     * @var UserInterface
     */
    private $user;
    /**
     * @var CompanyInterface
     */
    private $company;

    /**
     * PassportController constructor.
     * @param ClaimInterface $claim
     * @param ClaimTypesInterface $claimTypes
     * @param ClaimMechanicsInterface $claimMechanics
     * @param DepartmentsInterface $departments
     * @param AddressesInterface $addresses
     * @param ContentInterface $content
     * @param CategoryInterface $category
     * @param CustomerInterface $customer
     * @param UserInterface $user
     * @param CompanyInterface $company
     */
    public function __construct(ClaimInterface $claim,
                                ClaimTypesInterface $claimTypes,
                                ClaimMechanicsInterface $claimMechanics,
                                DepartmentsInterface $departments,
                                AddressesInterface $addresses,
                                ContentInterface $content,
                                CategoryInterface $category,
                                CustomerInterface $customer,
                                UserInterface $user,
                                CompanyInterface $company)
    {
        $this->claim = $claim;
        $this->claimTypes = $claimTypes;
        $this->claimMechanics = $claimMechanics;
        $this->departments = $departments;
        $this->addresses = $addresses;
        $this->content = $content;
        $this->category = $category;
        $this->customer = $customer;
        $this->user = $user;
        $this->company = $company;
    }

    /*
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login() {

        if(Auth::attempt(['username' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $companies = [];

            if($user->companies) {
                $companies = $user->companies->map(function ($company) {
                    return collect(['id' => $company->company_id, 'name' => $company->name])
                        ->all();
                });
            }
            return response()->json(
                [
                    'status' => $this->successStatus,
                    'message' => 'Login Successfully.',
                    'data' => [
                        'token' => $success['token'],
                        'name' => $user->name,
                        'id' => $user->id,
                        'roles' => ($user->roles) ? $user->roles : [],
                        'modules' => ($user->modules) ? $user->modules: [],
                        'companies' => $companies
                    ]

                ],
                $this->successStatus
            );
        }
        else {
            return response()->json(['message' => 'Email or password is wrong', 'status' => 401, "data" =>  null], $this->successStatus);
        }
    }

    public function getUserRoles() {

        if(\Auth::user()) {
            $customer = (\Auth::user()->customer) ? \Auth::user()->customer: null;

            if(!is_null($customer)) {
                $emails = (\Auth::user()->customer) ? json_decode(\Auth::user()->customer->emails): null;
                $customer->emails = $emails;
            } else {
                $customer = [];
            }

            return response()->json(
                [
                    'status' => $this->successStatus,
                    'message' => 'User Roles.',
                    'data' => [
                        'roles' => (\Auth::user()->roles) ? \Auth::user()->roles : [],
                        'modules' => (\Auth::user()->modules) ? \Auth::user()->modules: [],
                        'customer' => $customer
                    ]

                ],
                $this->successStatus
            );
        }else {
            return response()->json(['message' => 'User is not login', 'status' => 401, "data" =>  null], $this->successStatus);
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
        return response()->json(
            [
                'message' => 'Claim data',
                'status' => $this->successStatus,
                'data' => [
                    'claim_types' => $claimTypes,
                    'claim_mechanics' => $claimMechanics,
                ]
            ], $this->successStatus);
    }

    public function createClaim(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(),[
            'claim_type_id' => 'required',
            'estimate' => 'required',
            'date' => 'required',
            /*'claim_mechanic_id' => 'required',*/
            'department_id' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'description' => 'required',
            'status' => 'required',
            /*'images' => 'required',*/
            'images.*' => 'image|mimes:jpg,png,jpeg'
        ]);

        if($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $m = '';
            foreach ($errors as $error) {
                $m = $m . $error[0]."\n";
            }
            return response()->json([
                'status' => 422,
                'message' => $m,
                'data' => null
            ],$this->successStatus);
        }
        $response = $this->claim->createClaim($data);

        if($response) {
            if(isset($response['email'])) {
                return response()->json(
                    [
                        'status' => $this->successStatus,
                        'message' => getTranslation('claim_create_success_message_but_not_email'),
                        'data' => [
                            'id' => $response['claim']->id
                        ]
                    ], $this->successStatus);
            }
            if(isset($data['id'])) {
                return response()->json(
                    [
                        'status' => $this->successStatus,
                        'message' => 'Claim updated successfully',
                        'data' => [
                            'id' => $response->id
                        ]
                    ], $this->successStatus);

            }
            return response()->json(
                [
                    'status' => $this->successStatus,
                    'message' => 'Claim created successfully',
                    'data' => [
                        'id' => $response->id
                    ]
                ], $this->successStatus);
        } else {
            return response()->json(
                [
                    'status' => $this->successStatus,
                    'message' => 'Error While creating claim',
                    'data' => null
                ], $this->successStatus);
        }
    }

    public function getCategories()
    {
        $parentId = null;
        $response = $this->category->getCategories($parentId);

        if(count($response) > 0 ) {
            return response()->json([
                'status' => $this->successStatus,
                'message' => 'List of Categories and subcategories',
                'data' => $response
            ], $this->successStatus);
        }
        return response()->json([
            'status' => 204,
            'message' => 'No categories',
            'data' => null
        ], $this->successStatus);


    }
    public function getCategory($id = null, Request $request)
    {
        $companyId = $request->query('companyId');
        if(is_null($id)) {
            return response()->json([
                'status' => 201,
                'message' => 'Category id is missing',
                'data' => null
            ], $this->successStatus);
        }
        $response = $this->category->getUserSpecificContentByCompanyByCustomerThenDefault($id, $companyId, \Auth::user()->customer_id);

        if(count($response) == 0) {
            return response()->json([
                'status' => 204,
                'message' => 'No category found.',
                'data' => null
            ], $this->successStatus);
        }

        return response()->json([
            'status' => $this->successStatus,
            'message' => 'List of category with content',
            'data' => $response
        ], $this->successStatus);
    }

    public function getClaim($id = null)
    {
        if(is_null($id)) {
            return response()->json([
                'status' => 201,
                'message' => 'Claim id is missing',
                'data' => null
            ], $this->successStatus);
        }
        $response = $this->claim->getOne($id);

        if(count($response) == 0) {
            return response()->json([
                'status' => 204,
                'message' => 'no Claim found.',
                'data' => null
            ], $this->successStatus);
        }

        return response()->json([
            'status' => $this->successStatus,
            'message' => 'Claim',
            'data' => $response
        ], $this->successStatus);
    }
    public function getOpenClaims()
    {
        $userDepartments = (\Auth::user()->departments) ? json_decode(\Auth::user()->departments, true) : null;
        if($userDepartments) {
            $response = $this->claim->openClaimsOfUserByDepartment($userDepartments);
        } else {
            $response = $this->claim->openClaimsOfUser(\Auth::user()->id);
        }

        if(count($response) == 0) {
            return response()->json([
                'status' => 204,
                'message' => 'no Claim found.',
                'data' => null
            ], $this->successStatus);
        }

        return response()->json([
            'status' => $this->successStatus,
            'message' => 'Claim',
            'data' => $response
        ], $this->successStatus);
    }
    public function deleteClaimImage($id = null)
    {
        if(is_null($id)) {
            return response()->json([
                'status' => 201,
                'message' => 'Image id is missing',
                'data' => null
            ], $this->successStatus);
        }
        $response = $this->claim->deleteImage($id);

        if(!$response) {
            return response()->json([
                'status' => 404,
                'message' => 'no Image found.',
                'data' => null
            ], $this->successStatus);
        }

        return response()->json([
            'status' => $this->successStatus,
            'message' => 'Image deleted Successfully',
            'data' => null
        ], $this->successStatus);
    }


    public function getUserCompanies()
    {
        $user = \Auth::user();
        dd($user);
        return [
            "status" =>  200,
            "message" => "User companies.",
            "data" => $this->company->getUserCompanyData($user->companies)
        ];
    }

}