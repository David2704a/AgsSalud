@extends('layouts.app')

@section('title', 'List')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/categoria/categoria.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
    <div class="content">
        <h1 class="page-title">Usuarios</h1>
        <div class="green-line"></div>

        <div class="button-container">
            <a href="/dashboard" class="button-izquierda arrow-left">
                <i class="fa-solid fa-circle-arrow-left"></i> Regresar
            </a>
            <a href="{{ route('auth.register') }}" class="button-derecha">
                <i class="fas fa-file"></i> Nuevo usuario
            </a>
        </div>

        @if(session('success'))
            <div id="alert" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div id="error-alert" class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($users->count() > 0)
            <div class="table-container">
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="Buscar...">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <th>Id</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        @foreach ($usuario->roles as $rol)
                                            {{ $rol->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if(auth()->user()->hasRole(['superAdmin','administrador']))
                                            <a class="edit-button" method="POST"
                                                href="{{ route('usuarios.edit', ['id' => $usuario->id]) }}"
                                                title="Editar"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        @endif

                                        @if(auth()->user()->hasRole(['superAdmin','administrador']))
                                            <button type="button" class="delete-button" title="Eliminar"
                                                data-id="{{ $usuario->id }}" data-name="{{ $usuario->nombre }}">
                                                <i data-id="{{ $usuario->id }}" data-name="{{ $usuario->nombre }}"
                                                    class="fas fa-trash-alt"></i>
                                            </button>


                                            

                                            <div id="myModal_{{ $usuario->id }}" class="modal">
                                                <div class="modal-content">
                                                    <p id="modalMessage"></p>
                                                    <div class="button-container">
                                                        <button id="cancelButton" class="modal-button">Cancelar</button>
                                                        <form id="deleteForm_{{ $usuario->id }}"
                                                            action="{{ route('destroyUser', ['id' => $usuario->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button id="confirmDelete" type="submit"
                                                                class="btn-link modal-button">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination">
                {{ $users->links('pagination.custom') }}
            </div>
        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mensajeVacio = document.querySelector('.mensaje-vacio');
            const searchInput = document.getElementById('search-input');
            const tableBody = document.querySelector('tbody');

            function updateTable(filtro) {
                $.ajax({
                    url:'/usuariosBuscar',
                    method: 'GET',
                    data: { filtro: filtro },
                    success: function (data) {
                        tableBody.innerHTML = data;
                    },
                    error: function (error) {
                        console.error('Error al realizar la búsqueda:', error);
                    },
                });
            }

            searchInput.addEventListener('input', function () {
                const filtro = searchInput.value.trim().toLowerCase();
                updateTable(filtro);
            });

            $('.delete-button').on('click', function () {
                var userId = $(this).data('id');
                $('#myModal_' + userId).show();
            });
        });
    </script>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm"
                    action="{{ route('destroyUser', ['id' => $usuario->id]) }}" method="POST">
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
                <img src="{{ asset('imgs/logos/logo-sena.png') }}" width="45" alt="Imagen 1">
                <img src="{{ asset('imgs/logos/ESCUDO COLOMBIA.png') }}" width="45" alt="Imagen 2">
            </div>
            <div class="column">
                <img src="{{ asset('imgs/logos/logo_fondo.png') }}" width="130" alt="Imagen 3">
                <img src="{{ asset('imgs/logos/Logo_Enterritorio.png') }}" width="100" alt="Imagen 4">
            </div>
        </div>
        <div class="right-content">
            <div class="images">
                <img src="{{ asset('imgs/logos/LOGO ISO.png') }}" width="50" alt="Imagen 5">
                <img src="{{ asset('imgs/logos/Logo-IQNet.png') }}" width="75" alt="Imagen 6">
            </div>
            <div class="separator"></div>
            <div class="text">
                <p>Copyright © 2023 AGS SALUD SAS</p>
                <p>Todos los derechos Reservados</p>
            </div>
        </div>
    </footer>
@endsection
