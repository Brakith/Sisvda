<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cedula = \Auth::user()->Cédula;
        // $posts = Post::where('created_by', 'like', '%'.$email.'%')->get();
        $posts = Document::where('UsuarioCédula',$cedula)->get();
        
        return view('home',compact('posts'));
        //return view('home');
    }

}
