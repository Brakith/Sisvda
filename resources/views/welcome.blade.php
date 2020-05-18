<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SISVDA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">

        {{-- script --}}
        <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    </head>
    <body>
        @if (session('mensaje'))
            <div class="alert">
                {{session('mensaje')}}
            </div>
         @endif

        {{-- sub menu login --}}
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links d-flex">
                    @auth
                        <a href="{{ url('/home') }}">Listado de documentos</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>


        <img class="wave" src="{{ asset('img/wave.png') }}">
        <img class="wavesmall" src="{{ asset('img/wave2.png') }}">
        <div class="divtitle">
            <h1 class="title">Sistema de verificación de documentos académicos</h1>
        </div>

        {{-- body --}}
        <div class="container">
            <div class="img">
                <img src="{{ asset('img/bg.svg') }}">
            </div>
            <div class="login-content">
                <form action="{{route('descargarpdf')}}" method="post">
                    @csrf
                    @error('codigohash')
                        <div class="alert">
                            Ingrese un código, no deje vacío el campo
                        </div>
                    @enderror
                    <img src="{{ asset('img/Candado.png') }}">
                    <h2 class="title">Para descargar un documento ingrese el código respectivo</h2>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                                <h5>Código</h5>
                                <input type="text" class="input" name="codigohash">
                        </div>
                    </div>
                    <p align="center"><button class="btn">Descargar</button></p>
                </form>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
    </body>
</html>
