@extends('layouts.app')

@section('title', 'Elemento')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/elemento/elementosfisicos.css') }}">
    {{-- <script src="{{ asset('js/elemento/elemento.js') }}"></script> --}}
<!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Incluir DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


@endsection

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1 class="page-title">Elementos físicos</h1>
        <div class="green-line mx-auto my-3"></div>
    </div>

    <div class="d-flex justify-content-between my-4 button-container" style="width: 50%">
        <a href="{{ url('/dashboard') }}" class="btn btn-primary button-izquierda arrow-left">
            <i class="fa-solid fa-circle-arrow-left"></i> Regresar
        </a>
        <a href="{{ route('elementos-fisicos.create') }}" class="btn btn-success button-derecha">
            <i class="fas fa-file"></i> Nuevo Elemento
        </a>
    </div>

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card table-container">
        <div class="card-body">
            {{-- <div class="search-container mb-3">
                <div class="input-group">
                    <input type="text" id="busquedaddd" class="form-control" placeholder="Buscar...">
                    <div class="input-group-append">
                        <button class="btn btn-secondary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </div> --}}
            <div class="search-container mb-3">
                <div class="input-group">
                    <input type="text" id="busquedaddd" class="form-control" placeholder="Buscar...">
                    <div class="input-group-append">
                        <button class="btn btn-secondary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
                
            </div>
            
            <div class="table-responsive table">
                <table class="table table-striped" id="tableElementos">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Id_dispo</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Asignado a:</th>
                            <th>Estado ofic</th>
                            <th>Estado</th>
                            <th>Observacion</th>
                            <th>Sede</th>
                            <th>Ubicacion interna</th>
                            <th>Ubicacion especifica</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="elementos-body">
                        @foreach($elementosf as $elemento)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$elemento->id_dispo}}</td>
                            <td>{{ $elemento->categoria->nombre }}</td>
                            <td>{{$elemento->marca ?? 'NO APLICA' }}</td>
                            <td>
                                @if ($elemento->user && $elemento->user->persona)
                                    {{ $elemento->user->persona->identificacion }} -
                                    {{ $elemento->user->persona->nombre1 }}
                                    {{ $elemento->user->persona->nombre2 }}
                                    {{ $elemento->user->persona->apellido1 }}
                                    {{ $elemento->user->persona->apellido2 }}
                                @endif
                            </td>
                            <td>{{$elemento->estado_oficina}}</td>
                            <td>{{ $elemento->estado->estado ?? 'NO APLICA' }}</td>
                            <td>{{$elemento->observacion ?? 'NO APLICA' }}</td>
                            <td>{{$elemento->sede}}</td>
                            <td>{{$elemento->ubicacion_interna}}</td>
                            <td>{{$elemento->ubicacion_especifica}}</td>
                            <td>
                                <a class="edit-button" title="Editar"
                                    href="{{ route('elementos-fisicos.edit', $elemento->id) }}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="delete-button" title="Eliminar"
                                    data-id="{{ $elemento->id }}" data-name="{{ $elemento->categoria->nombre }}">

                                    <i data-id="{{ $elemento->id }}"
                                        data-name="{{ $elemento->categoria->nombre }}" class="fas fa-trash-alt">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div class="pagination">
                {{ $elementosf->links('pagination.custom') }}
            </div> --}}
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm" action="{{ route('elementos-fisicos.destroy', 'REPLACE_ID') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="confirmDelete" type="submit" class="btn-link modal-button">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    <style>
    .dataTables_wrapper .dataTables_filter {
            display: none !important;
        }
    </style>

    
</div>

  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        var table = $('#tableElementos').DataTable({
            paging: true,       // Activar paginación
            searching: true,    // Mantener la funcionalidad de búsqueda activa
            ordering: false,    // Mantener ordenamiento si lo necesitas
            info: false,        // Desactivar información de la tabla (como "Mostrando x de y registros")
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json",
                "emptyTable": "No se encontraron registros",
                "zeroRecords": "No se encontraron coincidencias",
                "search": "Buscar:",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                }
            }
        });

        // Configurar búsqueda personalizada
        $('#busquedaddd').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>




@endsection
