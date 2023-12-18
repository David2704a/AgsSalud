@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Auth;
@endphp


@section('title','Home')
@section('links')

<link rel="stylesheet" href="{{asset('/css/welcome.css')}}">
@endsection


@section('content')

<div class="content">
    <h1 class="page-title">PANEL DE CONTROL</h1>
    <div class="green-line"></div>
</div>

<div class="button-container">

    <a href="/procedimiento" title="Procedimientos" class="button-link">
        <div class="circle-button btn-background-circle">
            <img src="{{asset('imgs/icons/process.png')}}" alt="alo">
        </div>
        <span>PROCEDIMIENTOS</span>
    </a>

    <a href="/proveedores" title="Elementos" class="button-link">
        <div class="circle-button btn-background-circle">
            <img src="{{asset('imgs/logos/Logo-IQNet.png')}}" alt="alo">
        </div>
        <span>ELEMENTOS</span>
    </a>

    <a href="/categorias" class="button-link">
        <div class="circle-button btn-background-circle">
            <img style="width: 87px;" src="{{asset('img/categoria.png')}}" alt="alo">
        </div>
        <span>Categoria</span>
    </a>

    <a href="/usuarios" class="button-link">
        <div class="circle-button btn-background-circle">
            <img src="{{asset('imgs/logos/Logo-IQNet.png')}}" alt="alo">
        </div>
        <span>Usuarios</span>
    </a>

</div>


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

