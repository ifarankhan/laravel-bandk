<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    protected $fillable = ['claim_type_id', 'estimate', 'date', 'claim_mechanic_id',
        'department_id', 'address_1', 'address_2', 'description', 'status', 'user_id'];
}
