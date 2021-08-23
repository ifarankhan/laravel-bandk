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
use App\Repositories\CustomerInterface;
use App\Repositories\DepartmentsInterface;
use App\Repositories\UserInterface;
use Illuminate\Http\Request;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

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
    /**n
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
     * @var CustomerInterface
     */
    private $customer;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ClaimsController constructor.
     * @param ClaimInterface $claim
     * @param ClaimConversationInterface $claimConversation
     * @param ClaimTypesInterface $claimTypes
     * @param DepartmentsInterface $departments
     * @param ClaimMechanicsInterface $claimMechanics
     * @param AddressesInterface $addresses
     * @param CustomerInterface $customer
     * @param UserInterface $userRepository
     */
    public function __construct(ClaimInterface $claim, ClaimConversationInterface $claimConversation,
                                ClaimTypesInterface $claimTypes, DepartmentsInterface $departments, ClaimMechanicsInterface $claimMechanics,
                                AddressesInterface $addresses, CustomerInterface $customer, UserInterface $userRepository)
    {
        $this->claim = $claim;
        $this->claimConversation = $claimConversation;
        $this->claimTypes = $claimTypes;
        $this->departments = $departments;
        $this->claimMechanics = $claimMechanics;
        $this->addresses = $addresses;
        $this->customer = $customer;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        setSearchInSession($search);
        $claimTypes = $this->claimTypes->all();
        $departments = $this->departments->all();
        $customers = $this->customer->all();
        $users = $this->userRepository->all();
        $claims = $this->claim->search($search);

        return view('claims.index', compact('claims', 'departments', 'claimTypes', 'search', 'customers', 'users'));
    }

    public function details($id)
    {
        $claim = $this->claim->getOne($id);
        if($claim) {
            return view('claims.details', compact('claim'));
        }

        abort(404);

    }

    public function addConversation(ClaimConversationRequest $request)
    {
        $data = $request->all();
        $response = $this->claimConversation->create($data);

        if($response) {
            $request->session()->flash('alert-success', getTranslation('claim_conversation_create_success_message'));
            return redirect()->back();
        } else {
            $request->session()->flash('alert-danger', getTranslation('claim_conversation_create_error_message'));
            return redirect()->back();
        }
    }

    public function create()
    {
        $departments = $this->departments->all();
        $mechanicsTypes = $this->claimMechanics->all();
        $types = $this->claimTypes->all();
        $customers = $this->customer->all();
        return view('claims.create', compact('departments', 'mechanicsTypes', 'types', 'customers'));
    }
    public function edit($id)
    {
        $departments = $this->departments->all();
        $mechanicsTypes = $this->claimMechanics->all();
        $types = $this->claimTypes->all();
        $customers = $this->customer->all();
        $claim = $this->claim->getOne($id);
        return view('claims.edit', compact('departments', 'mechanicsTypes', 'types', 'customers', 'claim'));
    }
    public function otherFields(Request $request)
    {
        $data = $request->all();
        $response = $this->claim->otherFields($data);
        if($response) {
            $request->session()->flash('alert-success', getTranslation('claim_create_success_message'));
            return redirect()->back();
        } else {
            $request->session()->flash('alert-danger', getTranslation('claim_create_error_message'));
            return redirect()->back();
        }
    }

    public function store(ClaimRequests $request)
    {
        $data = $request->all();
        $response = $this->claim->createClaim($data);

        if($response) {
            if(isset($response['email'])) {
                $request->session()->flash('alert-success', getTranslation('claim_create_success_message_but_not_email'));
            } else {
                $request->session()->flash('alert-success', getTranslation('claim_create_success_message'));
            }

            if(isset($data['id'])) {
                return redirect()->route('claim.edit', $data['id']);
            }
            return redirect()->route('claim.create');
        } else {
            $request->session()->flash('alert-danger', getTranslation('claim_create_error_message'));
            if(isset($data['id'])) {
                return redirect()->route('claim.edit', $data['id']);
            }
            return redirect()->route('claim.create');
        }
    }

    public function updateStatus(ClaimStatusRequests $request)
    {
        $data = $request->all();
        $response = $this->claim->updateStatus($data);

        if($request->isXmlHttpRequest()) {
            return [
                'status' => $response
            ];
        }

        if($response) {
            $request->session()->flash('alert-success', getTranslation('claim_create_success_message'));
            return redirect()->route('claim.details', ['id'=> $data['id']]);
        } else {
            $request->session()->flash('alert-danger', getTranslation('claim_create_error_message'));
            return redirect()->route('claim.details', ['id'=> $data['id']]);
        }
    }

    public function departmentAddress($id)
    {
        return $this->addresses->getAddressesByDepartment($id);
    }

    public function deleteImage($id)
    {
        $response =  $this->claim->deleteImage($id);
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

    public function delete($id)
    {
        $response = $this->claim->delete($id);

        if($response) {
            return [
                'is_deleted' => true
            ];
        }

        return [
          'is_deleted' => false
        ];
    }

    public function deleteConversation($id)
    {
        $response =  $this->claimConversation->delete($id);
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

    public function deleteConversationFile($id)
    {
        $response =  $this->claimConversation->deleteFile($id);
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
