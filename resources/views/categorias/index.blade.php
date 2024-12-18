

@extends('layouts.app')

@section('title', 'Categorias')


@section('links')

<link rel="stylesheet" href="{{asset('/css/categoria/categoria.css')}}">
<script src="{{asset('js/categoria/categoria.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection



@section('content')
<div class="content2">
<div class="content">
<h1 class="page-title">Categoria</h1>
<div class="green-line"></div>
</div>

<div class="button-container">
    <a href="{{url('/dashboard')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
    <a href="{{route('categorias.create')}}" class="button-derecha"><i class="fas fa-file"></i> Nueva categoria</a>
    @endif
</div>




@if(session('success'))
    <div id="alert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


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
                    @if(auth()->user()->hasRole(['superAdmin','administador']))
                    <th>
                        Acciones
                    </th>
                    @endif
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->idCategoria }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        @if(auth()->user()->hasRole(['superAdmin','administador']))
                        <td>


                            @if(auth()->user()->hasRole(['superAdmin','administrador']))
                            <a class="edit-button" method="POST"
                             href="{{ route('categorias.edit', ['idCategoria' => $categoria->idCategoria]) }}"
                                title="Editar"><i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            @endif

                            @if(auth()->user()->hasRole(['superAdmin']))
                            <button type="button" class="delete-button" title="Eliminar"
                            data-id="{{ $categoria->idCategoria }}"
                             data-name="{{ $categoria->nombre }}">

                                <i data-id="{{ $categoria->idCategoria }}" data-name="{{ $categoria->nombre }}" class="fas fa-trash-alt"></i>
                            </button>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>








    <div class="pagination">
        {{ $categorias->links('pagination.custom') }}
    </div>



<div id="myModal" class="modalEliminar">
    <div class="modal_content">
        <p id="modalMessage"></p>
        <div class="button-container">
            <button id="cancelButton" class="modal-button">Cancelar</button>
            <form id="deleteForm" action="{{ route('categorias.destroy','REPLACE_ID') }}" method="POST">
                @csrf
                @method('DELETE')
                <button id="confirmDelete" type="submit" class="btn-link modal-button">Eliminar</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
