<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    protected $fillable = ['claim_type_id', 'estimate', 'date', 'claim_mechanic_id',
        'department_id', 'address_1', 'address_2', 'description', 'status', 'user_id'];

    public function conversations()
    {
        return $this->hasMany(ClaimConversation::class, 'claim_id', 'id')->orderBy('created_at', 'DESC');
    }
    public function type()
    {
        return $this->belongsTo(ClaimTypes::class, 'claim_type_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id', 'id');
    }
    public function address1()
    {
        return $this->belongsTo(Addresses::class, 'address_1', 'id');
    }
    public function images()
    {
        return $this->hasMany(ClaimImages::class, 'claim_id', 'id');
    }
    public function getDateAttribute($value)
    {
        if ($value) {
            return date('Y-m-d', strtotime($value));
        }
        return $value;
    }
}
