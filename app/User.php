<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','department_id', 'phone_number', 'username', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'user_roles', 'user_id', 'role_id')->select(['roles.id', 'roles.name']);
    }
    public function modules()
    {
        return $this->belongsToMany(Modules::class, 'user_modules', 'user_id', 'module_id')
            //->where('name', 'CLAIM_FORM')
            ->select(['modules.id', 'modules.name', 'modules.text']);
    }

    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'user_companies', 'user_id', 'company_id')->with(['departments'])->select(['*', 'user_companies.company_id']);
    }
}
