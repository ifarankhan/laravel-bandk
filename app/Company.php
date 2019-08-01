<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function departments()
    {
        return $this->hasMany(Departments::class, 'company_id', 'id')->with(['addresses']);
    }

    public function getLogoAttribute($value)
    {
        if(!is_null($value)) {
            return asset("/images/icons/".$value);
        }

        return null;

    }

}
