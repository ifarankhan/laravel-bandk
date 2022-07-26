<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimImages extends Model
{
    use SoftDeletes;
    protected $appends = ['image_path',];
    public function getImageAttribute($value)
    {
       $url =  asset('/images/'.$value);
       return $url;
    }

    public function getImagePathAttribute()
    {
        $imageName = $this->image;
        $imageName = explode('/', $imageName);
        $total = count($imageName);
        $imageName = $imageName[$total-1];
        return public_path('/images/'.$imageName);
    }
}
