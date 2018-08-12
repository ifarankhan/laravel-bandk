<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'description', 'category_id'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->select(['id', 'title']);
    }
}
