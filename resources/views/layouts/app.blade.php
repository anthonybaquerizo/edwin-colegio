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
    <nav class="navbar navbar-expand-md navbar-light text-white bg-primary shadow-sm">
        <div class="container-fluid">
            <div class="w-100 d-flex align-content-center justify-content-between" >
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6" >
                    <span><i class="fa fa-phone" ></i> (01) 283-1956</span>
                    <span class="ml-3" ><i class="fa fa-envelope" ></i> informes@epmagister.edu.pe</span>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 text-right" >
                    <a href="#" class="mr-3" >
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAb1BMVEU6VZ////82Up4zUJ1UbKx4ibswTpyMmsQ5V6EtTJupss8nSJnN0+WVosgqSpo4U56eqcyDksDj5vBwgbb3+PxFXqNabqt9jb3S2OhidbC9xdy3v9l0hLjZ3etLY6bq7fTEyt4dQpdJYqekrs2uttK97JEgAAADFUlEQVR4nO3c2XLiMBBAUUZmM3IsFsNgSIAk/P83TsLzjCNbI3c3de9rqlw+BV7VZDIhIiIiIiIiIiIiIiIiIlJeCM4VxbzsrJDey8G50s/3h91ss3jp7LdJYii8262rbfPr545eem/753y9qWJwjypzwqJuT7E6i0JX7459fOaEvn3r5zMmLPy5r8+W0L9Gn15MCkO9GuAzJHSh9xFoS1hcrsOAVoTzdsghaEhYTAcDbQjdfjjQhDAshx6DRoShrhKAFoR+nQI0ICzaJKABYZlyEFoQ1p9pQPVCd0m4UJgQ+lsiULvQXVKB2oW+1ysZg8KwTAYqF5ZpF3sDQr99cqFLvJ3RL0y+2usXDnw1Y0YYUh58TQiL3X8Aql57Kvschs3xdF/9pftC8fphj3vSalZ6X5tbA/axJ5rtzhdBem+HVEeeaKq55s+po1DHAW/vJj+/yfdifdxX1OYX9LuwjxIejH5Fv3LTGOBJ8eXup+KEH056P4cXJby+S+9mQlHCUy29mwlFCddz6d1MKEq4sXsmjRTOEGoOIUL9IUSoP4QI9YcQof4QItQfQoT6Q4hQR27+78qYucRX37GFR7Jrb65ddBQz1Hbv2sCjpSixvEcgEitlhcN+cNenRnZxagThm+wK6ghC4TXiEYSr8tmFwstvIwhb2XX+EYR72St+fmEj6htDuBW+a8svPArPauQXnp9e+CI8jZJfKP38mF8ofDnML2wuwsOn2YVX6ena7MKt9PRpduHt6YUr6eHM7MKF9HBmduGr9OvU7MKp9BR4bmEjDcwulJ9zzy2U/+1hbqH0s1N+4afsq8QRhPKT/LmFB+kb7+xC6Tua7ELhdacRhOLPTtmFCv7ZQOY14LP4xWISlh2FqFkM17UF8VPpF7Hjb3HTJl2nSwXAzp5jnqYrhAj1hxCh/hAi1B9ChPpDiFB/CBHqDyFC/SFEqD+ECPWHEKH+ECLUH0KE+kOIUH8IEeoPIUL9IUSoP4QI9YcQof4QItQfQoT6Q4hQfwgR6g8hQv0hRKg/hAj1hxCh/hAi1B9ChD36A+1ASVvVoq0WAAAAAElFTkSuQmCC"
                            alt="Facebook" width="24" height="24" >
                    </a>
                    <a href="#" class="mr-3" >
                        <img
                            src="http://assets.stickpng.com/images/58e9196deb97430e819064f6.png"
                            alt="Twitter" width="24" height="24" >
                    </a>
                    <a href="#" class="mr-3" >
                        <img
                            src="data:image/jpeg;base64,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"
                            alt="Twitter" width="24" height="24" >
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ url('logo_02.jpg') }}" alt="Logo" style="width: 45px; height: 45px" >
                I.E.P MAGISTER
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
                        @if (Auth::user()->user_type_id == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('teacher.courses') }}">
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
{{--                                    <a class="dropdown-item" href="#">--}}
{{--                                        <i class="fa fa-bullhorn"></i> Publicidad--}}
{{--                                    </a>--}}
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
