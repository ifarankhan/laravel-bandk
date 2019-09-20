<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

    public function redirectTo()
    {
        $roles = \Auth::user()->roles->pluck('name')->toArray();
        $modules = (\Auth::user()->modules) ? \Auth::user()->modules->pluck('name')->toArray() : [];

        if(in_array('ADMIN', $roles) || in_array('MANAGER', $roles)) {
            session()->remove('url.intended');
            return route('dashboard.index');
        } elseif (in_array('AGENT', $roles)) {
            if(in_array('INFO_APP', $modules)) {
                session()->remove('url.intended');
                return route('home.index');
            } elseif (in_array('CLAIM_FORM', $modules)) {
                session()->remove('url.intended');
                return route('claim.index');
            }
        }
    }


    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            ['username' => $request->get('email'), 'password' => $request->get('password')] + ['status' => true], $request->filled('remember')
        );
    }

    public function username()
    {
        return 'username';
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
           'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
