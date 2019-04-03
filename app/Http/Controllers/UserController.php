<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function config(){
        return view('user.config');
    }

    //metodo actualizar usuario
    public function update(Request $req){
        //usuario identificado
        $user =  \Auth::user();
        $id = \Auth::user()->id;
        //validar formulario
        $validate = $this->validate($req,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        ]);
        //obtener datos del form
        $name = $req->input('name');
        $surname = $req->input('surname');
        $nick = $req->input('nick');
        $email = $req->input('email');
        
        //asignar valores al objeto usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //image user
        $image_path = $req->file('image_path');
        if ($image_path) {
            //nombre unico time function
            $image_path_name =  time().$image_path->getClientOriginalName();
            //almacenarla en la carpeta users
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            //setear atributo imagen al usuario
            $user->image = $image_path_name;
        }

        //ejecutar cambios a la bd
            $user->update();
            return redirect()->route('config')
                //mensaje de respuesta
                ->with(['message' => 'Usuario actualizado']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
