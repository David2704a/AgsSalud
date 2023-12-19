<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="shortcut icon" href="img/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('inicio/css/login.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>


</head>

<body class="hold-transition login-page">
    <!-- <img class="wave" src="{{ asset('img/sinfondologo.png') }}" style="width: 35%; height: 75%; border-radius: 20%; object-fit: cover;margin:6%"> -->



</body>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container">
        <div class="img">
            <!-- <img src="{{ asset('inicio/img/bg.svg') }}"> -->
            <img  src="{{ asset('img/sinfondologo.png') }}"  >


        </div>
        <div class="login-content">


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="vansss">

            <img src="{{ asset('img/escudo.png') }}" style="width: 70%; height: 90%">
            <img src="{{ asset('img/sena.png') }}" style="width: 70%; height: 90%">
            <img src="{{ asset('img/IQNet.png') }}" style="width: 70%; height: 90%">
            <img  class ="peque" src="{{ asset('img/icontec.png') }}" style="width: 70%; height: 90%">

        </div>
        <br>





                <h3 class="title">Registro</h3>

                @csrf


                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Nombre</h5>
                        <input type="text" for="name" class="input" name="name" value="{{ old('name') }}"required autocomplete="username"
                            title="ingrese su correo">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                </div>

<!-- Name -->

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Correo</h5>
                        <input type="email" for="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="username"
                            title="ingrese su correo">
                    </div>

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>


                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" for="password" id="password" class="input" name="password" required autocomplete="new-password"
                            title="ingresa una contraseña">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>
                <div class="view">
                    <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                </div>


                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Confirmar contraseña</h5>
                        <input type="password" for="password_confirmation" id="password_confirmation"  class="input" name="password_confirmation" required autocomplete="new-password"
                            title="confirma tu contraseña">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                </div>

                <div class="view">
                    <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                </div>





<div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
        {{ __('Ya registrado?') }}
    </a>

    <x-primary-button class="btn ms-3" >
        {{ __('Registrarse') }}
    </x-primary-button>
</div>

<br>
<br>

            <div class="vansss2">
            <img src="{{ asset('img/fondoemprender.png') }}" style="width: 70%; height: 90%">
            <img src="{{ asset('img/enterritorio.png') }}" style="width: 70%; height: 90%">

            </div>


</form>

        </div>
    </div>







    <script type="text/javascript" src="{{ asset('inicio/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('inicio/js/main2.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>

















