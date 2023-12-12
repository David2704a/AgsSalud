@extends('layouts.app')


@section('content')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/reportes/index.css') }}">
@endsection

<div class="container">

    <div class="menu-container">
        <div class="menu-item active" onclick="cambiarContenido('elemento')" >Elementos</div>
        <div class="menu-item" onclick="cambiarContenido('procedimiento')">Procedimientos</div>
        {{-- Agrega más opciones según tus necesidades --}}
    </div>


    <div class="main-container">



        <form method="get" action="{{ url('/excel') }}" id="exportForm" onsubmit="return preSubmitAction()">
            @csrf


            <div class="containers" id="elementos">

                <div class="titulo">
                    <h1>Informes de Elementos</h1>
                    <hr>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tipoInforme">Tipo de Informe:</label>
                        <select name="tipoInforme" id="tipoInforme">
                            <option value="porEstado">Por Estado</option>
                            <option value="otroFiltro">Otro Filtro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estadoEquipo">Seleccionar Estado de Equipo:</label>
                        <select name="idEstadoEquipo" id="estadoEquipo" class="form-control">
                            <option value="">Todos los Estados</option>
                            @foreach ($estadosElementos as $estadoEquipo)
                                <option value="{{ $estadoEquipo->idEstadoE }}">{{ $estadoEquipo->estado }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idTipoElemento">Seleccionar Tipo de Elemento:</label>
                        <select name="idTipoElemento" id="idTipoElemento" class="form-control">
                            <option value="">Todos los Tipos</option>
                            @foreach ($tipoElementos as $tipoElemento)
                                <option value="{{ $tipoElemento->idTipoElemento }}">{{ $tipoElemento->tipo }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-row">


                    <div class="form-group" id="otroFiltroContainer">
                        <label for="otroFiltro">Otro Filtro:</label>
                        <input type="text" name="otroFiltro" id="otroFiltro">
                    </div>


                    <div class="form-group" id="rangoFechasContainer">
                        <label for="fechaInicio">Fecha de Inicio:</label>
                        <input type="date" name="fechaInicio" id="fechaInicio">
                    </div>

                    <div class="form-group" id="rangoFechasContainer">
                        <label for="fechaFin">Fecha de Fin:</label>
                        <input type="date" name="fechaFin" id="fechaFin">
                    </div>

                </div>


                {{-- <a class="documents" onclick="tipoDocumentos('excel')" >excel</a>
                <a class="documents" onclick="tipoDocumentos('pdf')" >pdf</a> --}}








                <div class="table">
                    <table>
                        <thead>
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Referencia</th>
                            <th>Serial</th>
                            <th>Modelo</th>
                            <th>Garantia</th>
                            <th>Valor</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>N° Factura</th>
                            <th>Asignado A:</th>
                        </thead>
                        <tbody>
                            @foreach ($elementos as $elemento)
                                <tr>
                                    <td>{{$elemento->idElemento ? $elemento->idElemento : 'No aplica'}}</td>
                                    <td>{{ $elemento->marca ? $elemento->marca : 'No aplica' }}</td>
                                    <td>{{ $elemento->referencia ? $elemento->referencia : 'No aplica' }}</td>
                                    <td>{{ $elemento->serial ? $elemento->serial : 'No aplica' }}</td>
                                    <td>{{ $elemento->modelo ? $elemento->modelo : 'No aplica' }}</td>
                                    <td>{{ $elemento->garantia ? $elemento->garantia : 'No aplica' }}</td>
                                    <td>{{ $elemento->valor ? $elemento->valor : 'No aplica' }}</td>
                                    <td>{{ $elemento->descripcion ? $elemento->descripcion : 'No aplica' }}</td>
                                    <td>{{ $elemento->estado->estado ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->tipoElemento->tipo ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->categoria->nombre ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->factura->codigoFactura ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->user->name ?? 'No aplica' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </div>



                    <div class="export-options-container">
                        <a class="export-button" onclick="toggleDocumentOptions()">Exportar Como</a>

                        <div class="document-options" id="documentOptions">
                            <button type="submit" class="button-with-icon" onclick="setExportTypeAndSubmit('excel')">
                                <i class="fa-solid fa-file-excel fa-lg" style="color: #178a13; font-size: 25px;"></i>
                            </button>

                            <button type="submit" class="button-with-icon" onclick="setExportTypeAndSubmit('pdf')">
                                <i class="fa-solid fa-file-pdf fa-lg" style="color: #ec3d02; font-size: 25px;"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="exportFormat" id="exportFormat">



            </div>

            {{-- Contenido específico para el módulo "Elemento" --}}
            <div class="containers hidden" id="procedimientos">
                <div class="titulo">
                    <h1>Informes de Procedimientos</h1>
                    <hr>
                </div>

            </div>

        </form>
        {{-- Puedes agregar más contenedores para otros módulos según tus necesidades --}}








    </div>






</div>
<script>
    // Mostrar u ocultar campos según el tipo de informe seleccionado
    function cambiarContenido(tipoModulo) {
        var elementos = document.getElementById('elementos');
        var procedimientos = document.getElementById('procedimientos');
        var menuItems = document.querySelectorAll('.menu-item');

        // Puedes agregar más contenedores según tus necesidades

        // Ocultar todos los contenidos
        elementos.classList.add('hidden');
        procedimientos.classList.add('hidden');



        // Oculta más contenidos aquí

        // Mostrar el contenido según el tipo de informe seleccionado
        if (tipoModulo === 'elemento') {
            elementos.classList.remove('hidden');
        } else if (tipoModulo === 'procedimiento') {
            procedimientos.classList.remove('hidden');
        }
        // Agrega más condiciones según tus necesidades




        menuItems.forEach(function (item) {
            item.classList.remove('active');
        });

        event.currentTarget.classList.add('active');
    }


    function toggleDocumentOptions() {
        var documentOptions = document.getElementById('documentOptions');
        documentOptions.style.display = (documentOptions.style.display === 'flex') ? 'none' : 'flex';
    }


    function tipoDocumentos($tipoDocumento, event) {
    var pdf = document.getElementById('pdf');
    var excel = document.getElementById('excel');

    pdf.classList.add('hidden');
    excel.classList.add('hidden');

    if ($tipoDocumento === 'pdf') {
        pdf.classList.remove('hidden');
    } else if ($tipoDocumento === 'excel') {
        excel.classList.remove('hidden');
    }
}

function preSubmitAction() {
        // Realiza el filtrado u otras acciones aquí
        console.log('Realizando acción antes del envío del formulario');
        return true; // Permitir el envío del formulario
    }

    function setExportTypeAndSubmit(format) {
        // Cambia la acción del formulario según el formato seleccionado
        var form = document.getElementById('exportForm');
        if (format === 'excel') {
            form.action = "{{ url('/excel') }}"; // Cambia la ruta según sea necesario
        } else if (format === 'pdf') {
            form.action = "{{ url('/pdf') }}"; // Cambia la ruta según sea necesario
        }

        // Completa el formulario y lo envía
        form.submit();
    }

  
</script>

@endsection
