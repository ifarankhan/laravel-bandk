<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
