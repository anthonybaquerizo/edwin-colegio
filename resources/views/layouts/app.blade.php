<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home')  }}">
                                <i class="fa fa-user"></i> Datos Básicos
                            </a>
                        </li>
                        @if (Auth::user()->user_type_id == 3)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.courses') }}">
                                    <i class="fa fa-school"></i> Asignatura Matriculada
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->user_type_id == 1)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuAdmin"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-secret"></i> Administrable
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuAdmin">
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-bullhorn"></i> Publicidad
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin.user.index', ['type' => 3])  }}">
                                        <i class="fa fa-list"></i> Lista de alumnos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.user.create', ['type' => 3]) }}">
                                        <i class="fa fa-plus"></i> Crear nuevo alumno
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin.user.index', ['type' => 2])  }}">
                                        <i class="fa fa-list"></i> Lista de profesores
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.user.create', ['type' => 2]) }}">
                                        <i class="fa fa-plus"></i> Crear nuevo profesor
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin.course.index')  }}">
                                        <i class="fa fa-list"></i> Lista de Cursos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.course.create') }}">
                                        <i class="fa fa-plus"></i> Crear nuevo curso
                                    </a>
                                </div>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @auth
                        <li class="nav-item">
                            <span class="nav-link active">
                                {{ Auth::user()->info->getName() }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt"></i> Cerrar Sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('script')

</body>
</html>
