<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'description', 'parent_id'];

    protected $appends = [
        'childrenCount'
    ];

    public function children()
    {
        return $this->hasMany(Content::class, 'parent_id', 'id')->select(['id','title', 'parent_id']);
    }

    public function parent()
    {
        return $this->belongsTo(Content::class, 'parent_id', 'id');
    }

    public function getChildrenCountAttribute()
    {
        return count($this->children);
    }
}
