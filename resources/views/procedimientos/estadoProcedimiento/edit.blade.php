@extends('layouts.app')

@section('title', 'Estado de Procedimiento')

@section('links')

<link rel="stylesheet" href="{{asset('/css/tipoProcedimiento/tipoProcedimiento.css')}}">

@endsection
@section('content')
<div class="content2">
<div class="content">
    <h1 class="page-title">EDITAR ESTADO DE PROCEDIMIENTOS</h1>
<div class="green-line"></div>
</div>

<div class="button-container">
    <a href="{{route('mostrarEstadoP')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

</div>

<div class="menu-containers">
    <ul class="menu">
        <li>
            <a href="{{route('mostrarTipoP')}}">Tipo de Procedimiento</a>
        </li>
        <li>
            <a href="{{route('mostrarProcedimiento')}}">Procedimiento</a>
        </li>
    </ul>
</div>


    <form class="form" action="{{route('updateEstadoP', ['id'=> $estadoProcedimiento->idEstadoP])}}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-part active" id="parte1">
        <label for="estado">Estado de Procedimiento</label>
        <input type="text" name="estado" id="estado" value="{{$estadoProcedimiento->estado}}">
        <br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" value="{{$estadoProcedimiento->descripcion}}">
        <br>
        <div class="button-container">
            <button type="submit">Actualizar</button>
        </div>
    </div>
    </form>
</div>
@endsection
