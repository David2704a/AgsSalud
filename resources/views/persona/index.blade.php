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
                        <h4>{{ Auth::user()->name }}</h4>
                    </div>

                    <div class="mb-3">
                        <label class="col-lg-8 control-label" for="name">Nombre de Usuario</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
                    </div>
                </div>
                <div>
                    <div class="form-group ">
                        <label for="name">correo</label>
                        <input style="align:center" type="email" name="email"
                            value="{{ Auth::user()->email}}" class="form-control">
                    </div>
                </div>
                <br>
                <br>
                <div class="row text-center mb-4 mt-5">
                    <div class="cold-md-12">
                        @if(auth()->user()->hasRole(['superAdmin','admin']))
                        <button type="submit" href="{{ route('editarPerfiluser', ['id' => Auth::user()->id]) }}" class=" btn btn-danger" id="formSubmit">Guardar cambios</button>
                        @endif
                        <a href="{{ route('personas.update', ['id' => Auth::user()->id]) }}" class="btn btn-primary">Actualizar Información</a>
                </div>
            </form>

                    <div class="mb-3">
                        <label for="name">Correo</label>
                        <input style="align:center" type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">
                    </div>

                    <br>
                    <br>

                    <div class="row text-center mb-4 mt-5">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-danger" href="{{ route('ActualizarPerfil') }}">Guardar cambios</button>

                            <a  href="{{ route('editarPerfil', ['id' => Auth::user()->id]) }} class="btn btn-primary">Actualizar Información</button>
                        </div>
                    </div>
                </form>

                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="actualizarModalLabel" tabindex="-1" aria-labelledby="actualizarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actualizarModalLabel">Actualizar Información</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para actualizar información de Persona -->
                <form action=" " method="POST" id="actualizarModalForm">
    @csrf
    @method('PUT')
                    <!-- Campos del formulario de Persona -->
                    <div class="mb-3">
                        <label for="nombre1" class="form-label">Primer Nombre</label>
                        <input type="text" class="form-control" id="nombre1" name="nombre1" value="{{ old('nombre1', optional(Auth::user()->persona)->nombre1) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre2" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" id="nombre2" name="nombre2" value="{{ old('nombre2', optional(Auth::user()->persona)->nombre2) }}">
                    </div>

                    <div class="mb-3">
                        <label for="apellido1" class="form-label">Primer Apellido</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1" value="{{ old('apellido1', optional(Auth::user()->persona)->apellido1) }}">
                    </div>

                    <div class="mb-3">
                        <label for="apellido2" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" id="apellido2" name="apellido2" value="{{ old('apellido2', optional(Auth::user()->persona)->apellido2) }}">
                    </div>

                    <div class="mb-3">
                        <label for="idTipoIdentificacion" class="form-label">Tipo de Identificación</label>
                        <!-- Aquí puedes poner tu lógica para seleccionar el tipo de identificación -->
                        <input type="text" class="form-control" id="idTipoIdentificacion" name="idTipoIdentificacion" value="{{ old('idTipoIdentificacion', optional(Auth::user()->persona)->idTipoIdentificacion) }}">
                    </div>

                    <div class="mb-3">
                        <label for="identificacion" class="form-label">Número de Identificación</label>
                        <input type="text" class="form-control" id="identificacion" name="identificacion" value="{{ old('identificacion', optional(Auth::user()->persona)->identificacion) }}" unique>
                    </div>

                    <div class="mb-3">
                        <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNac" name="fechaNac" value="{{ old('fechaNac', optional(Auth::user()->persona)->fechaNac) }}">
                    </div>

                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <input type="text" class="form-control" id="sexo" name="sexo" value="{{ old('sexo', optional(Auth::user()->persona)->sexo) }}">
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', optional(Auth::user()->persona)->direccion) }}">
                    </div>


                    <div class="mb-3">
                        <label for="celular" class="form-label">Número de Celular</label>
                        <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular', optional(Auth::user()->persona)->celular) }}">
                    </div>
                    <!-- Agrega los demás campos del formulario de persona -->

                    <button type="submit" class="btn btn-primary">Actualizar Persona</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Script para capturar el ID del usuario y pasarlo al formulario del modal
    document.addEventListener('DOMContentLoaded', function () {
        var actualizarModalButton = document.getElementById('actualizarModalButton');
        var actualizarModalForm = document.getElementById('actualizarModalForm');

        actualizarModalButton.addEventListener('click', function () {
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