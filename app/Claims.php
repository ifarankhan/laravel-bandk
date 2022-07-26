<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claims extends Model
{
    use SoftDeletes;
    protected $fillable = ['claim_type_id', 'estimate', 'date', 'claim_mechanic_id', 'is_updated','company_id',
        'department_id', 'address_1', 'address_2', 'description', 'status', 'user_id', 'customer_id', 'rekv_nummer', 'is_damage_inspected', 'selsskab_skade_nummer'];

    protected $dates = ['deleted_at'];

    public function conversations()
    {
        return $this->hasMany(ClaimConversation::class, 'claim_id', 'id')->orderBy('created_at', 'DESC');
    }
    public function type()
    {
        return $this->belongsTo(ClaimTypes::class, 'claim_type_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id', 'id');
    }
    public function mechanicsType()
    {
        return $this->belongsTo(ClaimMechanics::class, 'claim_mechanic_id', 'id');
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
            return date('d-m-Y', strtotime($value));
        }
        return $value;
    }
    public function getIsDamageInspectedAttribute($value)
    {
        return (boolean)$value;
    }
    public function getCreatedAtAttribute($value)
    {
        if ($value) {
            return date('d-m-Y', strtotime($value));
        }
        return $value;
    }
    public function getUpdatedAtAttribute($value)
    {
        if ($value) {
            return date('d-m-Y', strtotime($value));
        }
        return $value;
    }

    protected static function boot()
    {
        static::deleting(function ($instance) {
            if(count($instance->conversations) > 0) {
                $instance->conversations->each->delete();
            }

            if(count($instance->images) > 0) {
                $instance->images->each->delete();
            }
        });
    }
}
