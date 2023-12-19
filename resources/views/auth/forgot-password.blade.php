
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="shortcut icon" href="img/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('inicio/css/forgot-password.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>


</head>

<body class="hold-transition login-page">

</body>
<div class="contenedortodo">

<div class="vansss">

            <img src="{{ asset('img/escudo.png') }}" style="width: 70%; height: 90%">
            
            <img src="{{ asset('img/fondoemprender.png') }}" style="width: 70%; height: 90%">

            <img src="{{ asset('img/sena.png') }}" style="width: 70%; height: 90%">
            <img src="{{ asset('img/IQNet.png') }}" style="width: 70%; height: 90%">
            <img src="{{ asset('img/enterritorio.png') }}" style="width: 70%; height: 90%">

            <img  class ="peque" src="{{ asset('img/icontec.png') }}" style="width: 70%; height: 90%">

           
</div>
<br>
<br>

    <div class="container  w-full sm:max-w-md mt-6 px-6 py-4  shadow-md overflow-hidden sm:rounded-lg" >

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('¿Olvidaste tu contraseña? Ningún problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva...') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electronico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="btn2 items-center  ">
            <x-primary-button class="btn ms-3">
                {{ __('Enlace para restablecer contraseña de correo electrónico') }}
            </x-primary-button>
        </div>
    </form>
    <br>
<br>
        
        </div>
        <div class="vansss2">
        <img src="{{ asset('img/sinfondologo.png') }}" style="width: 70%; height: 90%">

        </div>
    </div>
    </div>



