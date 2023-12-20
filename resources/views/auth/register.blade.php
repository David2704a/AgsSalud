<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('inicio/css/login.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="container">
        <div class="img">
            <!-- Puedes añadir tu imagen aquí -->
        </div>

        <div class="login-content">
            <form method="POST" action="{{ route('register.create') }}">
                @csrf

                <h3 class="title">Registro de Usuario</h3>

                <!-- Nombre -->
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Nombre</h5>
                        <input type="text" class="input" name="name" value="{{ old('name') }}" required
                            autocomplete="username" title="Ingrese su nombre">
                    </div>
                </div>

                <!-- Correo -->
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Correo</h5>
                        <input type="email" class="input" name="email" value="{{ old('email') }}" required
                            autocomplete="username" title="Ingrese su correo">
                    </div>
                </div>

                <div class="input-div one" style="display: grid; grid-template-rows: auto auto;">
                    <div class="i">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="div select">
                        <select class="input" name="role" required>
                            <option value="">Asignar rol</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>


                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" class="input" name="password" required autocomplete="new-password"
                            title="Ingrese una contraseña">
                    </div>
                </div>

                
                <button type="submit" class="btn">Registrarse</button>
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
