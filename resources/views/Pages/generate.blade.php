@extends('layouts.app')

@section('content')

<div class ="container">
    {{-- <div class="row justify-content-center"> --}}
    <div class="row" style="height: 80vh">
        <div class="d-flex flex-column justify-content-around align-items-center">
            <img src="http://localhost/LaravelMongoDB/integdoc/public/../storage/Done.svg" width="50%" height="50%">
            <h1 class="bd-title font-weight-bold text-success">Petición generada exitosamente</h1>
            <p class="text-justify h3">
                La petición del documento <span class="font-weight-bold">{{$optionselected}}</span> se ha generado correctamente. 
                Cuando el archivo se haya generado se le enviará una notificacion al siguiente correo electrónico: <span class="font-weight-bold">{{$mail}}</span>
            </p>
            <div style="width:10vw">                               
                <a href="{{route('home')}}" class="btn btn-primary btn-lg btn-block"> OK </a>
            </div>
        </div>
    </div>
</div>

@endsection
