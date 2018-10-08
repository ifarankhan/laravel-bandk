<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Closure;
use Mockery\Exception;

class CanAccess extends Middleware
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
        $roles = \Auth::user()->roles->pluck('name')->toArray();
        $modules = (\Auth::user()->modules) ? \Auth::user()->modules->pluck('name')->toArray() : [];
        $requestName = $request->route()->getName();

        if(in_array('ADMIN', $roles)) {
            return $next($request);

        } elseif (in_array('AGENT', $roles)) {
            if(in_array('INFO_APP', $modules) && !in_array('CLAIM_FORM', $modules)) {
                if($requestName == 'home.index') {
                    return $next($request);
                } else{
                    abort(403, 'Unauthorized action.');
                }
            } elseif (in_array('CLAIM_FORM', $modules) && in_array('INFO_APP', $modules)) {

                if($requestName == 'claim.create' || $requestName == 'home.index') {
                    return $next($request);
                }else{
                    abort(403, 'Unauthorized action.');
                }
            } elseif (!in_array('INFO_APP', $modules) && in_array('CLAIM_FORM', $modules)) {
                if($requestName == 'claim.create') {
                    return $next($request);
                }else{
                    abort(403, 'Unauthorized action.');
                }
            }
        } elseif (in_array('MANAGER', $roles)) {
            if($requestName == 'home.index') {
                return $next($request);
            } else{
                abort(403, 'Unauthorized action.');
            }
        }
    }
}
