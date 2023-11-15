<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/css/LayoutApp.css')}}">
    <link rel="shortcut icon" href="{{asset('imgs/logos/Ags.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/Formulario.css')}}">
    <title>@yield('title')</title>
</head>
<body>


    <header>
        <div class="logo">
            <img src="{{asset('imgs/logos/Ags.png')}}" alt="Logo de la empresa">
        </div>
        <div class="home">
           <a href="/" title="Inicio">
            <i class="fa-solid fa-house-flag"></i>
        </a>
        </div>
        <div class="user-info">
            <div class="notifications">
                <i class="fas fa-bell"></i>
            </div>
            <div class="user-profile">
                <img src="user-avatar.jpg" alt="Foto de perfil del usuario" class="user-avatar">
                <span class="user-name">Nombre de Usuario</span>
            </div>
        </div>
    </header>


    <div class="container">
        @yield('content')
        @yield('links')
     </div>








</body>
<script src="{{asset('js/layout.js')}}"></script>
</html>
