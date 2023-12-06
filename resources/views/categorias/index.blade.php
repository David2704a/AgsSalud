<!-- resources/views/categorias/index.blade.php -->

@extends('layouts.app')

@section('title', 'List')


@section('links')

<link rel="stylesheet" href="{{asset('/css/categoria/categoria.css')}}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection



@section('content')
<div class="content">
<h1 class="page-title">Categoria</h1>
<div class="green-line"></div>

<div class="button-container">
    <a href="/dashboard" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    <a href="{{route('categorias.create')}}" class="button-derecha"><i class="fas fa-file"></i> Nueva categoria</a>

</div>




@if(session('success'))
    <div id="alert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    @if ($categorias->count() > 0)
    <div class="table-container">
        <div class="search-container">
            <input type="text" id="search-input" placeholder="Buscar...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="table">
            <table>
                <thead>
                    <th>
                        Id
                    </th>
                    <th>
                        Categoria
                    </th>
                    <th>
                        Descripcion
                    </th>
                    <th>
                        Acciones
                    </th>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->idCategoria }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>


                            <a class="edit-button" method="POST"
                             href="{{ route('categorias.edit', ['idCategoria' => $categoria->idCategoria]) }}" 
                                title="Editar"><i class="fa-regular fa-pen-to-square"></i>
                            </a>



                            <button type="button" class="delete-button" title="Eliminar" 
                            data-id="{{ $categoria->idCategoria }}"
                             data-name="{{ $categoria->nombre }}">

                                <i data-id="{{ $categoria->idCategoria }}" data-name="{{ $categoria->nombre }}" class="fas fa-trash-alt"></i>
                            </button>

                        </td>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
    @else
            <p>No hay categorías disponibles.</p>
        @endif



    <div class="pagination">
        {{ $categorias->links('pagination.custom') }}
    </div>
</div>


<div id="myModal" class="modal">
    <div class="modal-content">
        <p id="modalMessage"></p>
        <div class="button-container">
            <button id="cancelButton" class="modal-button">Cancelar</button>
            <form id="deleteForm" action="{{ route('categorias.destroy', ['idCategoria' => $categoria->idCategoria]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button id="confirmDelete" type="submit" class="btn-link modal-button">Eliminar</button>
            </form>
        </div>
    </div>
</div>

<br>
<br>
<br>




<footer class="footer">
    <div class="left-images">
        <div class="column">
            <img src="{{ asset('imgs/logos/logo-sena.png') }}" width="45" alt="Imagen 1">
            <img src="{{ asset('imgs/logos/ESCUDO COLOMBIA.png') }}" width="45" alt="Imagen 2">
        </div>
        <div class="column">
            <img src="{{ asset('imgs/logos/logo_fondo.png') }}" width="130" alt="Imagen 3">
            <img src="{{ asset('imgs/logos/Logo_Enterritorio.png') }}" width="100" alt="Imagen 4">
        </div>
    </div>
    <div class="right-content">
        <div class="images">
            <img src="{{ asset('imgs/logos/LOGO ISO.png') }}" width="50" alt="Imagen 5">
            <img src="{{ asset('imgs/logos/Logo-IQNet.png') }}" width="75" alt="Imagen 6">
        </div>
        <div class="separator"></div>
        <div class="text">
            <p>Copyright © 2023 AGS SALUD SAS</p>
            <p>Todos los derechos Reservados</p>
        </div>
    </div>
</footer>
@endsection