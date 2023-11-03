<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/css/LayoutFondo.css')}}">
    <title>@yield('title')</title>
</head>
<body>

    
    <header>
        <div class="logo">
            <img src="{{asset('imgs/logos/Ags.png')}}" alt="Logo de la empresa">
        </div>
        <div class="user-info">
            <div class="notifications">
                <img src="notification-icon.png" alt="Ícono de notificaciones">
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
</html>