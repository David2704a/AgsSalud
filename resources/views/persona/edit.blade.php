@extends('layouts.app')

@section('title', 'Editar perfil')
@php
    use Illuminate\Support\Facades\Auth;
@endphp


@section('links')
    <link rel="stylesheet" href="{{ asset('/css/categoria/categoria.css') }}">
@endsection




@section('content')
    <div class="content2">
        <h1 class="page-title">Editar Usuario</h1>
        <div class="green-line"></div>


        <div class="button-container">
            <a href="{{ route('persona.index') }}" class="button-izquierda arrow-left">
                <i class="fa-solid fa-circle-arrow-left"></i> Regresar
            </a>
        </div>
        @if (session('success'))
            <div id="alert" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div id="error-alert" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="">

            <form class="form" action="{{ route('personas.update', $usuario->persona->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-part active" id="parte1">

                    <div class="mb-3">
                        <label for="nombre1" class="form-label">Primer Nombre</label>
                        <input type="text" class="form-control" id="nombre1" name="nombre1"
                            value="{{ old('nombre1', optional(Auth::user()->persona)->nombre1) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre2" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" id="nombre2" name="nombre2"
                            value="{{ old('nombre2', optional(Auth::user()->persona)->nombre2) }}">
                    </div>

                    <div class="mb-3">
                        <label for="apellido1" class="form-label">Primer Apellido</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1"
                            value="{{ old('apellido1', optional(Auth::user()->persona)->apellido1) }}">
                    </div>

                    <div class="mb-3">
                        <label for="apellido2" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" id="apellido2" name="apellido2"
                            value="{{ old('apellido2', $usuario->persona->apellido2) }}">
                    </div>

                    <select class="form-select" id="idTipoIdentificacion" name="idTipoIdentificacion">
                        @foreach ($tiposIdentificacion as $tipo)
                            <option value="{{ $tipo->id }}"
                                {{ old('idTipoIdentificacion', $usuario->persona->idTipoIdentificacion) == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->Detalle }}
                            </option>
                        @endforeach
                    </select>


                    <div class="mb-3">
                        <label for="identificacion" class="form-label">Número de Identificación</label>
                        <input type="text" class="form-control" id="identificacion" name="identificacion"
                            value="{{ old('identificacion', $usuario->persona->identificacion) }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    </div>


                    <div class="mb-3">
                        <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNac" name="fechaNac"
                            value="{{ old('fechaNac', $usuario->persona->fechaNac) }}">
                    </div>

                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" id="sexo" name="sexo">
                            <option value="M" {{ old('sexo', $usuario->persona->sexo) === 'M' ? 'selected' : '' }}>
                                Masculino</option>
                            <option value="F" {{ old('sexo', $usuario->persona->sexo) === 'F' ? 'selected' : '' }}>
                                Femenino</option>
                            <option value="O" {{ old('sexo', $usuario->persona->sexo) === 'O' ? 'selected' : '' }}>
                                Otro</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion"
                            value="{{ old('direccion', $usuario->persona->direccion) }}">
                    </div>


                    <div class="mb-3">
                        <label for="celular" class="form-label">Número de Celular</label>
                        <input type="text" class="form-control" id="celular" name="celular"
                            value="{{ old('celular', $usuario->persona->celular) }}" pattern="[0-9]*"
                            title="Por favor, introduce solo números">
                        @if ($errors->has('celular'))
                            <div class="invalid-feedback">
                                {{ $errors->first('celular') }}
                            </div>
                        @endif
                    </div>
                    <div class="button-container">
                        <button type="submit" class="btn-link modal-button">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection
