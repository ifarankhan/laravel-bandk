<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'description', 'category_id', 'customer_id'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->select(['id', 'title']);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
