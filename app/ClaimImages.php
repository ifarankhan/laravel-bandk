<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimImages extends Model
{
    public function getImageAttribute($value)
    {
       $url =  asset('/images/'.$value);
       return $url;
    }
}
