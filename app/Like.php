<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    //*-1 users
    public function user(){
        return $this->hasMany('App\User', 'user_id');
    }

     //*-1 images
     public function image(){
        return $this->hasMany('App\Image', 'image_id');
    }
}
