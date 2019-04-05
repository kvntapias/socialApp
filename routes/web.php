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
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');

Route::get('/subir-imagen','ImageController@create')->name('image.create');
Route::post('/image/save','ImageController@save')->name('image.save');


Route::get('/image/file/{filename}','ImageController@getImage')->name('image.file');

Route::get('/imagen/{id}','ImageController@detail')->name('image.detail');

Route::post('/comment/save','CommentController@save')->name('comment.save');

Route::get('/comment/delete/{id}','CommentController@delete')->name('comment.delete');
