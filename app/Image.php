<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';
    // 1-* COMMENTS
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    //1-* LIKES
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //*-1 
    public function user(){
        return $this->hasMany('App\User', 'user_id');
    }
}
