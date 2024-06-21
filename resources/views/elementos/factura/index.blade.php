@extends('layouts.app')

@section('title', 'Factura')

@section('links')

    <link rel="stylesheet" href="{{ asset('/css/factura/factura.css') }}">
    <script src="{{ asset('js/factura/factura.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
@section('content')
    <div class="content2">
        <h1 class="page-title">Facturas</h1>
        <div class="green-line"></div>

        <div class="button-container">
            <a href="{{ url('/elementos') }}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i>
                Regresar</a>

            @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
                <a href="{{ route('facturas.create') }}" class="button-derecha"><i class="fas fa-file"></i> Nueva Factura</a>
            @endif
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
                        <a href="{{ route('elementos.index') }}">Elementos</a>
                    </li>
                @endif
            </ul>
        </div>

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
            <div class="table">
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Codigo</th>
                        <th>fecha Compra</th>
                        <th>Proveedor</th>
                        <th>Metodo Pago</th>
                        <th>Valor</th>
                        <th>Descripción</th>
                        @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                            <th>Acciones</th>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($facturas as $factura)
                            <tr>
                                <td>{{ $factura->idFactura }}</td>
                                <td>{{ $factura->codigoFactura }}</td>
                                <td>{{ $factura->fechaCompra }}</td>
                                <td>{{ $factura->proveedor->nombre }}</td>
                                <td>{{ $factura->metodoPago }}</td>
                                <td>{{ $factura->valor }}</td>
                                <td>{{ $factura->descripcion }}</td>
                                @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                                    <td>
                                        <a class="show-button" title="Ver"
                                            onclick="mostrarArchivo('{{ $factura->rutaFactura }}')">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        @if (auth()->user()->hasRole(['superAdmin', 'admin']))
                                            <a class="edit-button" title="Editar"
                                                href="{{ route('facturas.edit', $factura->idFactura) }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        @endif

                                        @if (auth()->user()->hasRole(['superAdmin']))
                                            <button title="Eliminar" type="button" class="delete-button"
                                                data-id="{{ $factura->idFactura }}"
                                                data-tipo="{{ $factura->codigoFactura }}">
                                                <i class="fas fa-trash-alt"></i>
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
            {{ $facturas->links('pagination.custom') }}
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modalEliminar">
        <div class="modal_content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm" action="{{ route('facturas.destroy', 'REPLACE_ID') }}" method="POST">
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

@endsection
