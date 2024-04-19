<!-- resources/views/categorias/create.blade.php -->

@extends('layouts.app')

@section('title', 'Crear Categoría')


@section('links')

<link rel="stylesheet" href="{{asset('/css/categoria/categoria.css')}}">

@endsection




@section('content')

<div class="content2">
    <div class="content">
        <h1 class="page-title">Crear Nueva Categoría</h1>
        <div class="green-line"></div>
    </div>

    <div class="button-container">
        <a href="{{ route('categorias.index') }}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    </div>


    @if ($errors->any())
        <div id="alert" class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form" action="{{ route('categorias.store') }}" method="POST">
        @csrf

        <div class="form-part active" id="parte1">
            <label for="nombre">Nombre categoria</label>
            <input type="text" name="nombre" id="tipo" value="{{ old('nombre') }}">
            <br>
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion') }}">
            <br>
            <div class="button-container">
                <button type="submit">Crear</button>
            </div>
        </div>
    </form>
</div>
@endsection
