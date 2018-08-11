<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'description', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Content::class, 'parent_id', 'id');
    }
}
