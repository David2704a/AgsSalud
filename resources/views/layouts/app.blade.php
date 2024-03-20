@php
    use Illuminate\Support\Facades\Auth;
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/css/LayoutApp.css')}}">
    <link rel="shortcut icon" href="{{asset('imgs/logos/Ags.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{asset('css/Formulario.css')}}">
    <link rel="stylesheet" href="{{asset('css/userNav/userbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <title>@yield('title')</title>
</head>
<body>

<script>
    var urlBase = {!! json_encode(url('/')) !!}
</script>
<header >
    <div class="logo">
        <img src="{{asset('imgs/logos/Ags.png')}}" alt="Logo de la empresa">
    </div>
    <div class="home">
        <a href="{{url('/dashboard')}}" title="Inicio">
            <i class="fa-solid fa-house-flag"></i>
        </a>
    </div>

    <div class="user-menu">
        <button id="user-menu-button" class="user-menu-button">
            <div class="user-name" >
            @auth
        {{ Auth::user()->name }}
    @endauth
            </div>
            <div class="icon">
            <i class="material-symbols-outlined">expand_more</i>
        </div>
        </button>

        <!-- Opciones de usuario -->
        <div id="user-dropdown" class="dropdown-menu">
            <a class="perfiledit"  href="{{ route('ActualizarPerfil') }}">Perfil</a>


            <br>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button  class="btonCerrarSe" type="submit">Cerrar sesión</button>
            </form>

        </div>
    </div>
</header>

@yield('content')
@yield('links')


<script src="{{ asset('js/userNav/userbar.js') }}"></script>

<script src="{{ asset('js/select2.js')}}"></script>
<script src="{{ asset('js/select2.min.js')}}"></script>

<script src="{{asset('js/layout.js')}}"></script>

</body>
</html>
