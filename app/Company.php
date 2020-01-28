<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
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

    protected static function boot()
    {
        static::deleting(function ($instance) {
            if(count($instance->departments) > 0) {
                $instance->departments->each->delete();
            }
        });

        /*static::restoring(function ($instance) {
            $instance->child->each->restore();
        });*/
    }

}
