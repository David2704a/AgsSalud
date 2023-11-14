@extends('layouts.app')

@section('title', 'Tipo de Procedimiento')

@section('links')

<link rel="stylesheet" href="{{asset('/css/tipoProcedimiento/tipoProcedimiento.css')}}">

@endsection
@section('content')

<div class="content">
    <h1 class="page-title">CREAR PROCEDIMIENTOS</h1>
<div class="green-line"></div>
</div>

<div class="button-container">
    <a href="{{route('mostrarProcedimiento')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

</div>

<div class="menu-containers">
    <ul class="menu">
        <li>
            <a href="{{route('createEstadoP')}}">Crear Estado de Procedimiento</a>
        </li>
        <li>
            <a href="{{route('createProcedimiento')}}">Crear Procedimiento</a>
        </li>
    </ul>
</div>


    <form class="form" action="{{route('storeTipoP')}}" method="POST">
    @csrf

    <div class="form-part active" id="parte1">
        <label for="tipo">Tipo de Procedimiento</label>
        <input type="text" name="tipo" id="tipo">
        <br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion">
        <br>
        <div class="button-container">
            <button type="submit">Crear</button>
        </div>
    </div>

    </form>

    <footer class="footer">
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
                <img src="{{asset('imgs/logos/Logo-IQNet .png')}}" width="75" alt="Imagen 6">
            </div>
            <div class="separator"></div>
            <div class="text">
                <p>Copyright © 2023 AGS SALUD SAS</p>
                <p>Todos los derechos Reservados</p>
            </div>
        </div>
    </footer>


@endsection
