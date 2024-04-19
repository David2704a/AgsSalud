@extends('layouts.app')

@section('title', 'Estado de Procedimiento')

@section('links')

    <link rel="stylesheet" href="{{ asset('css/estadoProcedimiento/estadoProcedimiento.css') }}">
    <script src="{{ asset('js/estadoProcedimiento/estadoProcedimiento.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@endsection
@section('content')
<div class="content2">
    <div class="content">
        <h1 class="page-title">ESTADO DE PROCEDIMIENTOS</h1>
        <div class="green-line"></div>
    </div>
        <div class="button-container">
            <a href="{{ route('mostrarProcedimiento') }}" class="button-izquierda arrow-left"><i
                    class="fa-solid fa-circle-arrow-left"></i>
                Regresar</a>

                @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
            <a href="{{ route('createEstadoP') }}" class="button-derecha"><i class="fas fa-file"></i> Nuevo Estado de
                Procedimiento</a>
                @endif

        </div>


        <div class="menu-container">
            <ul class="menu">
                @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
                <li>
                    <a href="{{ route('mostrarProcedimiento') }}">Procedimiento</a>

                </li>
                @endif
                @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
                <li>
                    <a href="{{ route('mostrarTipoP') }}">Tipo de Procedimiento</a>
                </li>
                @endif
            </ul>
        </div>

        @if (session('success'))
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
                            ID
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            Descripcion
                        </th>
                        @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
                            <th>
                                Acciones
                            </th>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($estadoProcedimiento as $estadoProcedimientos)
                            <tr>
                                <td>
                                    {{ $estadoProcedimientos->idEstadoP }}
                                </td>
                                <td>
                                    {{ $estadoProcedimientos->estado }}
                                </td>
                                <td>
                                    {{ $estadoProcedimientos->descripcion }}
                                </td>
                                @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
                                <td>
                                    @if(auth()->user()->hasRole(['superAdmin','admin','tecnico']))
                                    <a class="edit-button"
                                        href="{{ route('editEstadoP', ['id' => $estadoProcedimientos->idEstadoP]) }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    @endif
                                    @if(auth()->user()->hasRole(['superAdmin','admin','tecnico']))
                                    <button type="button" class="delete-button"
                                        data-id="{{ $estadoProcedimientos->idEstadoP }}"
                                        data-name="{{ $estadoProcedimientos->estado }}">
                                        <i data-id="{{ $estadoProcedimientos->idEstadoP }}"
                                            data-name="{{ $estadoProcedimientos->estado }}" class="fas fa-trash-alt">
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
        <div class="pagination">
            {{ $estadoProcedimiento->links('pagination.custom') }}
        </div>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm" action="{{ route('destroyEstadoP', ['id' => 'REPLACE_ID']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="confirmDelete" type="submit" class="btn-link modal-button">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
