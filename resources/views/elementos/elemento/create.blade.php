@extends('layouts.app')

@section('title', 'Elemento')

@section('links')

<link rel="stylesheet" href="{{asset('/css/factura/factura.css')}}">
<script src="{{asset('js/elemento/elemento.js')}}"></script>

@endsection
@section('content')

<div class="content">
    <h1 class="page-title">CREAR NUEVO ELEMENTO</h1>
<div class="green-line"></div>
</div>

<div class="button-container">
    <a href="{{route('elementos.index')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

</div>

<div class="menu-containers">
    <ul class="menu">
        <li>
            <a href="{{route('facturas.create')}}">Crear Factura</a>
        </li>
        <li>
            <a href="{{route('proveedores.create')}}">Crear Proveedor</a>
        </li>
    </ul>
</div>


    <form class="form" action="{{route('elementos.store')}}" method="POST" enctype="multipart/form-data">
    @csrf


    <div class="progress-bar">
        <div class="progress" id="progress" style="width: 25%;"></div>
        <div class="markers">
            <span class="marker filled" style="left: 25%;">1</span>
            <span class="marker" style="left: 50%;">2</span>
            <span class="marker" style="left: 75%;">3</span>
            <span class="marker" style="left: 100%;">4</span>
        </div>
    </div>

    <div class="form-part active" id="parte1">
        <label for="marca">Marca del producto</label>
        <input type="text" name="marca" id="marca" class="input">
        <label for="referencia">Referencia del producto</label>
        <input type="text" name="referencia" id="referencia" class="input">
        <label for="serial">Serial del producto</label>
        <input type="text" name="serial" id="serial" class="input">
        <label for="modelo">Modelo del producto</label>
        <input type="text" name="modelo" id="modelo" class="input">

        <button type="button" onclick="mostrarParte('parte2')">Siguiente</button>
    </div>

    <div class="form-part" id="parte2">
        <label for="garantia">Tiempo de garantia (meses)</label>
        <input type="text" name="garantia" id="garantia" class="input">
        <label for="ram">Ram del elemento</label>
        <input type="text" name="ram" id="ram" class="input">
        <label for="descripcion">Descripcion del producto</label>
        <input type="text" name="descripcion" id="descripcion" class="input">
        <label for="procesador">Procesador del elemento</label>
        <input type="text" name="procesador" id="procesador" class="input">

        <button type="button" onclick="mostrarParte('parte1')">Anterior</button>
        <button type="button" onclick="mostrarParte('parte3')">Siguiente</button>

    </div>

    <div class="form-part" id="parte3">
        <label for="disco_duro">Disco duro del elemento</label>
        <input type="text" name="disco_duro" id="disco_duro" class="input">
        <label for="tarjeta_grafica">Tarjeta gráfica del elemento</label>
        <input type="text" name="tarjeta_grafica" id="tarjeta_grafica" class="input">

        <label for="idEstadoEquipo">Estado del producto</label>
        <select name="idEstadoEquipo" id="idEstadoEquipo" class="input">
            <option value="">Seleccionar el estado</option>
            @foreach ($estados as $estado)
                <option value="{{$estado->idEstadoE}}">{{ $estado->estado}}</option>
            @endforeach
        </select>

        <button type="button" onclick="mostrarParte('parte2')">Anterior</button>
        <button type="button" onclick="mostrarParte('parte4')">Siguiente</button>
    </div>

    <div class="form-part" id="parte4">


        <label for="idTipoElemento">Tipo de elemento</label>
        <select name="idTipoElemento" id="idTipoElemento" class="input">
            <option value="">Seleccionar el tipo de elemento</option>
            @foreach ($tipoElementos as $tipo)
                <option value="{{ $tipo->idTipoElemento}}">{{ $tipo->tipo}}
            @endforeach
        </select>

        <label for="idCategoria">Categoria</label>
        <select name="idCategoria" id="idCategoria" class="input">
            <option value="">Seleccionar la Categoria </option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre}}
            @endforeach
        </select>

        <label for="idFactura">Pertenece a Factura</label>
        <select name="idFactura" id="idFactura" class="input">
            <option value="">Seleccionar el codigo de factura</option>
            @foreach ($facturas as $factura)
                <option value="{{ $factura->idFactura }}">{{ $factura->codigoFactura}}
            @endforeach
        </select>

        <label for="idUsuario">Asignado A:</label>
        <select name="idUsuario" id="idUsuario" class="input">
            <option value="">Seleccionar una opcion</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name}}
            @endforeach
        </select>

        <div class="button-container">
            <button type="button" onclick="mostrarParte('parte3')">Anterior</button>
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
