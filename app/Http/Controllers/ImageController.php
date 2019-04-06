<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $req){
        $image = new Image();

        //validar
        $validate = $this->validate($req, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);
        $description = $req->input('description');
        $image_path = $req->file('image_path');
        
        //asignar valores
        $user = \Auth::user();
        $image->user_id = $user->id;

        $image->description = $description;
        
        //subir imagen
        if ($image_path) {
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')
                ->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        $image->save();
        return redirect()->route('home')->with([
            'message' => 'La foto ha sido subida'
        ]);
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image/detail',[
            'image' => $image
        ]);
    }

    public function delete($id){
        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if ($user && $image && $image->user->id == $user->id){
            //eliminar commentarios
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            //eliminar likes
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            //eliminar ficheros de imagen
            Storage::disk('images')->delete($image->image_path);
            //eliminar registro de db
            $image->delete();
            $message = array('message' => 'La imagen se ha eliminado');
        }else{
            $message = array('message' => 'La 
            imagen no se ha eliminado');
        }
        return redirect()->route('home')->with($message);
    }
}
