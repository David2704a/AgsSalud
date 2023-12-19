@extends('layouts.app')

@section('title', 'Procedimientos')


@section('links')

    <link rel="stylesheet" href="{{ asset('/css/procedimiento/procedimiento.css') }}">
    <script src="{{ asset('js/prodedimiento/procedimiento.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



@endsection

@section('content')

    <div class="content">
        <h1 class="page-title">PROCEDIMIENTOS</h1>
        <div class="green-line"></div>

        <div class="button-container">
            <a href="/dashboard" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
            <a href="{{ route('createProcedimiento') }}" class="button-derecha"><i class="fas fa-file"></i> Nuevo
                procedimiento</a>

        </div>

        <div class="menu-containers">
            <ul class="menu">
                <li>
                    <a href="{{ route('mostrarEstadoP') }}">Estado de Procedimiento</a>
                </li>
                <li>
                    <a href="{{ route('mostrarTipoP') }}">Tipo de Procedimiento</a>
                </li>
            </ul>
        </div>

        @if (session('success'))
            <div id="alert" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">

            <div class="search-container">


                <form id="search-form" action="{{ route('mostrarProcedimiento') }}" method="GET">
                    <input type="text" name="filtro" id="search-input" placeholder="Buscar por nombre" >
                </form>

            </div>

            <div class="table">


                <table id="procedimientos-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Hora</th>
                            <th>Fecha Reprogramada</th>
                            <th>Observación</th>
                            <th>Responsable de Entrega</th>
                            <th>Responsable que Recibe</th>
                            <th>Elemento</th>
                            <th>Estado del procedimientos</th>
                            <th>Tipo de procedimientos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="mensaje-vacio" style="display: none;">
                            <td colspan="12">No se encontraron registros</td>
                        </tr>
                        @foreach ($procedimiento as $procedimientos)
                            <tr class="estado-{{ str_replace(' ', '-', $procedimientos->estadoProcedimiento->estado) }}">
                                <td>
                                    {{ $procedimientos->idProcedimiento }}
                                </td>
                                <td>
                                    {{ $procedimientos->fechaInicio ? $procedimientos->fechaInicio : 'No aplica' }}
                                </td>
                                <td>
                                    {{ $procedimientos->fechaFin ? $procedimientos->fechaFin : 'No aplica' }}
                                </td>
                                <td>
                                    {{ $procedimientos->hora ? $procedimientos->hora : 'No aplica' }}
                                </td>
                                <td>
                                    {{ $procedimientos->fechaReprogramada ? $procedimientos->fechaReprogramada : 'No aplica' }}
                                </td>
                                <td>
                                    {{ $procedimientos->observacion }}
                                </td>
                                <td>
                                    {{ $procedimientos->responsableEntrega ? $procedimientos->responsableEntrega->name : 'No aplica' }}
                                </td>
                                <td>
                                    {{ $procedimientos->responsableRecibe ? $procedimientos->responsableRecibe->name : 'No aplica' }}
                                </td>
                                <td>
                                    {{ $procedimientos->elemento->modelo }}
                                </td>
                                <td>
                                    {{ $procedimientos->estadoProcedimiento->estado }}
                                </td>
                                <td>
                                    {{ $procedimientos->tipoProcedimiento->tipo }}
                                </td>
                                <td>
                                    <a class="edit-button"
                                        href="{{ route('editProcedimiento', $procedimientos->idProcedimiento) }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>

                                    <button type="button" class="delete-button"
                                        data-id="{{ $procedimientos->idProcedimiento }}"
                                        data-name="{{ $procedimientos->elemento->modelo }}
                                            <span class='record-id-message'>Con el proceso</span>
                                            {{ $procedimientos->tipoProcedimiento->tipo }}">
                                        <i data-id="{{ $procedimientos->idProcedimiento }}"
                                            data-name="{{ $procedimientos->elemento->modelo }}
                                            <span class='record-id-message'>y el proceso</span>
                                            {{ $procedimientos->tipoProcedimiento->tipo }}"
                                            class="fas fa-trash-alt">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="mensaje-vacio" style="display: none;">No se encontraron registros</p>
            </div>
        </div>
        <div class="pagination">
            {{ $procedimiento->links('pagination.custom') }}
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm" action="{{ route('destroyProcedimiento', ['id' => 'REPLACE_ID']) }}" method="POST">
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
