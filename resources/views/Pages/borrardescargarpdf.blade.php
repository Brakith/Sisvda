@extends('layouts.app')

@section('content')

<div class ="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Centro de Descargas</h1>
            

            <a href="{{$PathPDF}}" class="btn btn-primary"> Descargar el documento académico </a>
        </div>
    </div>
</div>

@endsection
