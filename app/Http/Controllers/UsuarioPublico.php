<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

// Modelos
use App\Document;
use App\User;


class UsuarioPublico extends Controller
{
    public function descargarpdf(Request $request ){
        $request->validate([
            'codigohash'=>'required'
        ]);

        $codigohash = $request->codigohash;

        // recaptcha code
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $data = [
                'secret' => config('services.recaptcha.secret'),
                'response' => $request->get('recaptcha'),
                'remoteip' => $remoteip
            ];
        $options = [
                'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
                ]
            ];
        $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $resultJson = json_decode($result);
        if ($resultJson->success != true) {
                return back()->with('mensaje', 'El servidor de google Recaptcha tiene intermitencia por favor intente más tarde.');
                }
        if ($resultJson->score <= 0.3) {
                return back()->with('mensaje', 'ReCaptcha Error: Alerta de bot');
        } else {
            //Validation was successful, add your form submission logic here
            $documentos =Document::where('CódigoHash', $codigohash)->take(1)->get();

            if($documentos->isEmpty()){
                return back()->with('mensaje','El código no es valido');
            }
            else
            {
                foreach ($documentos as $documento){
                    // Verifíca que el documento no se haya reemplazado en la carpeta del servidor
                    $CodigoHashRespaldo = hash_file('sha256', $documento->RutaDocOriginal);

                    $Usuarios = User::where('Cédula',$documento->UsuarioCédula)->get();
                    foreach ($Usuarios as $Usuario){
                        $DataPDF = array(
                            'Nombres' => $Usuario->name,
                            'Apellidos' => $Usuario->Apellidos,
                            'Campus' => $Usuario->Campus,
                            'Carrera' => $Usuario->Carrera,
                            'Cédula' => $Usuario->Cédula,
                            'CoordinadorNombre' => $Usuario->CoordinadorNombre,
                            'CréditosAprobados' => $Usuario->CréditosAprobados,
                            'CréditosTotalesCarrera' => $Usuario->CréditosTotalesCarrera,
                            'DecanoNombre' => $Usuario->DecanoNombre,
                            'Facultad' => $Usuario->Facultad,
                            'Promedio' => $Usuario->Promedio,
                            'Universidad' => $Usuario->Universidad,
                            'CódigoHash' =>$documento->CódigoHash
                            );
                    }

                    if ($CodigoHashRespaldo == $documento->CódigoHash){
                        if (Auth::check())
                        {
                            // echo "inicio sesion";
                            // Documento entregable
                            return response()->file($documento->RutaDocFinal);
                        }
                        else 
                        {
                            //  "No inicio sesion";
                            // Documento original
                            return response()->file($documento->RutaDocOriginal);
                        }

                        // Descargar
                        // return response()->download($documento->RutaDocFinal,$documento->TipoDocumento . '.pdf');
                        
                    }
                    else{
                        // echo "archivo fue reemplazado";
                        $pdf = PDF::loadView('Documents.'.$documento->TipoDocumento,compact('DataPDF'));
                        $pdf->save($documento->RutaDocFinal);
                        // return $pdf->stream();
                        return $pdf->download();
                    }
                }
            }      
        }
    }
}
