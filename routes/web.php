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

//Generals
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//User
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/profile/{id}', 'UserController@profile')->name('profile'); //User profile details
Route::get('/people/{search?}','UserController@index')->name('user.index'); //people list

//Image
Route::get('/subir-imagen','ImageController@create')->name('image.create'); //View upload image
Route::post('/image/save','ImageController@save')->name('image.save'); //Upload image method
Route::get('/image/file/{filename}','ImageController@getImage')->name('image.file'); //get one image
Route::get('/imagen/{id}','ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}','ImageController@delete')->name('image.delete');
Route::get('/edit/{id}','ImageController@edit')->name('image.edit');
Route::post('/image/update','ImageController@update')->name('image.update');//Update image method

//Comments
Route::post('/comment/save','CommentController@save')->name('comment.save');//save comment
Route::get('/comment/delete/{id}','CommentController@delete')->name('comment.delete'); //delete comment


//Likes
Route::get('/like/{image_id}','LikeController@like')->name('like.save'); //like a image
Route::get('/dislike/{image_id}','LikeController@dislike')->name('like.delete');//dislike image
Route::get('/likes', 'LikeController@index')->name('likes.index');//All user likes post
