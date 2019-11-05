<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
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
}
