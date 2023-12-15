@extends('layouts.app')


@section('content')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/reportes/index.css') }}">
@endsection

<div class="container">

    <div class="menu-container">
        <div class="menu-item " onclick="cambiarContenido('elemento')" >Elementos</div>
        <div class="menu-item active" onclick="cambiarContenido('procedimiento')">Procedimientos</div>
        {{-- Agrega más opciones según tus necesidades --}}
    </div>


    <div class="main-container">





            {{--
                ============================================================
                 Contenido específico para el módulo "Elementos"
                ============================================================
            --}}
            <div class="containers hidden" id="elementos">
                <div class="titulo">
                    <h1>Informes de Elementos</h1>
                    <hr>
                </div>


                <form method="get" action="{{ url('/excel/elementos') }}" id="exportFormE" onsubmit="return preSubmitAction()" >
                    @csrf


                <div class="form-row">
                    <div class="form-group">
                        <label for="tipoProcedimiento">Seleccionar Procedimiento:</label>
                        <select name="idTipoProcedimiento" id="tipoProcedimiento">
                            <option value="">Todos los Procedimientos</option>
                            @foreach ($tipoProcedimientos as $tipoProcedimiento)
                            <option value="{{$tipoProcedimiento->idTipoProcedimiento}}">{{$tipoProcedimiento->tipo}}</option>
                            @endforeach

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


                    <div class="form-group">
                        <label for="categoria">Seleccionar una Categoria:</label>
                        <select name="idCategoria" id="categoria" class="form-control">
                            <option value="">Todos las Categorias</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
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
                            <th>Procedimiento</th>
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
                                    <td>{{ $elemento->procedimiento->tipoProcedimiento->tipo ?? 'No aplica'}}</td>
                                    <td>{{ $elemento->categoria->nombre ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->factura->codigoFactura ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->user->name ?? 'No aplica' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </div>



                    <div class="Options-Exports-Elementos">
                        <a class="export-button" onclick="OptionsDocumentsElementos()">Exportar Como</a>

                        <div class="document-options" id="documentOptionsElements">
                            <button type="submit" class="button-with-icon" onclick="cambioDeRutasElemento('excel')">
                                <i class="fa-solid fa-file-excel fa-lg" style="color: #178a13; font-size: 25px;"></i>
                            </button>

                            <button type="submit" class="button-with-icon" onclick="cambioDeRutasElemento('pdf')" >
                                <i class="fa-solid fa-file-pdf fa-lg" style="color: #ec3d02; font-size: 25px;"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="exportFormat" id="exportFormat">


    {{-- div final de la seccion Elementos --}}

</form>
            </div>

            {{--
                ============================================================
                 Contenido específico para el módulo "Procedimientos"
                ============================================================
            --}}

            <div class="containers" id="procedimientos">
                <div class="titulo">
                    <h1>Informes de Procedimientos</h1>
                    <hr>
                </div>


                <form method="get" action="{{ url('/excel/procedimiento') }}" id="exportFormP" onsubmit="return preSubmitAction()" >
                    @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="tipoProcedimiento">Seleccionar Procedimiento:</label>
                        <select name="idTipoProcedimiento" id="tipoProcedimiento">
                            <option value="">Todos los Procedimientos</option>
                            @foreach ($tipoProcedimientos as $tipoProcedimiento)
                            <option value="{{$tipoProcedimiento->idTipoProcedimiento}}">{{$tipoProcedimiento->tipo}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estadoEquipo">Seleccionar Estado de Procedimiento:</label>
                        <select name="idEstadoProcedimiento" id="estadoEquipo" class="form-control">
                            <option value="">Todos los Estados</option>
                            @foreach ($estadoProcedimientos as $estadosProcedimiento)
                                <option value="{{ $estadosProcedimiento->idEstadoP }}">{{ $estadosProcedimiento->estado }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idElemento">Seleccionar Elemento:</label>
                        <select name="idElemento" id="idElemento" class="form-control">
                            <option value="">Todos los Elementos</option>
                            @foreach ($elementos as $elemento)
                                <option value="{{ $elemento->idElemento }}">{{ $elemento->modelo }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-row">


                    <div class="form-group">
                        <label for="categoria">Seleccionar Persona:</label>
                        <select name="idCategoria" id="categoria" class="form-control">
                            <option value="">Todos las Personas</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
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


                <div class="table">


                    <table>
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
                            </tr>
                        </thead>
                        <tbody>

                @foreach ($procedimientos as $procedimiento)
                    <tr>
                        <td>
                            {{ $procedimiento->idProcedimiento }}
                        </td>
                        <td>
                            {{ $procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica' }}
                        </td>
                        <td>
                            {{ $procedimiento->fechaFin ? $procedimiento->fechaFin : 'No aplica' }}
                        </td>
                        <td>
                            {{ $procedimiento->hora ? $procedimientos->hora : 'No aplica' }}
                        </td>
                        <td>
                            {{ $procedimiento->fechaReprogramada ? $procedimientos->fechaReprogramada : 'No aplica' }}
                        </td>
                        <td>
                            {{ $procedimiento->observacion }}
                        </td>
                        <td>
                            {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'No aplica' }}
                        </td>
                        <td>
                            {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'No aplica' }}
                        </td>
                        <td>
                            {{ $procedimiento->elemento->modelo }}
                        </td>
                        <td>
                            {{ $procedimiento->estadoProcedimiento->estado }}
                        </td>
                        <td>
                            {{ $procedimiento->tipoProcedimiento->tipo }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>




    <div class="Options-Exports-Procedimientos">
        <a class="export-button" onclick="OptionsDocumentsProcedimientos()">Exportar Como</a>

        <div class="document-options" id="documentOptionsProcedimientos">
            <button type="submit" class="button-proce" onclick="cambioDeRutasProcedimiento('excel')">
                <i class="fa-solid fa-file-excel fa-lg" style="color: #178a13; font-size: 25px;"></i>
            </button>

            <button type="submit" class="button-proce" onclick="cambioDeRutasProcedimiento('pdf')" >
                <i class="fa-solid fa-file-pdf fa-lg" style="color: #ec3d02; font-size: 25px;"></i>
            </button>
        </div>
    </div>




                </form>

</div>




    </div>
<script>
    // Mostrar u ocultar campos según el tipo de informe seleccionado
    function cambiarContenido(tipoModulo) {
        var elementos = document.getElementById('elementos');
        var procedimientos = document.getElementById('procedimientos');
        var menuItems = document.querySelectorAll('.menu-item');



        // Ocultar todos los contenidos
        elementos.classList.add('hidden');
        procedimientos.classList.add('hidden');


        // Mostrar el contenido según el tipo de informe seleccionado
        if (tipoModulo === 'elemento') {
            elementos.classList.remove('hidden');
        } else if (tipoModulo === 'procedimiento') {
            procedimientos.classList.remove('hidden');
        }



        menuItems.forEach(function (item) {
            item.classList.remove('active');
        });

        event.currentTarget.classList.add('active');
    }


    function OptionsDocumentsElementos() {
        var documentOptions = document.getElementById('documentOptionsElements');
        documentOptions.style.display = (documentOptions.style.display === 'flex') ? 'none' : 'flex';
    }
    function OptionsDocumentsProcedimientos() {
        var documentOptions = document.getElementById('documentOptionsProcedimientos');
        documentOptions.style.display = (documentOptions.style.display === 'flex') ? 'none' : 'flex';

        console.log('aloooooo');
    }


//     function tipoDocumentos($tipoDocumento, event) {
//     var pdf = document.getElementById('pdf');
//     var excel = document.getElementById('excel');

//     pdf.classList.add('hidden');
//     excel.classList.add('hidden');

//     if ($tipoDocumento === 'pdf') {
//         pdf.classList.remove('hidden');
//     } else if ($tipoDocumento === 'excel') {
//         excel.classList.remove('hidden');
//     }
// }

function preSubmitAction() {
        // Realiza el filtrado u otras acciones aquí
        console.log('Realizando acción antes del envío del formulario');
        return true; // Permitir el envío del formulario
    }

    function cambioDeRutasElemento(format) {
        // Cambia la acción del formulario según el formato seleccionado
        var form = document.getElementById('exportFormE');
        if (format === 'excel') {
            form.action = "{{ url('/excel/elemento') }}"; // Cambia la ruta según sea necesario
        } else if (format === 'pdf') {
            form.target = '_blank';
            form.action = "{{ url('/pdf/elemento') }}"; // Cambia la ruta según sea necesario
        }




        // Completa el formulario y lo envía
        form.submit();
    }

    function cambioDeRutasProcedimiento(format) {
        // Cambia la acción del formulario según el formato seleccionado
        var form = document.getElementById('exportFormP');
        if (format === 'excel') {
            form.action = "{{ url('/excel/procedimiento') }}"; // Cambia la ruta según sea necesario
        } else if (format === 'pdf') {
            form.target = '_blank';
            form.action = "{{ url('/pdf/procedimiento') }}"; // Cambia la ruta según sea necesario
        }




        // Completa el formulario y lo envía
        form.submit();
    }


</script>

@endsection
