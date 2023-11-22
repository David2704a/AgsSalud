@extends('layouts.app')

@section('title', 'Elemento')

@section('links')

<link rel="stylesheet" href="{{asset('/css/elemento/elemento.css')}}">

@endsection
@section('content')

<div class="content">
    <h1 class="page-title">EDITAR ELEMENTO</h1>
<div class="green-line"></div>
</div>

<div class="button-container">
    <a href="{{route('elementos.index')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

</div>

<div class="menu-containers">
    <ul class="menu">
        <li>
            <a href="{{route('facturas.index')}}">Facturas</a>
        </li>
        <li>
            <a href="{{route('proveedores.index')}}">Proveedores</a>
        </li>
    </ul>
</div>


    <form class="form" action="{{route('elementos.update', $elemento->idElemento)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <label for="marca">Marca del producto</label>
        <input type="text" name="marca" id="marca" class="input" value="{{$elemento->marca}}">
        <label for="referencia">Referencia del producto</label>
        <input type="text" name="referencia" id="referencia" class="input"value="{{$elemento->referencia}}">
        <label for="serial">Serial del producto</label>
        <input type="text" name="serial" id="serial" class="input" value="{{$elemento->serial}}">
        <label for="especificaciones">Especificaciones del producto</label>
        <input type="text" name="especificaciones" id="especificaciones" class="input" value="{{$elemento->especificaciones}}">
        <label for="modelo">Modelo del producto</label>
        <input type="text" name="modelo" id="modelo" class="input"value="{{$elemento->modelo}}">
        <label for="garantia">Tiempo de garantia (meses)</label>
        <input type="text" name="garantia" id="garantia" class="input" value="{{$elemento->garantia}}">
        <label for="valor">Valor del producto</label>
        <input type="number" name="valor" id="valor" class="input" value="{{$elemento->valor}}">
        <label for="descripcion">Descripcion del producto</label>
        <input type="text" name="descripcion" id="descripcion" class="input" value="{{$elemento->descripcion}}">
        <label for="idEstadoEquipo">Estado del producto</label>
        <select name="idEstadoEquipo" id="idEstadoEquipo" class="input">
            @foreach ($estados as $estado)
                <option value="{{$estado->idEstadoE}}">{{ $estado->estado}}</option>
            @endforeach
            <option value="">Seleccione una opcion</option>
        </select>

        <label for="idTipoElemento">Tipo de elemento</label>
        <select name="idTipoElemento" id="idTipoElemento" class="input">
            @foreach ($tipoElementos as $tipo)
                <option value="{{ $tipo->idTipoElemento}}">{{ $tipo->tipo}}
            @endforeach
            <option value="">Seleccione una opcion</option>
        </select>

        <label for="idCategoria">Categoria</label>
        <select name="idCategoria" id="idCategoria" class="input">
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre}}
            @endforeach
            <option value="">Seleccione una opcion</option>
        </select>

        <label for="idFactura">Pertenece a Factura</label>
        <select name="idFactura" id="idFactura" class="input">
            @foreach ($facturas as $factura)
                <option value="{{ $factura->idFactura }}">{{ $factura->codigoFactura}}
            @endforeach
            <option value="">Seleccione una opcion</option>
        </select>

        <label for="idUsuario">Asignado A:</label>
        <select name="idUsuario" id="idUsuario" class="input">
            @foreach ($users as $user)
                <option value="{{$user->id }}">{{ $user->name}}</option>
            @endforeach
            <option value="">Seleccione una opcion</option>
        </select>
        <div class="button-container">
            <button type="submit">Actualizar</button>
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
