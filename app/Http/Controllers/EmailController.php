<?php

namespace App\Http\Controllers;

use App\Mail\DocumentoGeneradoExitosamente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    public function email(){
        return view('email.sendemail');
    }

    // Enviar email
    public function sendemail(Request $request){
        // return $request->all();
        // valiaciones
        $DatosEmail = $request->validate([
            'email'=>'required',
            'asunto'=>'required',
            'cuerpo'=>'required'
        ]);

        // $data = array(
        //     'name' => $request->cuerpo,
        //     'asunto' => $request->asunto,
        //     'email' => $request->email
        // );

        
        // Mail::send('email.body', $data, function ($message) {
        //     $message->from('osita@gmail.com', 'Eduardo');
        //     // $message->sender('john@johndoe.com', 'John Doe');
        
        //     $message->to('guzmandans@gmail.com', 'Moni osita');
        
        //     // $message->cc('john@johndoe.com', 'John Doe');
        //     // $message->bcc('john@johndoe.com', 'John Doe');
        
        //     // $message->replyTo('john@johndoe.com', 'John Doe');
        
        //     $message->subject('Test2');
        
        //     // $message->priority(3);
        
        //     // $message->attach('pathToFile');
        // });
        
        // Dentro de send mando un mailable que es una clase para representar cadatipo de email.
        // El nombre de la clase es el asunto del email
        Mail::to($request->email)->send(new DocumentoGeneradoExitosamente($DatosEmail));
        
        return back()->with('mensaje','Email enviado!');
    }


}
