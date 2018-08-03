<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Closure;

class IsSuperUser extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next, $guard = null)
    {
        if ((\Auth::user()->roles) && in_array('ADMIN', \Auth::user()->roles->pluck('name')->toArray())) {
            return $next($request);
        }

        return redirect()->route('dashboard.index');
    }
}
