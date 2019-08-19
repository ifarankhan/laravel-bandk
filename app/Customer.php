<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function claims()
    {
        return $this->hasMany(Claims::class, 'customer_id', 'id');
    }
    public function departments()
    {
        return $this->hasMany(Departments::class, 'customer_id', 'id')->with(['addresses']);
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'customer_id', 'id');
    }

    public function getLogoAttribute($value)
    {
        if(!is_null($value)) {
            return asset("/images/icons/".$value);
        }

        return null;

    }

}
