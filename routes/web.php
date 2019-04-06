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


//like save
Route::get('/like/{image_id}','LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}','LikeController@dislike')->name('like.delete');
//my likes pub 
Route::get('/likes', 'LikeController@index')->name('likes.index');

//user profile
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
//delete comments & likes and IMAGES
Route::get('/image/delete/{id}','ImageController@delete')->name('image.delete');

//edit image return view
Route::get('/edit/{id}','ImageController@edit')->name('image.edit');
//update image
Route::post('/image/update','ImageController@update')->name('image.update');
