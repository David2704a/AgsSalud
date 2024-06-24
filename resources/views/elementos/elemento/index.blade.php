@extends('layouts.app')

@section('title', 'Elemento')

@section('links')

    <link rel="stylesheet" href="{{ asset('/css/elemento/elemento.css') }}">
    <script src="{{ asset('js/elemento/elemento.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

@endsection
@section('content')

    <div class="content2">
        <div class="content" style="text-align: center">
            <h1 class="page-title">Elementos</h1>
            <div class="green-line"></div>
        </div>


        <div class="button-container">
            <a href="{{ url('/dashboard') }}" class="button-izquierda arrow-left"><i
                    class="fa-solid fa-circle-arrow-left"></i>
                Regresar</a>
            @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
                <a href="{{ route('elementos.create') }}" class="button-derecha"><i class="fas fa-file"></i> Nuevo
                    Elemento</a>
            @endif

            @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                <p><a href="{{ url('/lista-qr') }}"
                        class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                        target="_blank">QR'S</a></p>
            @endif

            {{-- <a href="{{route('generar.pdf')}}" class="button-izquierda arrow-left">
            ActaEntrega PDF</a> --}}


        </div>
        <div class="menu-container">
            <ul class="menu">
                @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
                    <li>
                        <a href="{{ route('proveedores.index') }}">Proveedores</a>
                    </li>
                @endif
                @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
                    <li>
                        <a href="{{ route('facturas.index') }}">Facturas</a>
                    </li>
                @endif
                @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
                    <li>
                        <a href="{{ route('tipoElementos.index') }}">Tipo elemento</a>
                    </li>
                @endif
            </ul>
        </div>



        {{-- <a href="{{ url('excel?idEstadoEquipo=1') }}" class="btn btn-success btn-lg" target="_blank" title="Ver Excel"><i
        class="fa-solid fa-file-excel fa-lg" style="color: #178a13;"></i></a> --}}



        @if (session('success'))
            <div id="success-alert" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <div class="search-container">
                <input type="text" id="search-input" placeholder="Buscar...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            {{--
                 ===================================
                  TABLA PARA UN SOLO ROL
                 ===================================
                --}}


            <div class="table">
                <table id="tableElementos">
                    <thead>
                        <th>ID</th>
                        <th>Id_dispo</th>
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
                        <th>Estado Procedimiento</th>
                        <th>Categoria</th>
                        <th>N° Factura</th>
                        <th>Asignado A:</th>
                        @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                            <th>Acciones</th>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($elementos as $elemento)
                            {{-- @dd($elemento) --}}
                            {{-- @dd($elemento->user->name) --}}

                            {{-- @dd($elementos) --}}
                            @if ($elemento->id_disp0 == "900237674'7'E.T. EN. U'12")
                                @dd($elemento)
                            @endif
                            <tr>
                                <td>{{ $elemento->idElemento ? $elemento->idElemento : 'NO APLICA' }}</td>
                                <td>{{ $elemento->id_dispo ? $elemento->id_dispo : 'NO APLICA' }}</td>
                                <td>{{ $elemento->marca ? $elemento->marca : 'NO APLICA' }}</td>
                                <td>{{ $elemento->referencia ? $elemento->referencia : 'NO APLICA' }}</td>
                                <td>{{ $elemento->serial ? $elemento->serial : 'NO APLICA' }}</td>
                                <td>{{ $elemento->procesador ? $elemento->procesador : 'NO APLICA' }}</td>
                                <td>{{ $elemento->ram ? $elemento->ram : 'NO APLICA' }}</td>
                                <td>{{ $elemento->disco_duro ? $elemento->disco_duro : 'NO APLICA' }}</td>
                                <td>{{ $elemento->tarjeta_grafica ? $elemento->tarjeta_grafica : 'NO APLICA' }}</td>
                                <td>{{ $elemento->modelo ? $elemento->modelo : 'NO APLICA' }}</td>
                                <td>{{ $elemento->garantia ? $elemento->garantia : 'NO APLICA' }}</td>
                                <td>{{ $elemento->descripcion ? $elemento->descripcion : 'NO APLICA' }}</td>
                                <td>{{ $elemento->estado->estado ?? 'NO APLICA' }}</td>
                                <td>{{ $elemento->tipoElemento->tipo ?? 'NO APLICA' }}</td>
                                <td>{{ $elemento->procedimiento->estadoProcedimiento->estado ?? 'NO APLICA' }}</td>
                                <td>{{ $elemento->categoria->nombre ?? 'NO APLICA' }}</td>
                                <td>{{ $elemento->factura->codigoFactura ?? 'NO APLICA' }}</td>
                                <td>{{ $elemento->user->name ?? 'NO REGISTRADO' }}</td>

                                @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                                    <td>
                                        @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                                            <a class="edit-button tooltips" title="Editar"
                                                href="{{ route('elementos.edit', $elemento->idElemento) }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                                <span class="tooltiptext">Editar Elemento</span>

                                            </a>
                                        @endif

                                        @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                                            <a class="pdf-button" title="Mostrar"
                                                href="{{ route('elementos.pdf', $elemento->idElemento) }}">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                        @endif

                                        @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                                            <a class="edit-button" style="background-color: rgb(37, 162, 194)" title="ActaEntrega"
                                                href="{{route('generar.pdf', $elemento->idElemento)}}" target="_blank">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                        @endif
                                        @if (auth()->user()->hasRole('superAdmin'))
                                            <button type="button" class="delete-button tooltips" title="Eliminar"
                                                data-bs-toggle="modal" data-bs-target="#myModal"
                                                data-id="{{ $elemento->idElemento }}" data-name="{{ $elemento->modelo }}">

                                                <i data-id="{{ $elemento->idElemento }}"
                                                    data-name="{{ $elemento->modelo }}" class="fas fa-trash-alt"></i>
                                                <span class="tooltiptext">Eliminar Elemento</span>

                                            </button>
                                        @endif



                                        @if (
                                            $elemento->idUsuario !== null &&
                                                in_array($elemento->categoria->nombre, [
                                                    'PC PORTATIL',
                                                    'CARGADOR PORTATIL',
                                                    'EQUIPO TODO EN UNO',
                                                    'TECLADO',
                                                    'MOUSE',
                                                    'PAD MOUSE',
                                                ]))
                                            <a href="{{ url('/ingreso_salida/' . $elemento->idElemento) }}" type="button"
                                                data-id-user="{{ $elemento->idUsuario }}"
                                                data-user-identificacion="{{ $elemento->user->persona->identificacion ?? false }}"
                                                data-name-user="{{ $elemento->user->name ?? false }}"
                                                class="btn_ingreso_salida tooltips btn btn-info btn-sm">
                                                 <i class="fa-solid fa-arrow-up-right-from-square" style="color: #fff;"></i>
                                                 <span class="tooltiptext">Ingreso / Salida</span>
                                             </a>
                                        @endif

                                        <a href="{{ url('/exportarpdf/' . $elemento->idElemento) }}" type="button">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
        <div class="pagination">
            {{ $elementos->links('pagination.custom') }}
        </div>
    </div>

    {{-- @include('components.modal-form-salida-i-n') --}}


    {{--
        ================================================
        MODAL PARA ELEGIR SI ELIMINAR O NO
        ================================================

    --}}

    <div class="modal fade" id="myModal" ia-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="modalTitleId">
                        ¿Deseas Eliminar el Registro?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                    <div class="button-container" style="display: flex; justify-content: center; margin: 1rem -3rem;">
                        <button id="cancelButton" class="modal-button" style="">Cancelar</button>
                        <form id="deleteForm" action="{{ route('elementos.destroy', 'REPLACE_ID') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="confirmDelete" type="submit" class="modal-button"
                                style="padding: 5px 10px; background-color: #DC3545; color: #fff; border: none; border-radius: 4px;">Eliminar</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        $('#tableElementos').on('click', '.btn_ingreso_salida', function() {
            var idUserAutorizado = $(this).data('id-user');
            var nameUserAutorizado = $(this).data('name-user');
            var identiUserAutorizado = $(this).data('user-identificacion');


            $('#hola1').val(idUserAutorizado)
            $('#nameUserAutorizado').val(nameUserAutorizado)
            $('#identiUserAutorizado').val(identiUserAutorizado)
        })
    </script>
@endsection
