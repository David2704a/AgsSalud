<!-- resources/views/categorias/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('links')

<link rel="stylesheet" href="{{asset('/css/categoria/categoria.css')}}">

@endsection


@section('content')


    <div class="content">
        <h1 class="page-title">Editar Categoría</h1>
        <div class="green-line"></div>
    </div>

    <div class="button-container">
        <a href="{{ route('categorias.index') }}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    </div>

    <form class="form" action="{{ route('categorias.update', ['idCategoria' => $categoria->idCategoria]) }}" method="POST">
        @csrf
        @method('put')

        <div class="form-part active" id="parte1">
            <label for="nombre">Nombre de la Categoría</label>
            <input type="text" name="nombre" id="nombre" value="{{ $categoria->nombre }}">
            <br>
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" value="{{ $categoria->descripcion }}">
            <br>
            <div class="button-container">
                <button type="submit">Actualizar</button>
            </div>
        </div>

    </form>

    <footer class="footer position-absolute top-100 start-50 translate-middle">
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
