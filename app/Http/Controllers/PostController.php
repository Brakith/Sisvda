<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PostController extends Controller
{
    // lista de registros de la "tabla posts"
    public function index()
    {
        $posts = Post::all();
        
        return view('crud',compact('posts'));
        //return view('home');
    }

    public function pdf(){

        // primera forma
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Pdf generado EDGE</h1>');
        // return $pdf->download(); 

        $pdf = PDF::loadHTML('<h1>Pdf generado EDGE</h1>');
        $pdf->save(storage_path().'documento1.pdf');
        return $pdf->stream();//Abre en el navegador 


        // 2da forma USANDO FACADE
        // $pdf = PDF::loadView('PdfVista',compact('notas'));
        // $pdf->save(storage_path().'documento1.pdf');
        // return $pdf->stream();//Abre en el navegador 

        // $notas = App\Nota::all();
        // return view('PdfVista',compact('notas'));
    }

    public function documentlist($_id = false){
        if($_id){
            $data = Post::findOrFail($_id);
        }
        else
        {$data = false;}
        
        return view('documentlist',compact('data'));
    }

    public function generate(Request $request,$_id = false){
        if($_id){
            $data = Post::findOrFail($_id);
        }
        else
        {$data = false;}

        $optionselected = $request->exampleRadios;
        $mail = \Auth::user()->email;
        
        return view('generate',compact('data','optionselected', 'mail'));
    }

    public function form($_id = false){
        if($_id){
            $data = Post::findOrFail($_id);
        }
        else
        {$data = false;}
        
        return view('post.form',compact('data'));
    }

    public function save(Request $request){
        //dd($request); 
        //dd($request->title); 
        $data = new Post($request->all());
        $data->created_by = \Auth::user()->email;
        $data->save();
        
        if($data){
            return redirect()->route('crud');
        }
        else{
            return back();
        }
    }


    public function update(Request $request,$_id){
        //dd($request); 
        //dd($request->title); 
        $data = Post::findOrFail($_id);
        $data->title = $request->title;
        $data->content = $request->content;
        $data->save();
        
        if($data){
            return redirect()->route('crud');
        }
        else{
            return back();
        }
    }


    public function delete($_id){
        $data = Post::destroy($_id);
        if($data){
            return redirect()->route('crud');
        }
        else{
            dd('Error cannot delete this post');
        }
    }

}
