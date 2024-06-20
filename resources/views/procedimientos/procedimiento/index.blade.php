@extends('layouts.app')

@section('title', 'Procedimientos')


@section('links')

    <link rel="stylesheet" href="{{ asset('/css/procedimiento/procedimiento.css') }}">
    <script src="{{ asset('js/prodedimiento/procedimiento.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    



@endsection

@section('content')


<div class="content2">
    <div class="containerTitle">
        <h1 class="page-title">PROCEDIMIENTOS</h1>
        <div class="green-line"></div>
    </div>

        <div class="button-container">
            <a href="{{ url('/dashboard') }}" class="button-izquierda arrow-left"><i
                    class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
            @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
                <a href="{{ route('createProcedimiento') }}" class="button-derecha"><i class="fas fa-file"></i> Nuevo
                    procedimiento</a>
            @endif
        </div>

        <div class="menu-containers">
            <ul class="menu">
                @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
                    <li>
                        <a href="{{ route('mostrarEstadoP') }}">Estado de Procedimiento</a>
                    </li>
                @endif
                @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
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


                {{-- <form id="search-form" action="{{ route('mostrarProcedimiento') }}" method="GET">
                    <input type="text" name="filtro" id="search-input" placeholder="Buscar por nombre" >
                </form> --}}

            </div>

            <div class="table tableProcedimientosIn">


                <table id="tablaProcedimientosIN">
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
                            @if (auth()->user()->hasRole(['superAdmin', 'administador']))
                                <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr class="mensaje-vacio" style="display: none;">
                            <td colspan="12">No se encontraron registros</td>
                        </tr> --}}
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
                                    {{ $procedimientos->elemento->categoria->nombre }}
                                </td>
                                <td>
                                    {{ $procedimientos->estadoProcedimiento->estado }}
                                </td>
                                <td>
                                    {{ $procedimientos->tipoProcedimiento->tipo }}
                                </td>
                                @if (auth()->user()->hasRole(['superAdmin', 'administador']))
                                    <td>
                                        @if (auth()->user()->hasRole(['superAdmin', 'administador']))
                                            <a class="edit-button"
                                                href="{{ route('editProcedimiento', $procedimientos->idProcedimiento) }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        @endif
                                        @if (auth()->user()->hasRole(['superAdmin']))
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
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="mensaje-vacio" style="display: none;">No se encontraron registros</p>
            </div>
        </div>
        {{-- <div class="pagination">
            {{ $procedimiento->links('pagination.custom') }}
        </div> --}}
    </div>





    <!-- Modal -->
    <div id="myModal" class="modalEliminar">
        <div class="modal_content">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
@endsection
