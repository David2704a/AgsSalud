@php
    use Illuminate\Support\Facades\Auth;
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/css/LayoutApp.css') }}">
    <link rel="shortcut icon" href="{{ asset('imgs/logos/Ags.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/Formulario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userNav/userbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/Formulario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userNav/userbar.css') }}">
    <title>@yield('title')</title>
</head>

<body>

    <script>
        var urlBase = {!! json_encode(url('/')) !!}

        function alertSwitch(iconPar, titlePar, time = 3000) {

            const progressBarColors = {
                'info': '#3498db',
                'error': '#e04b4b',
                'success': '#28a745'
            };

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: time,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;

                    const progressBarColor = progressBarColors[iconPar];

                    if (progressBarColor) {
                        var progressBar = $('.swal2-timer-progress-bar');
                        progressBar.css('background-color', progressBarColor);
                    }
                }
            });

            Toast.fire({
                icon: iconPar,
                title: titlePar
            });
        }
    </script>

    <header>
        <div class="btn_menuL">
            <button class="toggle-btn" id="toggleBtn">☰</button>
        </div>
        {{-- <div class="logo">
            <img src="{{ asset('imgs/logos/Ags.png') }}" alt="Logo de la empresa">
        </div> --}}
        <div class="home">
            <a href="{{ url('/dashboard') }}" title="Inicio">
                <i class="fa-solid fa-house-flag"></i>
            </a>
        </div>

        <div class="user-menu">
            <button id="user-menu-button" class="user-menu-button">
                <div class="user-name">
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
                <a class="perfiledit" href="{{ route('ActualizarPerfil') }}">Perfil</a>


                <br>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btonCerrarSe" type="submit">Cerrar sesión</button>
                </form>

            </div>
        </div>
    </header>


    <div class="sidebar collapsed" id="sidebar">
        <button class="close-btn" id="closeBtn">&times;</button>
        <div class="logo">
            <img src="{{ asset('imgs/logos/Ags.png') }}" alt="Logo de la empresa">
        </div>
        <ul class="menu_lateral">
            <li><a href="#procedimientos"><i class="fas fa-procedures"></i> <span>Procedimientos</span></a></li>
            <li><a href="#elementos"><i class="fas fa-cogs"></i> <span>Elementos</span></a></li>
            <li><a href="#categorias"><i class="fas fa-list"></i> <span>Categorías</span></a></li>
            <li><a href="#reportes"><i class="fas fa-file-alt"></i> <span>Reportes</span></a></li>
            <li><a href="#usuarios"><i class="fas fa-users"></i> <span>Usuarios</span></a></li>
        </ul>
    </div>


    <div class="contenidoPadre">
        @yield('content')
    </div>
    @yield('links')

    <footer class="footer">
        <div class="left-images">
            <div class="column">
                <img src="{{ asset('imgs/logos/logo-sena.png') }}" width="45" alt="Imagen 1">
                <img src="{{ asset('imgs/logos/ESCUDO COLOMBIA.png') }}" width="45" alt="Imagen 2">
            </div>
            <div class="column">
                <img src="{{ asset('imgs/logos/logo_fondo.png') }}" width="130" alt="Imagen 3">
                <img src="{{ asset('imgs/logos/Logo_Enterritorio.png') }}" width="100" alt="Imagen 4">
            </div>
        </div>
        <div class="right-content">
            <div class="images">
                {{-- <img src="{{ asset('imgs/logos/LOGO ISO.png') }}" width="50" alt="Imagen 5"> --}}
                {{-- <img src="{{ asset('imgs/logos/Logo-IQNet.png') }}" width="75" alt="Imagen 6"> --}}
            </div>
            <div class="separator"></div>
            <div class="text">
                <p>Copyright © 2024 AGS SALUD SAS</p>
                <p>Todos los derechos Reservados</p>
            </div>
        </div>
    </footer>
    <script>
document.getElementById('toggleBtn').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('collapsed');
    document.querySelector('.contenidoPadre').classList.toggle('full-width');
});

document.getElementById('closeBtn').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('collapsed');
    document.querySelector('.contenidoPadre').classList.toggle('full-width');
});
    </script>
    <style>
.sidebar {
    width: 250px;
    background-color: #ffffff;
    border-right: 1px solid #e0e0e0;
    height: 100vh;
    transition: width 0.3s ease;
    position: fixed;
    z-index: 9999;
}

.sidebar .menu_lateral span {
    display: inline-block;
    transition: opacity 0.3s ease;
}

.sidebar.collapsed {
    width: 80px;
}

.sidebar.collapsed .menu_lateral span {
    opacity: 0;
    visibility: hidden;
}

.sidebar .logo {
    text-align: center;
    padding: 20px;
    border-bottom: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.sidebar .logo img {
    width: 150px;
    transition: width 0.3s ease, height 0.3s ease, border-radius 0.3s ease;
}

.sidebar.collapsed .logo img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.menu_lateral {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.menu_lateral li {
    text-align: left;
}

.menu_lateral li a {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    text-decoration: none;
    color: #333333;
    font-size: 16px;
    border-bottom: 1px solid #e0e0e0;
}

.menu_lateral li a i {
    margin-right: 10px;
    font-size: 18px;
}

.menu_lateral li a:hover {
    background-color: #f0f0f0;
    color: #007bff;
}

.contenidoPadre {
    /* width: 100%; */
    flex: 1;
    padding: 0 0 0 50px;
    transition: margin-left 0.3s ease;
    /* margin-left: 250px; Initial margin to accommodate sidebar */
}

.sidebar.collapsed + .contenidoPadre {
    /* margin-left: 10px;  */

}

.toggle-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    font-size: 20px;
    background: none;
    border: none;
    cursor: pointer;
    z-index: 1;
}

.close-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 24px;
    background: none;
    border: none;
    cursor: pointer;
}

        /* .contenidoPadre {
            height: 100vh;
            overflow-y: hidden !important;
        } */

        .content2 {
            overflow-y: auto;
            height: 100%;
        }

        .footer {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f3f3f3;
            color: #fff;
            bottom: 0;
        }

        .user-menu-button {
    padding: 10px;
    color: #fff;
    border: none;
    border-radius: 40px;
    cursor: pointer;
}
    </style>

    <script src="{{ asset('js/userNav/userbar.js') }}"></script>

    <script src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script src="{{ asset('js/layout.js') }}"></script>
    <script src="{{ asset('js/layout.js') }}"></script>

</body>

</html>
