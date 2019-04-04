<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {   
        //Obtener todas las imagenes y ordenarlas
        $images = Image::orderBy('id','desc')->paginate(5);
        //retornar vista con array de datos
        return view('home',[
            'images'=>$images
            ]);
    }
}
