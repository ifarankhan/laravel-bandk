<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Repositories\ClaimInterface;
use App\Repositories\CustomerInterface;
use App\Repositories\UserInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @var UserInterface
     */
    private $user;
    /**
     * @var ClaimInterface
     */
    private $claim;
    /**
     * @var CustomerInterface
     */
    private $customer;

    /**
     * DashboardController constructor.
     * @param UserInterface $user
     * @param ClaimInterface $claim
     * @param CustomerInterface $customer
     */
    public function __construct(UserInterface $user, ClaimInterface $claim, CustomerInterface $customer)
    {
        $this->user = $user;
        $this->claim = $claim;
        $this->customer = $customer;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        setSearchInSession($search);

        $userCount = $this->user->allCount($search);
        $claimCount = $this->claim->allCount($search);
        $todayCount = $this->claim->todayCount($search);
        $todayClaims = $this->claim->todayClaims($search);
        $customersCount = $this->customer->allCount($search);
        $customers = $this->customer->all($search);
        return view('dashboard.index', compact('userCount', 'claimCount', 'todayCount', 'todayClaims', 'customersCount', 'customers', 'search'));
    }
}