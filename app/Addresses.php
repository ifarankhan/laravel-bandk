<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    public function subAddresses()
    {
        return $this->hasMany(Addresses::class, 'parent_id', 'id')->select(['id', 'address', 'parent_id']);
    }
}
