<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'parent_id', 'icon'];

    protected $appends = [
        'childrenCount'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->select(['id','title', 'parent_id']);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function getChildrenCountAttribute()
    {
        return count($this->children);
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'category_id', 'id')->select(['id', 'category_id', 'description', 'title']);
    }
}
