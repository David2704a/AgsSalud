@extends('layouts.app')

@section('title', 'Proveedor')

@section('links')

<link rel="stylesheet" href="{{asset('/css/factura/factura.css')}}">
<script src="{{asset('js/factura/factura.js')}}"></script>

@endsection
@section('content')

<div class="content">
    <h1 class="page-title">CREAR NUEVA FACTURA</h1>
<div class="green-line"></div>
</div>

<div class="button-container">
    <a href="{{route('facturas.index')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

</div>

<div class="menu-containers">
    <ul class="menu">
        <li>
            <a href="{{route('proveedores.create')}}">Crear Proveedor</a>
        </li>
    </ul>
</div>


    <form class="form" action="{{route('facturas.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        <label for="codigoFactura">Codigo Factura</label>
        <input type="text" name="codigoFactura" id="codigoFactura" class="input">
        <label for="fechaCompra">Fecha de Compra</label>
        <input type="date" name="fechaCompra" id="fechaCompra" class="input">
        <label for="idProveedor">Proveedor</label>
        <select name="idProveedor" id="idProveedor" class="input">
            <option value="">Seleccionar el Proveedor</option>
            @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->idProveedor }}">{{ $proveedor->nombre }}</option>
            @endforeach
        </select>
        <label for="metodoPago">Metodo de Pago</label>
        <input type="text" name="metodoPago" id="metodoPago" class="input">
        <label for="rutaFactura">Archivo:</label>
        <input type="file" name="rutaFactura" id="rutaFactura" class="input">
        <label for="valor">Valor</label>
        <input type="number" name="valor" id="valor" step="0.01" class="input">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" class="input">
        <div class="button-container">
            <button type="submit">Crear</button>
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
