<!-- resources/views/categorias/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('links')

<link rel="stylesheet" href="{{asset('/css/categoria/categoria.css')}}">

@endsection


@section('content')

<div class="content2">

    <div class="content">
        <h1 class="page-title">Editar Categoría</h1>
        <div class="green-line"></div>
    </div>

    <div class="button-container">
        <a href="{{ route('categorias.index') }}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    </div>

    <form class="form" action="{{ route('categorias.update', ['idCategoria' => $categoria->idCategoria]) }}" method="POST">
        @csrf
        @method('put')

        <div class="form-part active" id="parte1">
            <label for="nombre">Nombre de la Categoría</label>
            <input type="text" name="nombre" id="nombre" value="{{ $categoria->nombre }}">
            <br>
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" value="{{ $categoria->descripcion }}">
            <br>
            <div class="button-container">
                <button type="submit">Actualizar</button>
            </div>
        </div>

    </form>

</div>
@endsection
