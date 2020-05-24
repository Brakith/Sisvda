<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container py-3">
                <a class="navbar-brand font-weight-bold d-flex align-items-center" style="height: 5vh" href="{{ url('/') }}">
                    {{--  <img src="{{asset('/../storage/ImagenesUniversidades/EPN.png')}}" width="60" height="60" class="d-inline-block align-top" alt="">  --}}
                    <img src="{{asset('img/ImagenesUniversidades/EPN.png')}}" width="45" height="45" class="d-inline-block align-top" alt="">
                    {{--  <img src="{{storage_path('ImagenesUniversidades\EPN.png')}}" width="60" height="60" class="d-inline-block align-top" alt="">  --}}
                    Inicio
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item mx-3">
                                <a class="btn btn-light text-dark shadow-sm" href="{{ route('documentlist.form') }}">Solicitar documentos</a>
                            </li>
                            <li class="mx-3">
                                <a class="btn btn-outline-light" href="{{ route('home') }}">Listados de documentos</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('testpdf') }}">PDF</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('email') }}">Enviar email</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('crud') }}">CRUD</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('post.form') }}">Insert</a>
                            </li> --}}
                            <li class="nav-item dropdown ml-3">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-1">
            @yield('content')
        </main>
    </div>
</body>
</html>
