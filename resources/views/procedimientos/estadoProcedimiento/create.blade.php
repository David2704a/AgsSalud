@extends('layouts.app')

@section('title', 'Estado de Procedimiento')

@section('links')

<link rel="stylesheet" href="{{asset('css/estadoProcedimiento/estadoProcedimiento.css')}}">

@endsection
@section('content')

<div class="content">
    <h1 class="page-title">CREAR ESTADO DE PROCEDIMIENTOS</h1>
<div class="green-line"></div>
</div>

<div class="button-container">
    <a href="{{route('mostrarEstadoP')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

</div>

<div class="menu-containers">
    <ul class="menu">
        <li>
            <a href="{{route('mostrarTipoP')}}">Tipo de Procedimiento</a>
        </li>
        <li>
            <a href="{{route('mostrarProcedimiento')}}">Procedimiento</a>
        </li>
    </ul>
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


    <form class="form" action="{{route('storeEstadoP')}}" method="POST">
    @csrf

    <div class="form-part active" id="parte1">
        <label for="estado">Estado de Procedimiento</label>
        <input type="text" name="estado" id="estado" value="{{old('estado')}}">
        <br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" value="{{old('descripcion')}}">
        <br>
        <div class="button-container">
            <button type="submit">Crear</button>
        </div>
    </div>

    </form>

    <footer class="footer position-absolute top-100 start-50 translate-middle">
        <div class="left-images">
            <div class="column">
                <img src="{{asset('imgs/logos/logo-sena.png')}}" width="45" alt="Imagen 1">
                <img src="{{asset('imgs/logos/ESCUDO COLOMBIA.png')}}" width="45" alt="Imagen 2">
            </div>
            <div class="column">
                <img src="{{asset('imgs/logos/logo_fondo.png')}}" width="130" alt="Imagen 3">
                <img src="{{asset('imgs/logos/Logo_Enterritorio.png')}}" width="100" alt="Imagen 4">
            </div>
        </div>
        <div class="right-content">
            <div class="images">
                <img src="{{asset('imgs/logos/LOGO ISO.png')}}" width="50" alt="Imagen 5">
                <img src="{{asset('imgs/logos/Logo-IQNet.png')}}" width="75" alt="Imagen 6">
            </div>
            <div class="separator"></div>
            <div class="text">
                <p>Copyright © 2023 AGS SALUD SAS</p>
                <p>Todos los derechos Reservados</p>
            </div>
        </div>
    </footer>


@endsection
