@extends('layouts.app')

@section('title', 'Sistema de Reportes')

@section('content')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/reportes/index.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


@endsection
{{-- @include('components.loader-component') --}}
<div class="content2">

    <div class="validaciones_title">
        <div class="border-top-container"></div>
        <div class="border-left-container"></div>
        <div class="border-sup-container"></div>
        <div class="border-right-container"></div>
        <h3>REPORTES</h3>
    </div>
    <div class="container">
        <div class="menu-container">
            <div class="menu-item active" onclick="cambiarContenido('elemento')">Elementos</div>
            <div class="menu-item " onclick="cambiarContenido('procedimiento')">Prestamos</div>
            {{-- Agrega más opciones según tus necesidades --}}
        </div>
        <div class="main-container">
            {{--
                ============================================================
                 Contenido específico para el módulo "Elementos"
                ============================================================
            --}}
            <div class="containers " id="elementos">
                <div class="title_and_inputs">
                    <div class="titulo">
                        <h1>Informes para Elementos</h1>
                        <hr>
                    </div>
                    <form class="filtrosInputsElementos" method="POST" action="{{ url('/exportarElementos') }}" id="exportFormE"
                        onsubmit="return preSubmitAction()">
                        @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="idEstadoEquipo">Seleccionar Estado de Equipo:</label>
                                    <select name="idEstadoEquipo" id="idEstadoEquipo" class="form-control">
                                        <option value="">Todos los Estados</option>
                                        @foreach ($estadosElementos as $estadoEquipo)
                                            <option value="{{ $estadoEquipo->idEstadoE }}">{{ $estadoEquipo->estado }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idTipoElemento">Seleccionar un Usuario:</label>
                                    <select name="idTipoElemento" id="idUsuario" class="form-control">
                                        <option value="">Todos los Tipos</option>
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="idCategoria">Seleccionar una Categoria:</label>
                                    <select name="idCategoria" id="idCategoria" class="form-control">
                                        <option value="">Todos las Categorias</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idElemento">Elemento</label>
                                    <select class="selectElemento select2" name="idElemento" id="idElemento"
                                        style="width: 100%">
                                        <option value="">Seleccionar una opción</option>
                                        @foreach ($elementos2 as $elemento)
                                            <option value="{{ $elemento->id_dispo }}">{{ $elemento->id_dispo }} -
                                                {{ $elemento->categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="tabla-container">
                    <div class="tableElementos">
                        <br>
                        <table id="tablaReportElementos">
                            <thead>
                                <th>ID</th>
                                <th>Referencia</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Categoria</th>
                                <th>N° Factura</th>
                                <th>Proveedor</th>
                                <th>Asignado A:</th>
                            </thead>
                            <tbody class="tbodyElementos">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pagination">
                </div>
                @if (auth()->user()->hasRole(['superAdmin', 'admin', 'tecnico']))
                    <div class="Options-Exports-Elementos">
                        <a class="export-button" onclick="OptionsDocumentsElementos()">Exportar Como</a>
                        <div class="document-options" id="documentOptionsElements">
                            <button type="button" class="button-with-icon download">
                                <i class="fa-solid fa-file-excel fa-lg" style="color: #178a13; font-size: 25px;"></i>
                            </button>

                        </div>
                    </div>
                @endif
                <input type="hidden" name="exportFormat" id="exportFormat">
            </div>
            {{-- div final de la seccion Elementos --}}

            {{--
                ============================================================
                 Contenido específico para el módulo "Procedimientos"
                ============================================================
            --}}

            <div class="containers hidden" id="procedimientos">
                <div class="titulo">
                    <h1>Informes para Prestamos</h1>
                    <hr>
                </div>
                <form class="alo" method="get" action="{{ url('/excel/procedimiento') }}" id="exportFormP"
                    onsubmit="return preSubmitAction()">
                    @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="idResponsableEntrega">Responsable de Entrega:</label>
                                <select name="idResponsableEntrega" id="idResponsableEntrega"
                                    class="form-control inputsPrestamos" onchange="filtroProcedimientos()">
                                    <option value="">Todos las Personas</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="idResponsableRecibe">Responsable que Recibe:</label>
                                <select name="idResponsableRecibe" id="idResponsableRecibe"
                                    class="form-control inputsPrestamos" onchange="filtroProcedimientos()">
                                    <option value="">Todos las Personas</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="idElemento">Elemento</label>
                                <select class="selectElemento select2 inputsPrestamos" name="idProcedimiento"
                                    id="idProcedimiento " style="width: 100%" onchange="filtroProcedimientos()">
                                    <option value="">Seleccionar una opción</option>
                                    @foreach ($elementos2 as $elemento1)
                                        <option value="{{ $elemento1->id_dispo }}">{{ $elemento1->id_dispo }} -
                                            {{ $elemento1->categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.select2').select2({
                                        theme: null
                                    });
                                });
                            </script>
                        </div>
                        <div class="form-row">
                            <div class="form-group" id="fechaInicioContainer">
                                <label for="fechaInicio">Fecha de Inicio:</label>
                                <input class="inputsPrestamos" type="date" name="fechaInicio" id="fechaInicio"
                                    onchange="filtroProcedimientos()">
                            </div>
                            <div class="form-group" id="fechaFinContainer">
                                <label for="fechaFin">Fecha de Fin:</label>
                                <input class="inputsPrestamos" type="date" name="fechaFin" id="fechaFin"
                                    onchange="filtroProcedimientos()">
                            </div>
                        </div>
                    </form>
                    <div class="tablePrestamos">
                        <table id="tablaReportesPrestamos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>FECHA DE PRESTAMO</th>
                                    <th>DISPOSITIVO</th>
                                    <th>ID DISPOSITIVO</th>
                                    <th>ESTADO</th>
                                    <th>ENTREGA</th>
                                    <th>RECIBE</th>
                                    <th>FECHA DE DEVOLUCIO</th>
                                    <th>ENTREGA</th>
                                    <th>RECIBE</th>
                                    <th>OBSERVACION</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    @if (auth()->user()->hasRole(['superAdmin', 'admin', 'tecnico']))
                        <div class="Options-Exports-Procedimientos">
                            <a class="export-button" onclick="OptionsDocumentsProcedimientos()">Exportar Como</a>
                            <div class="document-options" id="documentOptionsProcedimientos">
                                <button type="button" class="button-proce downloadP">
                                    <i class="fa-solid fa-file-excel fa-lg"
                                        style="color: #178a13; font-size: 25px;"></i>
                                </button>
                                <button type="button" class="button-proce downloadPDF" >
                                    <i class="fa-solid fa-file-excel fa-lg"
                                        style="color: #8a1313; font-size: 25px;"></i>
                                </button>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
    <br><br>
    <br><br>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/reportes/reportes.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


@endsection
