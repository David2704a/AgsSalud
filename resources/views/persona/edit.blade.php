@extends('layouts.app')

@section('title', 'Editar perfil')
@php
    use Illuminate\Support\Facades\Auth;
@endphp


@section('links')
    <link rel="stylesheet" href="{{ asset('/css/persona.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection




@section('content')
    <div class="content2">
        <h1 class="page-title" style="display: flex;justify-content:center;">EDITAR INFORMACIÓN PERSONAL</h1>
        <div class="green-line mt-2"></div>


        <div class="button-container">
            <a href="{{ route('persona.index') }}" class="button-izquierda arrow-left">
                <i class="fa-solid fa-circle-arrow-left"></i> Regresar
            </a>
        </div>


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

            <form class="formUpadateP" action="{{ route('personas.update', $usuario->persona->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="mb-3 col-sm-3">
                        <label for="nombre1" class="form-label">Primer Nombre</label>
                        <input type="text" class="form-control" id="nombre1" name="nombre1"
                            value="{{ old('nombre1', optional(Auth::user()->persona)->nombre1) }}">
                    </div>
                    <div class="mb-3 col-sm-3">
                        <label for="nombre2" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" id="nombre2" name="nombre2"
                            value="{{ old('nombre2', optional(Auth::user()->persona)->nombre2) }}">
                    </div>
                    <div class="mb-3 col-sm-3">
                        <label for="apellido1" class="form-label">Primer Apellido</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1"
                            value="{{ old('apellido1', optional(Auth::user()->persona)->apellido1) }}">
                    </div>
                    <div class="mb-3 col-sm-3">
                        <label for="apellido2" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" id="apellido2" name="apellido2"
                            value="{{ old('apellido2', optional(Auth::user()->persona)->apellido2) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-sm-3">
                        <label for="idTipoIdentificacion" class="form-label">Tipo Identificación</label>
                        <select class="form-select " id="idTipoIdentificacion" name="idTipoIdentificacion">
                            @foreach ($tiposIdentificacion as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ old('idTipoIdentificacion', $usuario->persona->idTipoIdentificacion) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->Detalle }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-sm-3">
                        <label for="identificacion" class="form-label">Número de Identificación</label>
                        <input type="text" class="form-control" id="identificacion" name="identificacion"
                            value="{{ old('identificacion', $usuario->persona->identificacion) }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    </div>
                    <div class="mb-3 col-sm-3">
                        <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNac" name="fechaNac"
                            value="{{ old('fechaNac', $usuario->persona->fechaNac) }}">
                    </div>
                    <div class="mb-3 col-sm-3">
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
                </div>
                <div class="row">
                    <div class="mb-3 col-sm-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <div class="input-group">
                            <div class="icon">
                                <img src="https://img.icons8.com/material-outlined/24/ffffff/address.png" alt="Dirección Icon">
                            </div>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección"
                                value="{{ old('direccion', $usuario->persona->direccion) }}">
                        </div>
                    </div>
                    <div class="mb-3 col-sm-6">
                        <label for="celular" class="form-label">Número de Celular</label>
                        <div class="input-group">
                            <div class="icon">
                                <img src="https://img.icons8.com/material-outlined/24/ffffff/phone.png" alt="Celular Icon">
                            </div>
                            <input type="text" class="form-control" id="celular" name="celular"
                                placeholder="Número de Celular" value="{{ old('celular', $usuario->persona->celular) }}"
                                pattern="[0-9]*" title="Por favor, introduce solo números">
                        </div>
                        @if ($errors->has('celular'))
                            <div class="invalid-feedback">
                                {{ $errors->first('celular') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="button_container_save">
                    <button type="submit" class="btn_saveE">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>



@endsection
