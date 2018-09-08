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

    public function index()
    {
        $userCount = $this->user->allCount();
        $claimCount = $this->claim->allCount();
        $todayCount = $this->claim->todayCount();
        $todayClaims = $this->claim->todayClaims();
        $customersCount = $this->customer->allCount();
        return view('dashboard.index', compact('userCount', 'claimCount', 'todayCount', 'todayClaims', 'customersCount'));
    }
}