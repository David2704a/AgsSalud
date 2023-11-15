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
    <a href="/Proveedor" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    <a href="{{route('proveedores.create')}}" class="button-derecha"><i class="fas fa-file"></i> Nuevo Provedor</a>

</div>


<div class="menu-container">
    <ul class="menu">
        <li>
            <a href="{{route('proveedores.index')}}">proveedor</a>
        </li>
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
            <th>
                ID
            </th>
            <th>
                Proveedor
            </th>
            <th>
                Nit
            </th>
            <th>
                Telefono
            </th>
            <th>
                Correo Electronico
            </th>
            <th>
                Direccion
            </th>
            <th>
                Acciones
            </th>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
                <tr>
                    <td>
                        {{$proveedor->idProveedor}}
                    </td>
                    <td>
                        {{$proveedor->nombre}}
                    </td>
                    <td>
                        {{$proveedor->nit}}
                    </td>
                    <td>
                        {{$proveedor->telefono}}
                    </td>
                    <td>
                        {{$proveedor->correoElectronico}}
                    </td>
                    <td>
                        {{$proveedor->direccion}}
                    </td>
                    <td>
                        <a href="{{ route('proveedores.edit', $proveedor->idProveedor) }}" title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                        <button title="Eliminar"
                        type="button" class="delete-button"
                        data-id="{{ $proveedor->idProveedor }}"
                        data-tipo="{{$proveedor->nombre}}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    </div>
    <div class="pagination">
        {{-- {{ $proveedor->links('pagination.custom') }} --}}  
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
                <img src="{{asset('imgs/logos/Logo-IQNet .png')}}" width="75" alt="Imagen 6">
            </div>
            <div class="separator"></div>
            <div class="text">
                <p>Copyright © 2023 AGS SALUD SAS</p>
                <p>Todos los derechos Reservados</p>
            </div>
        </div>
    </footer>

@endsection
