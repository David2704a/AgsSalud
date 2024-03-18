@extends('layouts.app')

@section('title','Procedimiento')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/procedimiento/procedimiento.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/prodedimiento/procedimiento.js')}}"></script>


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
            <a href="{{route('mostrarEstadoP')}}">Estado de Procedimiento</a>
        </li>
        <li>
            <a href="{{route('mostrarTipoP')}}">Tipo de Procedimiento</a>
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

<form class="form" action="{{ route('storeProcedimiento') }}" method="POST">
    @csrf

    <div class="progress-bar">
        <div class="progress" id="progress" style="width: 33.33%;"></div>
        <div class="markers">
            <span class="marker filled" style="left: 33.33%;">1</span>
            <span class="marker" style="left: 66.66%;">2</span>
            <span class="marker" style="left: 100%;">3</span>
        </div>
    </div>

    <!-- Parte 1 -->
    <div class="form-part active" id="parte1">
        <label for="fechaInicio">Fecha Inicio</label>
        <input type="date" name="fechaInicio" id="fechaInicio">
        <br>
        <label for="fechaFin">Fecha Fin</label>
        <input type="date" name="fechaFin" id="fechaFin">
        <br>
        <label for="hora">Hora</label>
        <input type="time" name="hora" id="hora">
        <br>
        <button type="button" onclick="mostrarParte('parte2')">Siguiente</button>
    </div>

    <!-- Parte 2 -->
    <div class="form-part" id="parte2">
        <label for="fechaReprogramada">Fecha Reprogramada</label>
        <input type="date" name="fechaReprogramada" id="fechaReprogramada" value="alo" disabled>
        <span class="input-message">La fecha reprogramada se asignará automáticamente al terminar el procedimiento.</span>
        <label for="observacion">Observación</label>
        <input type="text" name="observacion" id="observacion" placeholder="Escriba aqui una observación sobre el procedimiento...">
        <label for="idResponsableEntrega">Responsable Entrega</label>
        <select name="idResponsableEntrega" id="idResponsableEntrega">
            <option value="">Seleccionar una opción</option>
            @foreach ($usuariosEntrega as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
            @endforeach
        </select>

        <button type="button" onclick="mostrarParte('parte1')">Anterior</button>
        <button type="button" onclick="mostrarParte('parte3')">Siguiente</button>
    </div>

    <!-- Parte 3 -->
    <div class="form-part" id="parte3">
        <label for="idResponsableRecibe">Responsable Recibe</label>
        <select name="idResponsableRecibe" id="idResponsableRecibe">
            <option value="">Seleccionar una opción</option>
            @foreach ($usuariosRecibe as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
            @endforeach
        </select>
        <br>
            <label for="idElemento">Elemento</label>
            <select name="idElemento" id="idElemento">
                <option value="">Seleccionar una opción</option>
                @foreach ($elemento as $elemento)
                    <option value="{{ $elemento->idElemento }}">{{ $elemento->modelo }}</option>
                @endforeach
            </select>
        <br>
        <label for="idEstadoProcedimiento">Estado Procedimiento</label>
        <select name="idEstadoProcedimiento" id="idEstadoProcedimiento">
            <option value="">Seleccionar una opción</option>
            @foreach ($estadoProcedimiento as $estadoProcedimiento)
                <option value="{{ $estadoProcedimiento->idEstadoP }}">{{ $estadoProcedimiento->estado }}</option>
            @endforeach
        </select>
        <br>
        <label for="idTipoProcedimiento">Tipo Procedimiento</label>
        <select name="idTipoProcedimiento" id="idTipoProcedimiento">
            <option value="">Seleccionar una opción</option>
            @foreach ($tipoProcedimiento as $tipoProcedimiento)
                <option value="{{ $tipoProcedimiento->idTipoProcedimiento }}">{{ $tipoProcedimiento->tipo }}</option>
            @endforeach
        </select>
        <br>
        <div class="button-container">
            <button type="button" onclick="mostrarParte('parte2')">Anterior</button>
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
            {{-- <img src="{{asset('imgs/logos/LOGO ISO.png')}}" width="50" alt="Imagen 5"> --}}
            {{-- <img src="{{asset('imgs/logos/Logo-IQNet.png')}}" width="75" alt="Imagen 6"> --}}
        </div>
        <div class="separator"></div>
        <div class="text">
            <p>Copyright © 2023 AGS SALUD SAS</p>
            <p>Todos los derechos Reservados</p>
        </div>
    </div>
</footer>

@endsection
