@extends('layouts.app')


@section('content')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/reportes/index.css') }}">
@endsection

<div class="container">

    <div class="menu-container">
        <div class="menu-item active" onclick="cambiarContenido('elemento')" >Elementos</div>
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
                <div class="titulo">
                    <h1>Informes para Elementos</h1>
                    <hr>
                </div>


                <form class="alo" method="get" action="{{ url('/excel/elementos') }}" id="exportFormE" onsubmit="return preSubmitAction()" >
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




                </div>


                <div class="table">
                    <table>
                        <thead>
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Referencia</th>
                            <th>Serial</th>
                            <th>Procesador</th>
                            <th>Ram</th>
                            <th>Disco duro</th>
                            <th>Tarjeta gráfica</th>
                            <th>Modelo</th>
                            <th>Garantia</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th>Procedimiento</th>
                            <th>Categoria</th>
                            <th>N° Factura</th>
                            <th>Proveedor</th>
                            <th>Asignado A:</th>
                        </thead>
                        <tbody>
                            @foreach ($elementos as $elemento)
                                <tr>
                                    <td>{{$elemento->idElemento ? $elemento->idElemento : 'No aplica'}}</td>
                                    <td>{{ $elemento->marca ? $elemento->marca : 'No aplica' }}</td>
                                    <td>{{ $elemento->referencia ? $elemento->referencia : 'No aplica' }}</td>
                                    <td>{{ $elemento->serial ? $elemento->serial : 'No aplica' }}</td>
                                    <td>{{ $elemento->procesador ? $elemento->procesador : 'No aplica'}}</td>
                                    <td>{{ $elemento->ram ? $elemento->ram : 'No aplica'}}</td>
                                    <td>{{ $elemento->disco_duro ? $elemento->disco_duro : 'No aplica'}}</td>
                                    <td>{{ $elemento->tarjeta_grafica ? $elemento->tarjeta_grafica : 'No aplica'}}</td>
                                    <td>{{ $elemento->modelo ? $elemento->modelo : 'No aplica' }}</td>
                                    <td>{{ $elemento->garantia ? $elemento->garantia : 'No aplica' }}</td>
                                    <td>{{ $elemento->descripcion ? $elemento->descripcion : 'No aplica' }}</td>
                                    <td>{{ $elemento->estado->estado ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->tipoElemento->tipo ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->procedimiento->tipoProcedimiento->tipo ?? 'No aplica'}}</td>
                                    <td>{{ $elemento->categoria->nombre ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->factura->codigoFactura ?? 'No aplica' }}</td>
                                    <td>{{ $elemento->factura->proveedor->nombre ?? 'No aplica'}}</td>
                                    <td>{{ $elemento->user->persona->nombre1 ?? 'No aplica' }} {{ $elemento->user->persona->apellido1}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </div>



                    @if(auth()->user()->hasRole(['superAdmin','admin','tecnico']))
                    <div class="Options-Exports-Elementos">
                        <a class="export-button" onclick="OptionsDocumentsElementos()">Exportar Como</a>

                        <div class="document-options" id="documentOptionsElements">
                            <button type="submit" class="button-with-icon" onclick="cambioDeRutasElemento('excel')">
                                <i class="fa-solid fa-file-excel fa-lg" style="color: #178a13; font-size: 25px;"></i>
                            </button>

                            {{-- <button type="submit" class="button-with-icon" onclick="cambioDeRutasElemento('pdf')" >
                                <i class="fa-solid fa-file-pdf fa-lg" style="color: #ec3d02; font-size: 25px;"></i>
                            </button> --}}
                        </div>
                    </div>
                    @endif
                    <input type="hidden" name="exportFormat" id="exportFormat">


    {{-- div final de la seccion Elementos --}}

</form>
            </div>

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


                <form class="alo" method="get" action="{{ url('/excel/procedimiento') }}" id="exportFormP" onsubmit="return preSubmitAction()" >
                    @csrf


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


                    <div class="form-group" id="fechaInicioContainer">
                        <label for="fechaInicio">Fecha de Inicio:</label>
                        <input type="date" name="fechaInicio" id="fechaInicio">
                    </div>

                    <div class="form-group" id="fechaFinContainer">
                        <label for="fechaFin">Fecha de Fin:</label>
                        <input type="date" name="fechaFin" id="fechaFin">
                    </div>


                </div>


                <div class="table">


                    <table>
                        <thead>
                            <tr>
                                <th>FECHA DE PRESTAMO</th>
                                <th>DISPOSITIV</th>
                                <th>CANTIDAD</th>
                                <th>CARACTERISTICAS</th>
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

                @foreach ($procedimientos as $procedimiento)
                @if ($procedimiento->idTipoProcedimiento == 3)
                    <tr>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica'}}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->elemento->categoria->nombre }}
                        </td>
                        <td style="border: 1px solid black;">
                            1
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->elemento->idElemento }}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->elemento->estado->estado}}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'No aplica' }}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'No aplica' }}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->fechaFin ? $procedimiento->fechaFin : 'No aplica' }}
                        </td>

                        <td style="border: 1px solid black;">
                            {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'No aplica' }}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'No aplica' }}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->observacion }}
                        </td>

                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>



    @if(auth()->user()->hasRole(['superAdmin','admin','tecnico']))

    <div class="Options-Exports-Procedimientos">
        <a class="export-button" onclick="OptionsDocumentsProcedimientos()">Exportar Como</a>

        <div class="document-options" id="documentOptionsProcedimientos">
            <button type="submit" class="button-proce" onclick="cambioDeRutasProcedimiento('excel')">
                <i class="fa-solid fa-file-excel fa-lg" style="color: #178a13; font-size: 25px;"></i>
            </button>

            {{-- <button type="submit" class="button-proce" onclick="cambioDeRutasProcedimiento('pdf')" >
                <i class="fa-solid fa-file-pdf fa-lg" style="color: #ec3d02; font-size: 25px;"></i>
            </button> --}}
        </div>
    </div>
    @endif




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
