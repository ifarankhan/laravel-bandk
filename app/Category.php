<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'parent_id', 'icon', 'color', 'customer_id', 'show_on_frontend'];
    protected $dates = ['deleted_at'];
    protected $appends = [
        'childrenCount'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->select(['id','title', 'parent_id', 'show_on_frontend']);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function getChildrenCountAttribute()
    {
        return count($this->children);
    }
    public function getIconAttribute($value)
    {
        if(!is_null($value)) {
            return asset("/images/icons/".$value);
        }

        return null;

    }
    public function getParentIdAttribute($value)
    {
        if(!is_null($value)) {
            return $value;
        }
        return -1;
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'category_id', 'id')->select(['id', 'category_id', 'description', 'title', 'customer_id']);
    }
}
