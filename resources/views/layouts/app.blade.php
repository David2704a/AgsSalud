<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/css/LayoutApp.css')}}">
    <link rel="shortcut icon" href="{{asset('imgs/logos/Ags.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>@yield('title')</title>
</head>
<body>


    <header>
        <div class="logo">
            <img src="{{asset('imgs/logos/Ags.png')}}" alt="Logo de la empresa">
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



{{--
     <footer class="footer">
        <div class="left-images">
            <div class="column">
                <img src="{{asset('imgs/logos/logo-sena.png')}}" width="45" alt="Imagen 1">
                <img src="{{asset('imgs/logos/ESCUDO COLOMBIA.png')}}" width="45" alt="Imagen 2">
            </div>
            <div class="column">
                <img src="{{asset('imgs/logos/logo_fondo.png')}}" width="130" alt="Imagen 3">
                <img src="{{asset('imgs/logos/Logo_Enterritorio.png')}}" width="100" alt="Imagen 4">
            </div>
        </div>
        <div class="right-content">
            <div class="images">
                <img src="{{asset('imgs/logos/LOGO ISO.png')}}" width="50" alt="Imagen 5">
                <img src="{{asset('imgs/logos/Logo-IQNet .png')}}" width="75" alt="Imagen 6">
            </div>
            <div class="separator"></div>
            <div class="text">
                <p>Copyright © 2023 AGS SALUD SAS</p>
                <p>Todos los derechos Reservados</p>
            </div>
        </div>
    </footer> --}}


    <script src="{{asset('js/layout.js')}}"></script>

</body>
</html>
