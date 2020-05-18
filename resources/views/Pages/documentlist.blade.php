@extends('layouts.app')

@section('content')

@if (session('mensaje'))
<div class="alert alert-danger">
    {{session('mensaje')}}  
</div>
@endif

<div class ="container">
        <div class="row justify-content-center">
                <div class="col-md-5 h5">
                        <div class="h4 font-weight-bold text-center my-5">Escoja el documento que quiere solicitar</div>
                        <form action="{{route('generate.form')}}" method="POST">
                                @csrf
                                <div class="form-check d-flex flex-column justify-content-around" style="height: 60vh">
                                        <div>
                                                <input class="form-check-input" type="radio" name="exampleRadios" value="Certificado de aprobación de plan de estudios" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                        Certificado de aprobación de plan de estudios
                                                </label>
                                        </div>
                                        <div>
                                                <input class="form-check-input" type="radio" name="exampleRadios" value="Histórico escolar" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                        Histórico escolar
                                                </label>
                                        </div>
                                        <div>
                                                <input class="form-check-input" type="radio" name="exampleRadios" value="Certificado de promedio general" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                        Certificado de promedio general
                                                </label>
                                        </div>
                                        <div>
                                                <input class="form-check-input" type="radio" name="exampleRadios" value="Certificado de créditos aprobados" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                        Certificado de créditos aprobados
                                                </label>
                                        </div>
                                        <div>
                                                <input class="form-check-input" type="radio" name="exampleRadios" value="Certificado de pertenecer a la Universidad" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                        Certificado de pertenecer a la Universidad
                                                </label>
                                        </div>
                                        <div>
                                                <input class="form-check-input" type="radio" name="exampleRadios" value="Certificado de agotó segunda matrícula" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                        Certificado de agotó segunda matrícula
                                                </label>
                                        </div>
                                        <div>
                                                <input class="form-check-input" type="radio" name="exampleRadios" value="Certificado de agotó tercera matrícula" checked>
                                                <label class="form-check-label" for="exampleRadios2">
                                                        Certificado de agotó tercera matrícula
                                                </label>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                                <div style="width:200px">
                                                        <button class="btn btn-primary btn-lg btn-block mt-5">Siguiente</button>                                   
                                                </div>
                                        </div>
                                </div>
                        </form>
                </div>
        </div>
</div>

@endsection
