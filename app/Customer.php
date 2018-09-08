<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function claims()
    {
        return $this->hasMany(Claims::class, 'customer_id', 'id');
    }

}
