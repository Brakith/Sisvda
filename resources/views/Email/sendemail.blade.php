@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4">Enviar email</h1>

            @if (session('mensaje'))
                <div class="alert alert-success">
                    {{session('mensaje')}}  
                </div>
            @endif

            <form action="{{route('sendemail')}}" method="POST">
                @csrf

                {{-- se ejecuta en caso de un error --}}
                @error('email')
                <div class="alert alert-danger">
                    El email es obligatoria
                </div>
                @enderror
                @error('asunto')
                    <div class="alert alert-danger">
                        El asunto es obligatorio
                    </div>
                @enderror
                @error('cuerpo')
                    <div class="alert alert-danger">
                        El cuerpo es obligatoria
                    </div>
                @enderror

                <input type="text" name="email" placeholder="Email" class="form-control mb-2" value="{{old('email')}}">
                <input type="text" name="asunto" placeholder="Asunto" class="form-control mb-2" value="{{old('asunto')}}">
                <input type="text" name="cuerpo" placeholder="Cuerpo" class="form-control mb-2" value="{{old('cuerpo')}}">
                <button class="btn btn-primary btn-block" type="submit">Enviar email</button>
            </form>
        </div>
    </div>
</div>

@endsection
