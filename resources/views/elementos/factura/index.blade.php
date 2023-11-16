@extends('layouts.app')

@section('title', 'Factura')

@section('links')

<link rel="stylesheet" href="{{asset('/css/procedimiento/procedimiento.css')}}">
<script src="{{asset('js/proveedor/proveedor.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
@section('content')

    <div class="content">
<h1 class="page-title">Facturas</h1>
<div class="green-line"></div>

<div class="button-container">
    <a href="/facturas" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    <a href="{{route('facturas.create')}}" class="button-derecha"><i class="fas fa-file"></i> Nueva Factura</a>

</div>
<div class="menu-container">
    <ul class="menu">
        <li>
            <a href="{{route('facturas.index')}}">Facturas</a>
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
            <th>ID</th>
            <th>Codigo</th>
            <th>fecha Compra</th>
            <th>Proveedor</th>
            <th>Metodo Pago</th>
            <th>Estado Pago</th>
            <th>Valor</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($facturas as $factura)
                <tr>
                    <td>{{$factura->idFactura}}</td>
                    <td>{{$factura->codigoFactura}}</td>
                    <td>{{$factura->fechaCompra}}</td>
                    <td>{{$factura->proveedor->nombre}}</td>
                    <td>{{$factura->metodoPago}}</td>
                    <td>{{$factura->estadoPago}}</td>
                    <td>{{$factura->valor}}</td>
                    <td>{{$factura->descripcion}}</td>
                    <td>
                        <a class="edit-button"
                            href="{{ route('facturas.edit',$factura->idFactura) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <button title="Eliminar"
                        type="button" class="delete-button"
                        data-id="{{$factura->idFactura }}"
                        data-tipo="{{$factura->codigoFactura}}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    </div>
    <div class="pagination">
        {{$facturas->links('pagination.custom') }}  
    </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm" action="{{ route('facturas.destroy','REPLACE_ID') }}" method="POST">
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
