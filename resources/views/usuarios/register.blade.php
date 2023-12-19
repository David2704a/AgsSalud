<!-- resources/views/categorias/create.blade.php -->

@extends('layouts.app')

@section('title', 'Crear Usuario')


@section('links')

<link rel="stylesheet" href="{{asset('/css/categoria/categoria.css')}}">

@endsection




@section('content')
    <div class="content">
        <h1 class="page-title">Crear Nuevo usuario</h1>
        <div class="green-line"></div>
    </div>

    <div class="button-container">
        <a href="{{ route('users.index') }}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    </div>


    @if ($errors->any())
        <div id="alert" class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form" action="{{ route('register.create') }}" method="POST">
        @csrf

        <div class="form-part active" id="parte1">
            <label for="name">Nombre usuario</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            <br>
            <label for="email">Correo</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}">
            <br>

            <br>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}">
            <br>
            <div class="button-container">
                <button type="submit">Crear</button>
            </div>
        </div>
    </form>





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
                <img src="{{ asset('imgs/logos/LOGO ISO.png') }}" width="50" alt="Imagen 5">
                <img src="{{ asset('imgs/logos/Logo-IQNet.png') }}" width="75" alt="Imagen 6">
            </div>
            <div class="separator"></div>
            <div class="text">
                <p>Copyright © 2023 AGS SALUD SAS</p>
                <p>Todos los derechos Reservados</p>
            </div>
        </div>
    </footer>
@endsection
