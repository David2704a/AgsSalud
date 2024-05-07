@extends('layouts.app')

@section('title', 'Tipo de Procedimiento')

@section('links')

<link rel="stylesheet" href="{{asset('/css/tipoProcedimiento/tipoProcedimiento.css')}}">
<script src="{{asset('js/tipoProcedimiento/tipoProcedimiento.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
@endsection
@section('content')
<div class="content2">
    <div class="content">
<h1 class="page-title">TIPO DE PROCEDIMIENTOS</h1>
<div class="green-line"></div>
    </div>

<div class="button-container">
    <a href="{{url('/procedimiento')}}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
    @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
        <a href="{{route('createTipoP')}}" class="button-derecha"><i class="fas fa-file"></i> Nuevo Tipo de Procedimiento</a>
    @endif
</div>


<div class="menu-container">
    <ul class="menu">
        @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
        <li>
            <a href="{{route('mostrarProcedimiento')}}">Procedimiento</a>
        </li>
        @endif
        @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
        <li>
            <a href="{{route('mostrarEstadoP')}}">Estado de Procedimiento</a>
        </li>
        @endif
    </ul>
</div>

@if(session('success'))
    <div id="alert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="table-container">
        {{-- <div class="search-container">
            <input type="text" id="search-input" placeholder="Buscar...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </div> --}}
    <div class="table tableTipoP">
    <table id="tableTipoP">
        <thead>
            <th>
                ID
            </th>
            <th>
                Tipo
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
            @foreach ($tipoProcedimiento as $tipoProcedimientos)
                <tr>
                    <td>
                        {{$tipoProcedimientos->idTipoProcedimiento}}
                    </td>
                    <td>
                        {{$tipoProcedimientos->tipo}}
                    </td>
                    <td>
                        {{$tipoProcedimientos->descripcion}}
                    </td>
                    @if(auth()->user()->hasRole(['superAdmin','administador']))
                    <td>
                        @if(auth()->user()->hasRole(['superAdmin','administrador']))
                        <a
                            class="edit-button"
                            href="{{ route('editTipoP',
                            ['id' => $tipoProcedimientos->idTipoProcedimiento]) }}"
                            title="Editar"><i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        @endif
                        @if(auth()->user()->hasRole(['superAdmin']))
                        <button
                            type="button" class="delete-button" title="Eliminar"
                            data-id="{{ $tipoProcedimientos->idTipoProcedimiento }}"
                            data-name="{{$tipoProcedimientos->tipo}}">

                        <i
                            data-id="{{ $tipoProcedimientos->idTipoProcedimiento }}"
                            data-name="{{$tipoProcedimientos->tipo}}"
                            class="fas fa-trash-alt">
                        </i>
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
    {{-- <div class="pagination">
        {{ $tipoProcedimiento->links('pagination.custom') }}
    </div> --}}

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm" action="{{ route('destroyTipoP', ['id' => 'REPLACE_ID']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="confirmDelete" type="submit" class="btn-link modal-button">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
@endsection
