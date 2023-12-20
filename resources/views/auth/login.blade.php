<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>login</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">

    <link rel="icon" href="{{ asset('img/sinfondologo.png') }}" type="image/png" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link href="{{ asset('inicio/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('inicio/css/estilos.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Sesion izquierda de la pagina-->
            <div class="izqui col-lg-5 col-md-8 mx-auto">
                <img class="img-fluid ags" src="{{ asset('img/AgsLogin.png') }}" alt="">
                <img class="img-fluid Grupo_1" src="{{ asset('img/GrupoImagenes.png')}}" alt="">
            </div>

            <!-- Linea central de la pagina-->
            <div class="linea1"></div>

            <!-- Sesion derecha de la pagina-->
            <div class="dere col-lg-5 col-md-8 mx-auto">
                <img class="img-fluid users" style="width: 250px;height: 180px;" src="{{ asset('img/Sage.png')}}" alt="">
                <div class="mt-4">
                    @if (session()->has('mensaje'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                </div>

                <div class="login">
                    <!-- Formulario de iniciar sesion -->
                    <form action="{{ url('/login') }}" class="form-login" method="post">
                        @csrf
                        <div class="input-group flex-nowrap mt-4 col-lg-8 col-md-12 col-sm-12 mx-auto">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping"><img class="loginimg" src="{{ asset('img/Icon_feather_user.png') }}" alt=""></span>
                            </div>
                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-MAIL" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 mx-auto">
                            @error('email')
                                <div class="alert alert-danger" style="position: relative;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="input-group flex-nowrap mt-4 col-lg-8 col-md-12 col-sm-12 mx-auto">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping"><img class="loginimg" src="{{ asset('img/Icon_feather_lock.png ') }}" alt=""></span>
                            </div>
                            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="CONTRASEÑA" value="{{ old('password') }}" required autocomplete="current-password">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping"><a onclick="mostrarContrasena()" onchange="cambiarOjo()"><i id="the-eye" class="fa fa-eye-slash"></i></a></span>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 mx-auto">
                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-4 col-lg-7 col-md-11 col-11 mx-auto">INICIAR SESION</button>
                    </form>
                    <!-- Final del formulario de iniciar sesion -->
                </div>
            </div>
        </div>
        <br>
        <br>
        <br><br>
    </div>

    <!-- Pie de pagina -->
    <footer style="background-color: #EBEBEB">
        <div class="mt-3 d-flex flex-wrap justify-content-around">
            <div class="mx-auto">
                <hr>
                <div class="input-group">
                    <span class="small" style="color: gray">
                        <b>Copyright &copy; 2023 AGS SALUD SAS <br> Todos los derechos reservados</b>
                    </span>
                </div>
            </div>
        </div>
        <br>
    </footer>

    <script src="{{ asset('inicio/js/elojito.js') }}"></script>
    <script src="{{ asset('inicio/js/jquery.knob.min.js') }}" defer type="text/javascript"></script>
    <script src="{{ asset('inicio/js/jquery.imagecursorzoom.js') }}" defer type="text/javascript"></script>
</body>
</html>
