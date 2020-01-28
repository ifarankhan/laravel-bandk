<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departments extends Model
{
    use SoftDeletes;
    public function addresses()
    {
        return $this->hasMany(Addresses::class, 'department_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    protected static function boot()
    {
        static::deleting(function ($instance) {
            if(count($instance->addresses) > 0) {
                $instance->addresses->each->delete();
            }
        });
    }

}
