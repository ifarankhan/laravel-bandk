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
        'name', 'email', 'password','department_id'
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
        return $this->hasManyThrough(Roles::class, UserRoles::class, 'user_id', 'id')->select(['roles.id', 'roles.name']);
    }
    public function modules()
    {
        return $this->hasManyThrough(Modules::class, UserModules::class, 'user_id', 'id')->select(['modules.id', 'modules.name']);
    }
}
