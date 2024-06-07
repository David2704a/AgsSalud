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
    <link rel="shortcut icon" href="{{ asset('img/Sage.png') }}" type="image/x-icon">
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
    <div id="loader-wrapper" class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <header>
        <div class="btn_menuL">
            <button class="toggle-btn" id="toggleBtn">☰</button>
        </div>
        {{-- <div class="logo">
            <img src="{{ asset('imgs/logos/Ags.png') }}" alt="Logo de la empresa">
        </div> --}}
        {{-- <div class="home">
            <a href="{{ url('/dashboard') }}" title="Inicio">
                <i class="fa-solid fa-house-flag"></i>
            </a>
        </div> --}}

        <div class="user_menu">
            <button id="user-menu-button" class="user-menu-button">
                <div class="user_name">
                    @auth
                        {{ Auth::user()->name }}
                    @endauth
                </div>
                <div class="icon">
                    <i class="material-symbols-outlined">expand_more</i>
                </div>
            </button>
            <div class="card_panel card_drop" id="user-dropdown">

                @include('components.svg-fondo-perfil')
                @auth
                    @if (Auth::user()->persona && in_array(Auth::user()->persona->sexo, ['M', 'F', 'O', null]))
                        @if (Auth::user()->persona->sexo === 'M')
                            <div class="card_photoDiv"
                                style="position: absolute;top:120px; width:0%; padding:0; height:150px; justify-content:center;   flex-direction: column;
                            align-items: center; display:flex;">
                                <div class="card-photo"></div>
                            </div>
                        @elseif(Auth::user()->persona->sexo === 'F')
                            @include('components.svg-perfil-femenino')
                        @elseif (Auth::user()->persona->sexo === 'O')
                            <div class="card_photoDiv"
                                style="position: absolute;top:120px; width:0%; padding:0; height:150px; justify-content:center;   flex-direction: column;
                            align-items: center; display:flex;">
                                <div class="card-photo"></div>
                            </div>
                        @elseif (Auth::user()->persona->sexo === null)
                            <div class="card_photoDiv"
                                style="position: absolute;top:120px; width:0%; padding:0; height:150px; justify-content:center;   flex-direction: column;
                            align-items: center; display:flex;">
                                <div class="card-photo"></div>
                            </div>
                        @endif
                    @endif
                @endauth

                <div class="card__title"> @auth
                        {{ Auth::user()->name }}
                    @endauth
                </div>
                <div class="card__subtitle">
                    {{ Auth::user()->email}}
                </div>
                <div class="card__subtitle" style="text-transform: uppercase;">
                    {{ ucwords(preg_replace('/(?<!^)([A-Z])/', ' $1', Auth::user()->getRoleNames()->first())) }}


                </div>
                <div class="card__wrapper">
                    <a class="perfiledit" href="{{ route('ActualizarPerfil') }}">Perfil</a>
                    <form class="formulario_logout" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="card__btn card__btn-solid" type="submit"><i
                                class="fa-solid fa-right-from-bracket"></i>Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    @php
        use Illuminate\Support\Facades\Request;
    @endphp

    <div class="sidebar collapsed" id="sidebar">
        <div class="button_logo">
            <div class="logo">
                <img src="{{ asset('img/Sage.png') }}" alt="Logo del Aplicativo">
            </div>
            <div class="button_close">
                <label class="hamburger">
                    <input type="checkbox" id="closeBtn">
                    <svg viewBox="0 0 32 32">
                        <path class="line line-top-bottom"
                            d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22">
                        </path>
                        <path class="line" d="M7 16 27 16"></path>
                    </svg>
                </label>
            </div>
        </div>
        <ul class="menu_lateral">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}" onclick="showLoader()">
                <a href="{{ url('/dashboard') }}"><i class="fa-solid fa-house-chimney"></i> <span>Inicio</span></a>
            </li>
            <li class="{{ Request::is('procedimiento') || Request::is('procedimiento/*') ? 'active' : '' }}" onclick="showLoader()">
                <a href="{{ url('/procedimiento') }}"><i class="fa-solid fa-diagram-project"></i>
                    <span>Procedimientos</span></a>
            </li>
            <li class="{{ Request::is('elementos') || Request::is('elementos/*') ? 'active' : '' }}" onclick="showLoader()">
                <a href="{{ url('/elementos') }}"><i class="fa-brands fa-elementor"></i> <span>Elementos</span></a>
            <li class="{{ Request::is('categorias') || Request::is('categorias/*') ? 'active' : '' }}" onclick="showLoader()">
                <a href="{{ url('/categorias') }}"><i class="fas fa-list"></i> <span>Categorías</span></a>
            </li>
            <li class="{{ Request::is('reporte') ? 'active' : '' }}" onclick="showLoader()">
                <a href="{{ url('/reporte') }}"><i class="fas fa-file-alt"></i> <span>Reportes</span></a>
            </li>
            <li class="{{ Request::is('usuarios') || Request::is('user/*/edit') ? 'active' : '' }}" onclick="showLoader()">
                <a href="{{ url('/usuarios') }}"><i class="fas fa-users-gear"></i> <span>Usuarios</span></a>
            </li>
            <li class="{{ Request::is('Miperfil') || Request::is('editar/*') ? 'active' : '' }}" onclick="showLoader()">
                <a href="{{ url('/Miperfil') }}"><i class="fas fa-user-pen"></i> <span>Perfil</span></a>
            </li>
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
        function showLoader() {
            const loaderWrapper = document.getElementById("loader-wrapper");
            loaderWrapper.style.display = "flex";

            document.body.style.overflow = "hidden";
        }

        document.addEventListener("DOMContentLoaded", function() {
            const loaderWrapper = document.getElementById("loader-wrapper");
            loaderWrapper.style.display = "none";
            document.body.style.overflow = "auto";
        });

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


    <script src="{{ asset('js/userNav/userbar.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/layout.js') }}"></script>
    <script src="{{ asset('js/layout.js') }}"></script>
</body>

</html>
