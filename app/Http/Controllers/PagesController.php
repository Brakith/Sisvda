<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DocumentoGeneradoExitosamente;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon; //obtener fecha

use App\Document;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('descargarpdf');
    }

    public function documentlist(){

        return view('Pages.documentlist');
    }


    public function descargarpdf(Request $request ){
        $request->validate([
            'codigohash'=>'required'
        ]);

        $codigohash = $request->codigohash;
        // $documentos = false;

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
                        // View
                        // return response()->file($documento->RutaDocFinal);

                        // Descargar
                        return response()->download($documento->RutaDocFinal,$documento->TipoDocumento . '.pdf');
                        
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


    public function generate(Request $request ){

        $MyTimeNow = Carbon::now();
        $optionselected = $request->exampleRadios;
        $cedula = \Auth::user()->Cédula;
        $name = \Auth::user()->name;
        $NumeroMaxDocumentos = \Auth::user()->NúmeroMáximoDocumentos;
        $PeriodoActual = \Auth::user()->PeriodoActual;
        $mail = \Auth::user()->email;
        $PathCompletoDocumento = storage_path() . DIRECTORY_SEPARATOR . 'Documentos generados' . DIRECTORY_SEPARATOR .  $cedula . DIRECTORY_SEPARATOR . $optionselected . '.pdf';
        $PathDocumento = storage_path() . DIRECTORY_SEPARATOR . 'Documentos generados' . DIRECTORY_SEPARATOR .  $cedula . DIRECTORY_SEPARATOR;
        $PathDocumentoFinal = $PathDocumento . 'ConHash' . DIRECTORY_SEPARATOR;
        $PathCompletoDocumentoFinal = $PathDocumentoFinal . $optionselected . '.pdf';
        $Genero = \Auth::user()->Género;

        // INFORMACIÓN SOBRE PATHS
        // Modificaciones en archivo .env
        // Influye en el path que se envia en el email de recuperacion de contraseña y en request(root)
        // APP_URL=http://localhost/LaravelMongoDB/integdoc/public
        // Influye al usar el helper asset
        // ASSET_URL=http://example.com/assets
          
     
        // Verifico que exista el path caso contrario lo creo, ya que si no existe al guardar el pdf da error
        if (!file_exists($PathDocumento)) {
            //"Creo carpeta";
            // 755>> Todo para el propietario, lectura y ejecución para los otros (acceso para el propietario, el grupo de usuarios al que pertenece el propietario, y para todos los demás. El número 1 significa que se conceden derechos de ejecución, el número 2 significa que se puede escribir en el fichero, el número 4 significa que el fichero se puede leer.)
            if(!mkdir($PathDocumento, 0755, true)) {
                die('Fallo al crear las carpetas...');
            }
        }


        if (!file_exists($PathDocumentoFinal)) {
            if(!mkdir($PathDocumentoFinal, 0755, true)) {
                die('Fallo al crear las carpetas...');
            }
        }


        // ********************TEST
        
        // echo asset('..' . \Auth::user()->UniversidadRutaImagen);
        // echo asset('css/app.css') .'<br>';
        // echo asset('js/app.js') .'<br>';
        // echo asset('storage') .'<br>';

        // echo \Auth::user()['Materias'][0]['Nombre'];

        // probar con qhere
        // $materias = \Auth::user()['Materias']->where;

        // // Desplegar informacion de todas las materiaas
        // $materias = \Auth::user()['Materias'];
        // echo var_dump($materias) . '<br> xxxxxxxxxxxxx';

        // $materias = \Auth::user()->Materias;
        // echo var_dump($materias) . '<br>';
        // foreach($materias as $RegistroMateria){
        //     echo '--------------------------';
        //     echo '<br>';
        //     echo $RegistroMateria['Nombre'];
        //     // foreach($RegistroMateria as $CampoRegistroMateria){
        //     //     echo $CampoRegistroMateria['Nombre'];
        //     //     echo '<br>';
        //     // }
        // }


        //    tengo que pasar el array completo
        // $print = User::whereRaw(['Materias' => ['Nombre'=>'Calculo Vectorial']])->get();
        // echo $print;

        // // Añadir un documeno anidado (No termino pruebas)
        // $user = User::first();

        // $book = $user->books()->save(
        //     new Book(['title' => 'A Game of Thrones'])
        // );

        // // Query doc anidad
        // $DocumentosTotales = user::where('email',\Auth::user()->email)->where('Materias.Periodo', \Auth::user()->PeriodoActual)->get(['Materias.Periodo']);
        // echo $DocumentosTotales;

        // // Proyecciones
        // echo '<br>';
        // $proye = User::collection('users')->proyect(['email' => 1])->get();
        // echo $proye;






        // Verificar si es posible generar el documento solicitado
        switch ($optionselected) {
            case 'Certificado de aprobación de plan de estudios':
                if(\Auth::user()->CréditosAprobados == \Auth::user()->CréditosTotalesCarrera){
                    // echo 'Certificado de aprobación de plan de estudios Puede generar el documento ';
                    $ExisteDatosDisponibles = true;
                    // echo user::orderBy('Materias.Materia_id','desc')->get();
                }
                else
                {
                    return back()->with('mensaje','El estudiante todavía no ha culminado el plan de estudios');
                }
                break;

            case 'Certificado de créditos aprobados':
                $ExisteDatosDisponibles = true;
                $DataPDF = array(
                                 'CreditosAprobados' => \Auth::user()->CréditosAprobados
                                 );
                // echo 'OK';
                break;

            case 'Certificado de pertenecer a la Universidad':
                $EstaMatriculadoPeriodoActual = user::where('email',\Auth::user()->email)->where('Materias.Periodo', \Auth::user()->PeriodoActual)->get(['Materias.Periodo']);
                if(!$EstaMatriculadoPeriodoActual->isEmpty()){
                    // echo "El estudiante pertenece a la universidad";
                    $ExisteDatosDisponibles = true;
                }
                else
                {
                    return back()->with('mensaje','Usted no esta matriculado en el periodo ' . $PeriodoActual);
                }
                break;

            case 'Certificado de promedio general':
                // echo "OK Certificado de promedio general.blade";
                $ExisteDatosDisponibles = true;
                $DataPDF = array(
                    'Promedio' => \Auth::user()->Promedio
                    );
                break;

            case "Certificado de agotó segunda matrícula":
                $AgotoSegundaMatricula = user::where('email',\Auth::user()->email)->where('Materias.NúmeroMatricula', 2)->where('Materias.Estado', 'Fallido')->get(['Materias']);
                // echo $AgotoSegundaMatricula . '<br>';
                if(!$AgotoSegundaMatricula->isEmpty()){
                    // echo "El estudiante agoto su seguna matricula";
                    $ExisteDatosDisponibles = true;
                    $NombreMaterias = '';
                    foreach ($AgotoSegundaMatricula as $AgotoSegundaMatriculaRegistro){
                        // echo var_dump($AgotoSegundaMatriculaRegistro->Materias);
                        $materias = $AgotoSegundaMatriculaRegistro->Materias;
                        foreach($materias as $RegistroMateria){
                            if(($RegistroMateria['NúmeroMatricula']== 2)&&($RegistroMateria['Estado']=="Fallido")){
                                // $NombreMaterias = $NombreMaterias . ', ' . $RegistroMateria['Nombre'];
                                $AgotóSegundaPeriodo = $RegistroMateria['Periodo']; 
                            }
                        }
                    }
                    $DataPDF = array(
                        // 'MateriasAgotóSegunda' => $NombreMaterias
                        'AgotóSegundaPeriodo'=>$AgotóSegundaPeriodo
                        );
                }
                else
                {
                    return back()->with('mensaje','Usted no ha agotado segunda matrícula en el periodo:' . $PeriodoActual);
                }
                break;

            case "Certificado de agotó tercera matrícula":
                $AgotoSegundaMatricula = user::where('email',\Auth::user()->email)->where('Materias.NúmeroMatricula', 3)->where('Materias.Estado', 'Fallido')->get(['Materias']);
                if(!$AgotoSegundaMatricula->isEmpty()){
                    $ExisteDatosDisponibles = true;
                    $NombreMaterias = '';
                    foreach ($AgotoSegundaMatricula as $AgotoSegundaMatriculaRegistro){
                        $materias = $AgotoSegundaMatriculaRegistro->Materias;
                        foreach($materias as $RegistroMateria){
                            if(($RegistroMateria['NúmeroMatricula']=='3')&&($RegistroMateria['Estado']=="Fallido")){
                                $NombreMaterias = $NombreMaterias . ', ' . $RegistroMateria['Nombre'];
                                $AgotóTerceraPeriodo = $RegistroMateria['Periodo']; 
                            }
                        }
                    }
                    $DataPDF = array(
                        'AgotóTerceraMaterias' => $NombreMaterias,
                        'AgotóTerceraPeriodo'=>$AgotóTerceraPeriodo
                    );
                }
                else
                {
                    return back()->with('mensaje','Usted no ha agotado tercera matrícula en el periodo:' . $PeriodoActual);
                }
                break;

            case 'Histórico escolar':
                // echo "Histórico escolar.blade";
                $ExisteDatosDisponibles = true;
                $DataPDF = array(
                    'Materias' => \Auth::user()->Materias
                    );
                break;

            default:
                $ExisteDatosDisponibles = false;
        }


        // Verifica que e doc no se vuelva a generar el mismo dia
        $DocGeneradoHoy = Document::where('Fecha_creación', $MyTimeNow->toDateString())->where('UsuarioCédula',\Auth::user()->Cédula)->where('TipoDocumento',$optionselected)->get();
        if(!$DocGeneradoHoy->isEmpty()){
            return back()->with('mensaje','El documento ya se genero el día de hoy. Recuerde que solo se puede generar una vez al día cada tipo de documento.');
        }

        // Limite max de doc generados por periodo actual
        $NumeroDocsGenerados =  Document::where('UsuarioCédula',$cedula)->where('TipoDocumento',$optionselected)->where('PeriodoActual',$PeriodoActual)->count();
        if ($NumeroDocsGenerados >= $NumeroMaxDocumentos){
            return back()->with('mensaje','Se ha exedido el número máximo de documentos generados en el periodo: ' . $PeriodoActual . '. Recuerde que usted puede generar máximo ' . $NumeroMaxDocumentos.' documentos de cada tipo por periodo.');
        }
        else
        {
            $DataPDF['Nombres'] = \Auth::user()->name;
            $DataPDF['Apellidos'] = \Auth::user()->Apellidos;
            $DataPDF['Campus'] = \Auth::user()->Campus;
            $DataPDF['Carrera'] = \Auth::user()->Carrera;
            $DataPDF['CarreraPromedioEstudiantilActual'] = \Auth::user()->CarreraPromedioEstudiantilActual;
            $DataPDF['CarreraEstudiantePensum'] = \Auth::user()->CarreraEstudiantePensum;
            $DataPDF['Cédula'] = \Auth::user()->Cédula;
            $DataPDF['CoordinadorNombre'] = \Auth::user()->CoordinadorNombre;
            $DataPDF['CréditosAprobados'] = \Auth::user()->CréditosAprobados;
            $DataPDF['CréditosTotalesCarrera'] = \Auth::user()->CréditosTotalesCarrera;
            $DataPDF['CréditosFaltantes'] = \Auth::user()->CréditosTotalesCarrera - \Auth::user()->CréditosAprobados;
            $DataPDF['CréditosAprobadosPorcentaje'] = (\Auth::user()->CréditosAprobados / \Auth::user()->CréditosTotalesCarrera) * 100;
            $DataPDF['DecanoNombre'] = \Auth::user()->DecanoNombre;
            $DataPDF['Facultad'] = \Auth::user()->Facultad;
            $DataPDF['Promedio'] = \Auth::user()->Promedio;
            $DataPDF['Universidad'] = \Auth::user()->Universidad;
            // $DataPDF['UniversidadRutaImagen'] = asset('..' . \Auth::user()->UniversidadRutaImagen);
            $DataPDF['UniversidadRutaImagen'] = asset('img/ImagenesUniversidades/' . \Auth::user()->UniversidadRutaImagen);
            // $DataPDF['UniversidadRutaImagen'] =storage_path()
            $DataPDF['UniversidadDirección'] = \Auth::user()->UniversidadDirección;
            $DataPDF['Fecha_creación'] = $MyTimeNow->toDateString();
            $DataPDF['FechaHora_creación'] = $MyTimeNow->toDateTimeString();
            $DataPDF['PeriodoActualFecha'] = \Auth::user()->PeriodoActualFecha;
            $DataPDF['TítuloObtenido'] = \Auth::user()->TítuloObtenido;
            $DataPDF['URLSistema'] = $request->root(); 
            $DataPDF['CódigoHash'] = false;
            if ($Genero == "Masculino"){
                $DataPDF['SeñorOSeñoritaMayuscula'] = 'El señor';
                $DataPDF['SeñorOSeñorita'] = 'el señor';
            }
            else
            {
                $DataPDF['SeñorOSeñoritaMayuscula'] = 'La señorita';
                $DataPDF['SeñorOSeñorita'] = 'la señorita';
            }
            
            // echo var_dump($DataPDF);


            // Crea PDF
            $pdf = PDF::loadView('Documents.'.$optionselected,compact('DataPDF'))->save($PathCompletoDocumento);


            //Genero codigo hash del PDF
            $DataEmail = array(
                'codigohash' => hash_file('sha256', $PathCompletoDocumento),
                'documento' => $optionselected,
                'PathCompletoDocumento' => $request->root() 
            );


            $DataPDF['CódigoHash'] = $DataEmail['codigohash'];


            // Crea PDF con hash
            $pdf = PDF::loadView('Documents.'.$optionselected,compact('DataPDF'));
            $pdf->save($PathCompletoDocumentoFinal);

            // // // test
            // return view('Documents.'.$optionselected,compact('DataPDF'));

            // Averiguo si ya existe el registro en base de datos del documento si ya existe actualizo el registro caso contrario creo el registro
            $DocumentExistente = Document::where('UsuarioCédula',\Auth::user()->Cédula)->where('TipoDocumento',$optionselected)->take(1)->get();
            if(!$DocumentExistente->isEmpty()){
                $DocumentExistenteRegistro=Document::where('UsuarioCédula',\Auth::user()->Cédula)->where('TipoDocumento',$optionselected)->update(['FechaHora_creación' => $MyTimeNow->toDateTimeString(), 'CódigoHash' => $DataEmail['codigohash'],'PeriodoActual' => $PeriodoActual, 'Fecha_creación' => $MyTimeNow->toDateString()]);
            }
            else{
                // Creo el registro en BD
                $RegistrodocNuevo = new Document();
                $RegistrodocNuevo->UsuarioCédula = $cedula;
                $RegistrodocNuevo->TipoDocumento = $optionselected;
                $RegistrodocNuevo->CódigoHash = $DataEmail['codigohash'];
                $RegistrodocNuevo->RutaDocOriginal = $PathCompletoDocumento;
                $RegistrodocNuevo->RutaDocFinal = $PathCompletoDocumentoFinal;
                $RegistrodocNuevo->PeriodoActual = $PeriodoActual;
                $RegistrodocNuevo->FechaHora_creación = $MyTimeNow->toDateTimeString();
                $RegistrodocNuevo->Fecha_creación = $MyTimeNow->toDateString();
                $RegistrodocNuevo->save();
            }
           



            // // Envio de mail
            // // Dentro de send mando un mailable que es una clase para representar cadatipo de email.Por defecto El nombre de la clase es el asunto del email
            Mail::to($mail)->send(new DocumentoGeneradoExitosamente($DataEmail));
            return view('Pages.generate',compact('optionselected', 'mail'));
        }
    }
}
