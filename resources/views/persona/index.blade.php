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

    <div class="table-container">
        <div class="card" style="width:50%; margin-left:25%">
            <div class="card-body">
                <form id="updateProfileForm" action="{{ route('Actualizar', ['id' => Auth::user()->id]) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="col-lg-8 control-label" for="name">Nombre de Usuario</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label for="name">Correo</label>
                        <input style="margin-top: 15px;" type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">
                    </div>

            <!-- <button type="submit" class="button-container" href="{{ route('ActualizarPerfil') }}">Guardar cambios</button> -->

                    <div class="row text-center mb-4 mt-5">
                        <div class="col-md-12">
                            @if(auth()->user()->hasRole(['superAdmin','admin']))
                            <button type="submit" class="btn btn-danger" href="{{ route('ActualizarPerfil') }}">Guardar cambios<i class="fas fa-sync-alt"></i> </button>
                            @endif
                            <a  href="{{ route('editarPerfil', ['id' => Auth::user()->id]) }} class="btn btn-primary">Actualizar Información<i class="fa-regular fa-pen-to-square"></i></button>
                        </div>
                    </div>
                </form>




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