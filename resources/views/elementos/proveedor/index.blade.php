@extends('layouts.app')

@section('title', 'Proveedor')

@section('links')

<link rel="stylesheet" href="{{asset('/css/tipoProcedimiento/tipoProcedimiento.css')}}">
<script src="{{asset('js/proveedor/proveedor.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
@section('content')

    <div class="content">
<h1 class="page-title">PROVEEDORES</h1>
<div class="green-line"></div>

<div class="button-container">
    <a href="{{url('/elementos')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
    <a href="{{route('proveedores.create')}}" class="button-derecha"><i class="fas fa-file"></i> Nuevo Provedor</a>
    @endif
</div>
<div class="menu-container">
    <ul class="menu">
        @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
        <li>
            <a href="{{route('facturas.index')}}">Facturas</a>
        </li>
        @endif
        @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))        <li>
            <a href="{{route('elementos.index')}}">Elementos</a>
        </li>
        @endif
    </ul>
</div>

@if(session('success'))
    <div id="success-alert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="table-container">
        <div class="search-container">
            <input type="text" id="search-input" placeholder="Buscar...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    <div class="table">
    <table>
        <thead>
            <th>ID</th>
            <th>Proveedor</th>
            <th>Nit</th>
            <th>Telefono</th>
            <th>Correo Electronico</th>
            <th>Direccion</th>
            @if(auth()->user()->hasRole(['superAdmin','administrador']))
            <th>Acciones</th>
            @endif
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{$proveedor->idProveedor}}</td>
                    <td>{{$proveedor->nombre}}</td>
                    <td>{{$proveedor->nit}}</td>
                    <td>{{$proveedor->telefono}}</td>
                    <td>{{$proveedor->correoElectronico}}</td>
                    <td>{{$proveedor->direccion}}</td>
                    @if(auth()->user()->hasRole(['superAdmin','administrador']))
                    <td>
                        @if(auth()->user()->hasRole(['superAdmin','administrador']))                        <a class="edit-button"
                            href="{{ route('proveedores.edit',$proveedor->idProveedor) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        @endif
                        @if(auth()->user()->hasRole(['superAdmin']))                        <button title="Eliminar"
                        type="button" class="delete-button"
                        data-id="{{ $proveedor->idProveedor }}"
                        data-tipo="{{$proveedor->nombre}}">
                        <i class="fas fa-trash-alt"></i>
                        </button>
                        @endif
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    </div>
    <div class="pagination">
        {{$proveedores->links('pagination.custom') }}
    </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm" action="{{ route('proveedores.destroy','REPLACE_ID') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="confirmDelete" type="submit" class="btn-link modal-button">Eliminar</button>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>




@endsection
