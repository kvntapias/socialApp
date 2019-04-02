<?php
use App\Image;


Route::get('/', function () {
    /* $images = Image::all();

    foreach ($images as $image) {
        //echo $image->id.'<br>';
        echo $image->description.'<br>';
        echo$image->user->name.' '.$image->user->surname .'<br>';

        if (count($image->comments) > 0 ) {
            echo '<strong>Comments</strong><br>';
            foreach ($image->comments as $comment) {
                echo $comment->content.'<br>';
                echo "By: ".$comment->user->name;
            }
        }else{
            echo '<strong>No comments yet</strong><br>';
        }
        echo "Likes: ".count($image->likes);
        echo '<hr>';
    }
    die(); */
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
