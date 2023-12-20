@extends('layouts.app')

@section('title', 'Perfil')

@php
use Illuminate\Support\Facades\Auth;
@endphp



@section('links')
<link rel="stylesheet" href="{{ asset('/css/categoria/categoria.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
<div class="content">
    <h1 class="page-title">Actualizar perfil</h1>
    <div class="green-line"></div>




    <div class="button-container">
        <a href="/dashboard" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
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

  
    <form id="updateProfileForm" class="form" action="{{ route('Actualizar', ['id' => Auth::user()->id]) }}" method="POST">
        @csrf
        <!-- <h6 class="page-title">{{  Auth::user()->name }}</h6> -->

            <label for="name">Nombre usuario</label>
            <br>
            <input type="text" name="name" id="name" value="{{  Auth::user()->name }}">
            <br>

            <label for="email">Correo</label>
            <br>
            <input type="text" name="email" id="email" value="{{ Auth::user()->email }}">
            <br>
            <br>
            <br>
         
            <button type="botton"  class="edit-button" href="{{ route('ActualizarPerfil') }} "title="Guardar cambios"  >Guardar cambios <i class="fas fa-sync-alt"></i>
            </button>

            <!-- <button type="submit" class="button-container" href="{{ route('ActualizarPerfil') }}">Guardar cambios</button> -->


            <a  href="{{ route('editarPerfil', ['id' => Auth::user()->id]) }}" title="Actualizar Información">Actualizar Información<i class="fa-regular fa-pen-to-square"></i>
            </a>




            <br>
            <br>
            <br>
    </form>

    <br>
    <br>
    <br>
</div>
</div>
</div>
</div>


<script>
    // Script para capturar el ID del usuario y pasarlo al formulario del modal
    document.addEventListener('DOMContentLoaded', function() {
        var actualizarModalButton = document.getElementById('actualizarModalButton');
        var actualizarModalForm = document.getElementById('actualizarModalForm');

        actualizarModalButton.addEventListener('click', function() {
            var userId = this.getAttribute('data-user-id');
            document.getElementById('userIdInput').value = userId;
        });
    });
</script>

<!-- Resto del contenido -->
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