@extends('layouts.app')

@section('title', 'Elemento')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/elemento/elementosfisicos.css') }}">
    <script src="{{ asset('js/elemento/elemento.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1 class="page-title">Elementos físicos</h1>
        <div class="green-line mx-auto my-3"></div>
    </div>

    <div class="d-flex justify-content-between my-4 button-container" style="width: 50%">
        <a href="{{ url('/dashboard') }}" class="btn btn-primary button-izquierda arrow-left">
            <i class="fa-solid fa-circle-arrow-left"></i> Regresar
        </a>
        {{-- @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico'])) --}}
        <a href="{{ route('elementos-fisicos.create') }}"  class="btn btn-success button-derecha">
            <i class="fas fa-file"></i> Nuevo Elemento
        </a>
        {{-- @endif --}}
    </div>

    
    

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card table-container">
        <div class="card-body ">
            <div class="search-container mb-3">
                <div class="input-group">
                    <input type="text" id="search-inputt" class="form-control" placeholder="Buscar...">
                    <div class="input-group-append">
                        <button class="btn btn-secondary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive table" >
                <table class="table table-striped" id="tableElementos">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Referencia</th>
                            <th>Número</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th>N° Factura</th>
                            <th>Asignado A:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1212</td>
                            <td>silla</td>
                            <td>bonita</td>
                            <td>1</td>
                            <td>ta wena</td>
                            <td>aun wena</td>
                            <td>sillita</td>
                            <td>42w7</td>
                            <td>mimi</td>
                        </tr>
                        {{-- @foreach ($elementos as $elemento)
                            <tr>
                                <td>{{ $elemento->id }}</td>
                                <td>{{ $elemento->codigo }}</td>
                                <td>{{ $elemento->categoria }}</td>
                                <td>{{ $elemento->referencia }}</td>
                                <td>{{ $elemento->numero }}</td>
                                <td>{{ $elemento->descripcion }}</td>
                                <td>{{ $elemento->estado }}</td>
                                <td>{{ $elemento->tipo }}</td>
                                <td>{{ $elemento->factura }}</td>
                                <td>{{ $elemento->asignado_a }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

@endsection

