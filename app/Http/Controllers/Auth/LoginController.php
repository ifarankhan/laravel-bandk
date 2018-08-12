<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*public function redirectTo()
    {
        $roles = \Auth::user()->roles->pluck('name')->toArray();
        $modules = (\Auth::user()->modules) ? \Auth::user()->modules->pluck('name')->toArray() : [];

        if(in_array('ADMIN', $roles) || in_array('MANAGER', $roles)) {
            return redirect()->route('dashboard.index');
        } elseif (in_array('AGENT', $roles)) {
            if(in_array('INFO_APP', $modules)) {
                return redirect()->route('home.index');
            } elseif (in_array('CLAIM_FORM', $modules)) {
                return redirect()->route('home.claim-form');
            }
        }
    }*/
}
