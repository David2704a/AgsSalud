@extends('layouts.app')

@section('title', 'Estado de Procedimiento')

@section('links')

    <link rel="stylesheet" href="{{ asset('css/estadoProcedimiento/estadoProcedimiento.css') }}">
    <script src="{{ asset('js/estadoProcedimiento/estadoProcedimiento.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@endsection
@section('content')

    <div class="content">
        <h1 class="page-title">ESTADO DE PROCEDIMIENTOS</h1>
        <div class="green-line"></div>

        <div class="button-container">
            @role(['superAdmin','administrador'])
            <a href="{{ route('mostrarProcedimiento') }}" class="button-izquierda arrow-left"><i
                    class="fa-solid fa-circle-arrow-left"></i>
                Regresar</a>
                @endrole

                @role(['superAdmin','administrador'])
            <a href="{{ route('createEstadoP') }}" class="button-derecha"><i class="fas fa-file"></i> Nuevo Estado de
                Procedimiento</a>
                @endrole

        </div>


        <div class="menu-container">
            <ul class="menu">
                @role(['superAdmin','administrador'])
                <li>
                    <a href="{{ route('mostrarProcedimiento') }}">Procedimiento</a>

                </li>
                @endrole
                @role(['superAdmin','administrador'])
                <li>
                    <a href="{{ route('mostrarTipoP') }}">Tipo de Procedimiento</a>
                </li>
                @endrole
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
                        <th>
                            Acciones
                        </th>
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
                                <td>
                                    @role(['superAdmin','administrador'])
                                    <a class="edit-button"
                                        href="{{ route('editEstadoP', ['id' => $estadoProcedimientos->idEstadoP]) }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    @endrole
                                    @role(['superAdmin','administrador'])
                                    <button type="button" class="delete-button"
                                        data-id="{{ $estadoProcedimientos->idEstadoP }}"
                                        data-name="{{ $estadoProcedimientos->estado }}">
                                        <i data-id="{{ $estadoProcedimientos->idEstadoP }}"
                                            data-name="{{ $estadoProcedimientos->estado }}" class="fas fa-trash-alt">
                                        </i>
                                    </button>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="pagination">
            {{ $estadoProcedimiento->links('pagination.custom') }}
        </div>
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
