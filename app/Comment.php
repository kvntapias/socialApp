<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    //*-1 users
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

     //*-1 images
     public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
}
