<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Repositories\ClaimInterface;
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
     * DashboardController constructor.
     * @param UserInterface $user
     * @param ClaimInterface $claim
     */
    public function __construct(UserInterface $user, ClaimInterface $claim)
    {
        $this->user = $user;
        $this->claim = $claim;
    }

    public function index()
    {
        $userCount = $this->user->allCount();
        $claimCount = $this->claim->allCount();
        $todayCount = $this->claim->todayCount();
        $todayClaims = $this->claim->todayClaims();
        return view('dashboard.index', compact('userCount', 'claimCount', 'todayCount', 'todayClaims'));
    }
}