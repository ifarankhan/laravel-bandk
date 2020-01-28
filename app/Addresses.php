<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addresses extends Model
{
    use SoftDeletes;
    public function subAddresses()
    {
        return $this->hasMany(Addresses::class, 'parent_id', 'id')->select(['id', 'address', 'parent_id']);
    }

    public function getParentIdAttribute()
    {
        return -1;
    }
}
