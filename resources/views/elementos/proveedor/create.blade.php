@extends('layouts.app')

@section('title', 'Proveedor')

@section('links')

<link rel="stylesheet" href="{{asset('/css/tipoProcedimiento/tipoProcedimiento.css')}}">

@endsection
@section('content')

<div class="content">
    <h1 class="page-title">CREAR PROVEEDOR</h1>
<div class="green-line"></div>
</div>

<div class="button-container">
    <a href="{{route('proveedores.index')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

</div>

<div class="menu-containers">
    <ul class="menu">
        <li>
            {{-- <a href="{{route('proveedores.create')}}">Crear Proveedor</a> --}}
        </li>
    </ul>
</div>


    <form class="form" action="{{route('proveedores.store')}}" method="POST">
    @csrf

    <div class="form-part active" id="parte1">
        <label for="nombre">Nombre Proveedor</label>
        <input type="text" name="nombre" id="nombre"><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono"><br>
        <label for="correoElectronico">Correo Electronico</label>
        <input type="text" name="correoElectronico" id="correoElectronico"><br>
        <label for="direccion">direccion</label>
        <input type="text" name="direccion" id="direccion"><br>
        <label for="nit">NIT</label>
        <input type="text" name="nit" id="nit"><br>
        <div class="button-container">
            <button type="submit">Crear</button>
        </div>
    </div>

    </form>




@endsection
