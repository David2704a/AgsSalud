@extends('layouts.app')

@section('title', 'Sistema de Reportes')

@section('content')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/reportes/index.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


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
                        <label for="idTipoProcedimiento">Seleccionar Procedimiento:</label>
                        <select name="idTipoProcedimiento" id="idTipoProcedimiento" onchange="aplicarFiltrosElementos()">
                            <option value="">Todos los Procedimientos</option>
                            @foreach ($tipoProcedimientos as $tipoProcedimiento)
                            <option value="{{$tipoProcedimiento->idTipoProcedimiento}}">{{$tipoProcedimiento->tipo}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idEstadoEquipo">Seleccionar Estado de Equipo:</label>
                        <select name="idEstadoEquipo" id="idEstadoEquipo" class="form-control" onchange="aplicarFiltrosElementos()">
                            <option value="">Todos los Estados</option>
                            @foreach ($estadosElementos as $estadoEquipo)
                                <option value="{{ $estadoEquipo->idEstadoE }}">{{ $estadoEquipo->estado }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idTipoElemento">Seleccionar Tipo de Elemento:</label>
                        <select name="idTipoElemento" id="idTipoElemento" class="form-control" onchange="aplicarFiltrosElementos()">
                            <option value="">Todos los Tipos</option>
                            @foreach ($tipoElementos as $tipoElemento)
                                <option value="{{ $tipoElemento->idTipoElemento }}">{{ $tipoElemento->tipo }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-row">


                    <div class="form-group">
                        <label for="idCategoria">Seleccionar una Categoria:</label>
                        <select name="idCategoria" id="idCategoria" class="form-control" onchange="aplicarFiltrosElementos()">
                            <option value="">Todos las Categorias</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idElemento">ID Elemento</label>
                        <input type="number" name="idElemento" id="idElemento" onchange="aplicarFiltrosElementos()">
                    </div>




                </div>


                <div class="tableElementos">
                    <br>
                    <table id="tablaReportElementos">
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
                                <tr
                             >
                                    <td>{{$elemento->idElemento ? $elemento->idElemento : 'NO APLICA'}}</td>
                                    <td>{{ $elemento->marca ? $elemento->marca : 'NO APLICA' }}</td>
                                    <td>{{ $elemento->referencia ? $elemento->referencia : 'NO APLICA' }}</td>
                                    <td>{{ $elemento->serial ? $elemento->serial : 'NO APLICA' }}</td>
                                    <td>{{ $elemento->procesador ? $elemento->procesador : 'NO APLICA'}}</td>
                                    <td>{{ $elemento->ram ? $elemento->ram : 'NO APLICA'}}</td>
                                    <td>{{ $elemento->disco_duro ? $elemento->disco_duro : 'NO APLICA'}}</td>
                                    <td>{{ $elemento->tarjeta_grafica ? $elemento->tarjeta_grafica : 'NO APLICA'}}</td>
                                    <td>{{ $elemento->modelo ? $elemento->modelo : 'NO APLICA' }}</td>
                                    <td>{{ $elemento->garantia ? $elemento->garantia : 'NO APLICA' }}</td>
                                    <td>{{ $elemento->descripcion ? $elemento->descripcion : 'NO APLICA' }}</td>
                                    <td>{{ $elemento->estado->estado ?? 'NO APLICA' }}</td>
                                    <td>{{ $elemento->tipoElemento->tipo ?? 'NO APLICA' }}</td>
                                    <td>{{ $elemento->procedimiento->tipoProcedimiento->tipo ?? 'NO APLICA'}}</td>
                                    <td>{{ $elemento->categoria->nombre ?? 'NO APLICA' }}</td>
                                    <td>{{ $elemento->factura->codigoFactura ?? 'NO APLICA' }}</td>
                                    <td>{{ $elemento->factura->proveedor->nombre ?? 'NO APLICA'}}</td>
                                    <td>{{ $elemento->user->persona->nombre1 ?? 'NO APLICA' }} {{ $elemento->user->persona->apellido1 ?? 'NO APLICA'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </div>

                    <div class="pagination">
                        {{$elementos->links('pagination.custom') }}
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
                        <label for="idResponsableEntrega">Responsable de Entrega:</label>
                        <select name="idResponsableEntrega" id="idResponsableEntrega" class="form-control" onchange="aplicarFiltrosPrestamo()">
                            <option value="">Todos las Personas</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idResponsableRecibe">Responsable que Recibe:</label>
                        <select name="idResponsableRecibe" id="idResponsableRecibe" class="form-control" onchange="aplicarFiltrosPrestamo()">
                            <option value="">Todos las Personas</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idProcedimiento">ID Procedimiento</label>
                        <input type="number" name="idProcedimiento" id="idProcedimiento" onchange="aplicarFiltrosPrestamo()">
                    </div>




                </div>

                <div class="form-row">

                    <div class="form-group" id="fechaInicioContainer">
                        <label for="fechaInicio">Fecha de Inicio:</label>
                        <input type="date" name="fechaInicio" id="fechaInicio" onchange="aplicarFiltrosPrestamo()">
                    </div>

                    <div class="form-group" id="fechaFinContainer">
                        <label for="fechaFin">Fecha de Fin:</label>
                        <input type="date" name="fechaFin" id="fechaFin" onchange="aplicarFiltrosPrestamo()">
                    </div>

                </div>


                <div class="tablePrestamos">

                    <table id="tablaReportesPrestamos">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>FECHA DE PRESTAMO</th>
                                <th>DISPOSITIVO</th>
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
                <tr
                data-idprocedimiento="{{ $procedimiento->idProcedimiento }}"
                data-fechainicio="{{ $procedimiento->fechaInicio ?: '' }}"
                data-idresponsableentrega="{{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->id : '' }}"
                data-idresponsablerecibe="{{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->id : '' }}"
            >
                        <td>
                            {{ $procedimiento->idProcedimiento}}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'NO APLICA'}}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->elemento->categoria->nombre }}
                        </td>
                        <td style="border: 1px solid black;">
                            1
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->elemento->modelo }}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->elemento->estado->estado}}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'NO APLICA' }}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'NO APLICA' }}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->fechaFin ? $procedimiento->fechaFin : 'NO APLICA' }}
                        </td>

                        <td style="border: 1px solid black;">
                            {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'NO APLICA' }}
                        </td>
                        <td style="border: 1px solid black;">
                            {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'NO APLICA' }}
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

    <div class="pagination">
        {{$procedimientos->links('pagination.custom') }}
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




</div>


<footer class="footer">
    <div class="left-images">
        <div class="column">
            <img src="{{asset('imgs/logos/logo-sena.png')}}" width="45" alt="Imagen 1">
            <img src="{{asset('imgs/logos/ESCUDO COLOMBIA.png')}}" width="45" alt="Imagen 2">
        </div>
        <div class="column">
            <img src="{{asset('imgs/logos/logo_fondo.png')}}" width="130" alt="Imagen 3">
            <img src="{{asset('imgs/logos/Logo_Enterritorio.png')}}" width="100" alt="Imagen 4">
        </div>
    </div>
    <div class="right-content">
        <div class="images">
            <img src="{{asset('imgs/logos/LOGO ISO.png')}}" width="50" alt="Imagen 5">
            <img src="{{asset('imgs/logos/Logo-IQNet.png')}}" width="75" alt="Imagen 6">
        </div>
        <div class="separator"></div>
        <div class="text">
            <p>Copyright © 2023 AGS SALUD SAS</p>
            <p>Todos los derechos Reservados</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/reportes/reportes.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


@endsection