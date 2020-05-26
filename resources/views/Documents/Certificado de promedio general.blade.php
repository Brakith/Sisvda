@extends('layouts.DocumentLayout')

@section('content')

    <footer>      
        <div>
            <div class="footer-title">Código de autenticidad</div>
            <div class="footer-p">
                Verifique la autenticidad de este documento ingresando a la pagina  <span class="font-weight-bold">{{$DataPDF['URLSistema']}}</span>  e ingresado el siguiente codigo: 
            </div>
            <div class="footer-hash">{{$DataPDF['CódigoHash']}}</div>

            <div>
                SISVDA
                <br>
                {{$DataPDF['Universidad']}}
                <br>
                {{$DataPDF['UniversidadDirección']}}
                <br>
                {{$DataPDF['URLSistema']}}
            </div>
        </div>
    </footer>

    <img class="float-left"  src="{{ $DataPDF['UniversidadRutaImagen'] }}" width="50" height="50">
    <img class="float-right" src="{{ $DataPDF['UniversidadRutaImagen'] }}" width="50" height="50">

    <div class="container">
       <h5 class="header-title">{{$DataPDF['Universidad']}}</h5>
        <h6 class="header-comment">Campus {{$DataPDF['Campus']}}</h6>
        <h6 class="header-subtitle">Facultad de {{$DataPDF['Facultad']}}</h6>
        <h6 class="header-subtitle">Carrera de {{$DataPDF['Carrera']}}</h6>
        <h6 class="header-date">{{$DataPDF['Fecha_creación']}}</h6>
        <br>
        <h4 class="title">CERTIFICO</h4>
        <br>
        {{-- Cuerpo del certificado --}}
        <p>
            Que {{$DataPDF['SeñorOSeñorita']}} {{$DataPDF['Nombres']}} {{$DataPDF['Apellidos']}}, con cédula {{$DataPDF['Cédula']}} estudiante de la Carrera de {{$DataPDF['Carrera']}} tiene un promedio de {{$DataPDF['Promedio']}} sobre 10. 
            <br>
            <br>
            Cabe mencionar que en el período actual {{$DataPDF['PeriodoActualFecha']}} el Promedio de la Carrera es de {{$DataPDF['CarreraPromedioEstudiantilActual']}}.            
            <br>
            <br>
            {{$DataPDF['SeñorOSeñoritaMayuscula']}} {{$DataPDF['Nombres']}} {{$DataPDF['Apellidos']}}, puede hacer uso de esta certificación para los fines que considere conveniente.
        </p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        
        {{-- Firma --}}
        <div class="text-center">
            <span class="font-size-1rem"> {{$DataPDF['CoordinadorNombre']}} </span> <br>
            <span class="font-size-1rem font-weight-bold"> COORDINADOR </span>
        </div>
        
    </div>
   
@endsection
