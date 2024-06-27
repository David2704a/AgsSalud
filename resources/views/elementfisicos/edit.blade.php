@extends('layouts.app')

@section('title', 'Editar Elemento')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/elemento/elementosfisicos.css') }}">
    <script src="{{ asset('js/elemento/elemento.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1 class="page-title">Editar Elemento Físico</h1>
        <div class="green-line mx-auto my-3"></div>
    </div>

    <div class="d-flex justify-content-between my-4 button-container" style="width: 50%">
        <a href="{{ url('/dashboard') }}" class="btn btn-primary button-izquierda arrow-left">
            <i class="fa-solid fa-circle-arrow-left"></i> Regresar
        </a>
    </div>

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <form class="form" action="{{ route('elementos-fisicos.update', $elemento->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="progress-bar">
                <div class="progress" id="progress" style="width: 50%;"></div>
                <div class="markers">
                    <span class="marker filled" style="left: 30%;">1</span>
                    <span class="marker filled" style="left: 70%;">2</span>
                </div>
            </div>
    
            <div class="form-part active" id="parte1">
                <label for="idDispo">Id Dispositivo</label>
                <input type="text" name="id_dispo" id="id_dispo" class="input" value="{{ $elemento->id_dispo }}" readonly>

                <label for="idCategoria">Categoría</label>
                <select name="idCategoria" id="idCategoria" class="input">
                    <option value="">Seleccionar la Categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->idCategoria }}" {{ $elemento->idCategoria == $categoria->idCategoria ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>

                <label for="marca">Marca del producto</label>
                <input type="text" name="marca" id="marca" class="input" value="{{ $elemento->marca }}">

                <label for="idUser">Asignado A:</label>
                <select name="idUser" id="idUser" class="input">
                    <option value="">Seleccionar una opción</option>
                    @foreach ($personas as $persona)
                        <option value="{{ $persona->id }}" 
                                {{ $elemento->user && $elemento->user->idPersona == $persona->id ? 'selected' : '' }}>
                            {{ $persona->identificacion }} - 
                            {{ $persona->nombre1 }} 
                            {{ $persona->nombre2 ?? '' }} 
                            {{ $persona->apellido1 }} 
                            {{ $persona->apellido2 ?? '' }}
                        </option>
                    @endforeach
                </select>
                <label for="estado_ofi">Estado oficina</label>
                <input type="text" name="estado_ofi" id="estado_ofi" class="input" value="{{ $elemento->estado_oficina }}">

                <label for="idEstadoEquipo">Estado del producto</label>
                <select name="idEstadoEquipo" id="idEstadoEquipo" class="input">
                    <option value="">Seleccionar el estado</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->idEstadoE }}" {{ $elemento->idEstado == $estado->idEstadoE ? 'selected' : '' }}>
                            {{ $estado->estado }}
                        </option>
                    @endforeach
                </select>
                
                <button type="button" onclick="mostrarParte('parte2')">Siguiente</button>
            </div>
    
            <div class="form-part" id="parte2">
                <label for="observacion">Observación</label>
                <input type="text" name="observacion" id="observacion" class="input" value="{{ $elemento->observacion }}">

                <label for="sede">Sede</label>
                <input type="text" name="sede" id="sede" class="input" value="{{ $elemento->sede }}">

                <label for="ubicacion_interna">Ubicación interna</label>
                <input type="text" name="ubicacion_interna" id="ubicacion_interna" class="input" value="{{ $elemento->ubicacion_interna }}">

                <label for="ubicacion_especifica">Ubicación específica</label>
                <input type="text" name="ubicacion_especifica" id="ubicacion_especifica" class="input" value="{{ $elemento->ubicacion_especifica }}">

                <div class="button-container">
                    <button type="button" onclick="mostrarParte('parte1')">Anterior</button>
                    <button type="submit">Actualizar</button>
                </div>
    
            </div>
    
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

@endsection
