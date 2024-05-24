@extends('layouts.app')

@section('title', 'Elemento')

@section('links')

<link rel="stylesheet" href="{{asset('/css/elemento/elemento.css')}}">
<script src="{{asset('js/elemento/elemento.js')}}"></script>

@endsection
@section('content')
<div class="content2">
<div class="content" style="text-align: center">
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
        <input type="text" name="marca" id="marca" class="input" value="{{$elemento->marca}}" >
        <label for="referencia">Referencia del producto</label>
        <input type="text" name="referencia" id="referencia" class="input"value="{{$elemento->referencia}}" >
        <label for="serial">Serial del producto</label>
        <input type="text" name="serial" id="serial" class="input" value="{{$elemento->serial}}" >
        <label for="modelo">Modelo del producto</label>
        <input type="text" name="modelo" id="modelo" class="input"value="{{$elemento->modelo}}" >
        <button type="button" onclick="mostrarParte('parte2')">Siguiente</button>
    </div>

    <div class="form-part" id="parte2">
        <label for="garantia">Tiempo de garantia (meses)</label>
        <input type="text" name="garantia" id="garantia" class="input" value="{{$elemento->garantia}}" >
        <label for="ram">Ram del elemento</label>
        <input type="ram" name="ram" id="ram" class="input" value="{{$elemento->ram}}" >
        <label for="descripcion">Descripcion del producto</label>
        <input type="text" name="descripcion" id="descripcion" class="input" value="{{$elemento->descripcion}}" >
        <label for="procesador">Procesador del elemento</label>
        <input type="text" name="procesador" id="procesador" class="input" value="{{$elemento->procesador}}" >

        <button type="button" onclick="mostrarParte('parte1')">Anterior</button>
        <button type="button" onclick="mostrarParte('parte3')">Siguiente</button>
    </div>

    <div class="form-part" id="parte3">
        <label for="disco_duro">Disco duro del elemento</label>
        <input type="text" name="disco_duro" id="disco_duro" class="input" value="{{$elemento->disco_duro}}">
        <label for="tarjeta_grafica">Tarjeta gráfica del elemento</label>
        <input type="text" name="tarjeta_grafica" id="tarjeta_grafica" class="input" value="{{$elemento->tarjeta_grafica}}" >

        <label for="idEstadoEquipo">Estado del producto</label>
        <select name="idEstadoEquipo" id="idEstadoEquipo" class="input" >
            @if($elemento->estado)
                <option selected value="{{ $elemento->estado->idEstadoE }}">{{ $elemento->estado->estado }}</option>
            @endif
            @foreach ($estados as $estado)
                <option value="{{$estado->idEstadoE}}">{{ $estado->estado}}</option>
            @endforeach
        </select>

        <button type="button" onclick="mostrarParte('parte2')">Anterior</button>
        <button type="button" onclick="mostrarParte('parte4')">Siguiente</button>
    </div>

    <div class="form-part" id="parte4">

        <label for="idCategoria">Categoria</label>
        <select name="idCategoria" id="idCategoria" class="input" >
            @if($elemento->categoria)
                <option selected value="{{ $elemento->categoria->idCategoria }}">{{ $elemento->categoria->nombre }}</option>
            @endif
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre}}
            @endforeach
            <option value="">Seleccione una opcion</option>
        </select>

        <label for="idFactura">Pertenece a Factura</label>
        <select name="idFactura" id="idFactura" class="input" >
            @if($elemento->factura)
                <option selected value="{{ $elemento->factura->idFactura }}">{{ $elemento->factura->codigoFactura }}</option>
            @endif
            @foreach ($facturas as $factura)
                <option value="{{ $factura->idFactura }}">{{ $factura->codigoFactura}}
            @endforeach
            <option value="">Seleccione una opcion</option>
        </select>

        <label for="idUsuario">Asignado A:</label>
        <select name="idUsuario" id="idUsuario" class="input" >
            @if($elemento->user)
                <option selected value="{{ $elemento->user->id }}">{{ $elemento->user->name }}</option>
            @endif
            <option value="">Sin asignar</option>
            @foreach ($users as $user)
                <option value="{{$user->id }}">{{ $user->name}}</option>
            @endforeach
        </select>
        <div class="button-container">
            <button type="button" onclick="mostrarParte('parte3')">Anterior</button>
            <button type="submit">Actualizar</button>
        </div>
    </div>

    </form>
</div>
@endsection
