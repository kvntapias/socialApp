<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function save(Request $req){
        $user = \Auth::user();
        $image_id = $req->input('image_id');
        $content = $req->input('content');

        //validacion
        $validate = $this->validate($req, [
            'image_id' => 'integer|required',
            'content'=> 'string|required'
        ]);
        //ASIGNAR datos   
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        $comment->save();

        return redirect()->route('image.detail', ['id'=> $image_id])
          ->with([
            'message' => 'Haz publicado un comentario'
          ]);
    }

    public function delete($id){
        //get user loged data
        $user = \Auth::user();
        //comment data
        $comment = Comment::find($id);
        //veriry if user owner or user comment owner
        if ($user && ($comment->user_id == $user->id ||
            $comment->image->user_id == $user->id)) {
            $comment->delete(); 
        return redirect()->route('image.detail', ['id'=> $comment->image->id])
            ->with([
            'message' => 'Se ha eliminado el comentario'
          ]);
        }else{
            return redirect()->route('image.detail', ['id'=> $comment->image->id])
            ->with([
            'message' => 'El comentario no se ha eliminado'
          ]);
        }
    }
}
