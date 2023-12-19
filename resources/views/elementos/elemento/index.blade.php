@extends('layouts.app')

@section('title', 'Elemento')

@section('links')

<link rel="stylesheet" href="{{asset('/css/elemento/elemento.css')}}">
<script src="{{asset('js/elemento/elemento.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
@section('content')

    <div class="contents">
<h1 class="page-title">Elementos</h1>
<div class="green-line"></div>


<div class="button-container">
    <a href="/dashboard" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
        @if(auth()->user()->hasRole(['superAdmin','admin']))
            <a href="{{route('elementos.create')}}" class="button-derecha"><i class="fas fa-file"></i> Nuevo Elemento</a>
        @endif

</div>
<div class="menu-container">
    <ul class="menu">
        @if(auth()->user()->hasRole(['superAdmin','admin']))
        <li>
            <a href="{{route('proveedores.index')}}">Proveedores</a>
        </li>
        @endif
        @if(auth()->user()->hasRole(['superAdmin','admin']))
        <li>
            <a href="{{route(['superAdmin','admin'])}}">Facturas</a>
        </li>
        @endif
        @if(auth()->user()->hasRole(['superAdmin','admin']))
        <li>
            <a href="{{route('tipoElementos.index')}}">Tipo elemento</a>
        </li>
        @endif
    </ul>
</div>



{{-- <a href="{{ url('excel?idEstadoEquipo=1') }}" class="btn btn-success btn-lg" target="_blank" title="Ver Excel"><i
    class="fa-solid fa-file-excel fa-lg" style="color: #178a13;"></i></a> --}}



@if(session('success'))
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
            <th>Acciones</th>
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
                    <td>{{ $elemento->procedimiento->estadoProcedimiento->estado ?? 'No aplica'}}</td>
                    <td>{{ $elemento->categoria->nombre ?? 'No aplica' }}</td>
                    <td>{{ $elemento->factura->codigoFactura ?? 'No aplica' }}</td>
                    <td>{{ $elemento->user->persona->nombre1 ?? 'No aplica' }} {{ $elemento->user->persona->apellido1}}</td>

                    <td>
                        @if(auth()->user()->hasRole(['superAdmin','admin']))
                        <a class="edit-button" title="Editar"
                            href="{{ route('elementos.edit',$elemento->idElemento) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        @endif
                        @if(auth()->user()->hasRole(['superAdmin','admin']))
                        <button type="button" class="delete-button" title="Eliminar"
                        data-id="{{ $elemento->idElemento }}"
                         data-name="{{ $elemento->modelo }}">

                            <i data-id="{{ $elemento->idElemento }}" data-name="{{ $elemento->modelo }}" class="fas fa-trash-alt"></i>
                        </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    </div>
    <div class="pagination">
        {{$elementos->links('pagination.custom') }}
    </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm" action="{{ route('elementos.destroy','REPLACE_ID') }}" method="POST">
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
                <img src="{{asset('imgs/logos/Logo-IQNet .png')}}" width="75" alt="Imagen 6">
            </div>
            <div class="separator"></div>
            <div class="text">
                <p>Copyright © 2023 AGS SALUD SAS</p>
                <p>Todos los derechos Reservados</p>
            </div>
        </div>
    </footer>
@endsection
