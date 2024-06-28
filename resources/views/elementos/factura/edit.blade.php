@extends('layouts.app')

@section('title', 'Factura')

@section('links')

    <link rel="stylesheet" href="{{ asset('/css/factura/factura.css') }}">

@endsection
@section('content')
    <div class="content2">
        <div class="content">
            <h1 class="page-title">EDITAR FACTURA</h1>
            <div class="green-line"></div>
        </div>

        <div class="button-container">
            <a href="{{ route('facturas.index') }}" class="button-izquierda arrow-left"><i
                    class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

        </div>

        <div class="menu-containers">
            <ul class="menu">
                <li>
                    <a href="{{ route('proveedores.index') }}">Proveedores</a>
                </li>
                <li>
                    <a href="{{ route('proveedores.index') }}">Elementos</a>
                </li>
            </ul>
        </div>


        <form class="form" action="{{ route('facturas.update', $factura->idFactura) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="codigoFactura">Codigo Factura(*)</label>
            <input type="text" name="codigoFactura" id="codigoFactura" class="input"
                value="{{ $factura->codigoFactura }}">
            <label for="fechaCompra">Fecha de Compra(*)</label>
            <input type="date" name="fechaCompra" id="fechaCompra" class="input" value="{{ $factura->fechaCompra }}">
            <label for="idProveedor">Proveedor(*)</label>
            <select name="idProveedor" id="idProveedor" class="input" value="{{ $factura->proveedor->nombre }}">
                @if($factura->proveedor)
                    <option selected value="{{ $factura->proveedor->idProveedor }}">{{ $factura->proveedor->nombre }}</option>
                @endif
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->idProveedor }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
            <label for="metodoPago">Metodo de Pago</label>
            <input type="text" name="metodoPago" id="metodoPago" class="input" value="{{ $factura->metodoPago }}">
            <label for="rutaFactura">Archivo:</label>
            <input type="file" name="rutaFactura" id="rutaFactura" class="input" value="{{ $factura->rutaFactura }}">
            <label for="valor">Valor</label>
            <input type="number" name="valor" id="valor" step="0.01" class="input"
                value="{{ $factura->valor }}">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" class="input" value="{{ $factura->descripcion }}">
            <div class="button-container">
                <button type="submit">Actualizar</button>
            </div>

        </form>

    </div>
@endsection
