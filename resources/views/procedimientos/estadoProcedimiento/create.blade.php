@extends('layouts.app')

@section('title', 'Tipo de Procedimiento')

@section('links')

@endsection
@section('content')


    <h1>Create Estado Procedimiento</h1>

    <form action="{{route('storeEstadoP')}}" method="POST">
    @csrf
    <label for="estado">Estado</label>
    <input type="text" name="estado" id="estado">
    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion" id="descripcion">

    <button type="submit">Crear</button>
    </form>


@endsection
