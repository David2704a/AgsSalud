@extends('layouts.app')

@section('title', 'Tipo de Procedimiento')

@section('links')

<link rel="stylesheet" href="{{asset('/css/tipoProcedimiento/tipoProcedimiento.css')}}">

@endsection
@section('content')

<div class="content">
    <h1 class="page-title">EDITAR TIPO DE PROCEDIMIENTOS</h1>
<div class="green-line"></div>
</div>

<div class="button-container">
    <a href="{{route('mostrarTipoP')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

</div>

<div class="menu-containers">
    <ul class="menu">
        <li>
            <a href="{{route('mostrarEstadoP')}}">Estado de Procedimiento</a>
        </li>
        <li>
            <a href="{{route('mostrarProcedimiento')}}">Procedimiento</a>
        </li>
    </ul>
</div>


    <form class="form" action="{{route('updateTipoP', ['id'=> $tipoProcedimiento->idTipoProcedimiento])}}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-part active" id="parte1">
        <label for="tipo">Tipo de Procedimiento</label>
        <input type="text" name="tipo" id="tipo" value="{{$tipoProcedimiento->tipo}}">
        <br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" value="{{$tipoProcedimiento->descripcion}}">
        <br>
        <div class="button-container">
            <button type="submit">Actualizar</button>
        </div>
    </div>

    </form>



@endsection
