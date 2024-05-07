@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/categoria/categoria.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection

@section('content')
<div class="content2">
    <div class="content">
        <h1 class="page-title">Editar Usuario Perfil</h1>
        <div class="green-line mt-2"></div>
    </div>
    <div class="button-container" style="margin-bottom: -7px">
        <a href="{{ route('users.index') }}" class="button-izquierda arrow-left">
            <i class="fa-solid fa-circle-arrow-left"></i> Regresar
        </a>
    </div>

    @if(session('success'))
            <div id="alert" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
    <div id="error-alert" class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <form class="form " action="{{ route('editarPerfilusersR', ['id' => $usuario->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-part active mt-4" id="parte1">
            <label for="name">Nombre de usuario</label>
            <input type="text" name="name" id="name" value="{{ $usuario->name }}">

            <label for="email">Correo</label>
            <input type="text" name="email" id="email" value="{{ $usuario->email }}">

            <label for="role">Asignar Rol</label>
            <select class="input" name="role[]" required>
                <option value="">Selecccione una Opcion</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
            </select>

            <div class="mt-3">
                <label class="form-label" for="password">Contraseña</label>
                <input class="form-control" type="password" name="password" id="password" value="{{ old('password') }}" style="width: 95%">
            </div>

            <!-- Agrega los campos adicionales que desees editar para el usuario -->

            <div class="button-container">
                <button type="submit" class="btn-link modal-button">Guardar Cambios</button>
            </div>
        </div>
    </form>
</div>

</div>

@endsection
