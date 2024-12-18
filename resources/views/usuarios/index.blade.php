@extends('layouts.app')

@section('title', 'List')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/categoria/categoria.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/user/user.js') }}"></script>
@endsection

@section('content')
    <div class="content2">
        <div class="content">
            <h1 class="page-title">Usuarios</h1>
            <div class="green-line"></div>
        </div>

        <div class="button-container">
            <a href="{{ url('/dashboard') }}" class="button-izquierda arrow-left">
                <i class="fa-solid fa-circle-arrow-left"></i> Regresar
            </a>
            <a href="{{ route('auth.register') }}" class="button-derecha">
                <i class="fas fa-file"></i> Nuevo usuario
            </a>
        </div>

        @if (session('success'))
            <div id="alert" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div id="error-alert" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
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
                            @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                                <th>Acciones</th>
                            @endif
                        </thead>
                        <tbody>
                            @foreach ($users as $usuario)
                                <tr>

                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->user_name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->rol }}</td>

                                    @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                                    <td>
                                        @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                                            <a class="edit-button" method="POST"
                                                href="{{ route('usuarios.edit', ['id' => $usuario->id]) }}"
                                                title="Editar"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        @endif

                                        @if (auth()->user()->hasRole(['superAdmin']))
                                            <button type="button" class="delete-button" title="Eliminar"
                                                data-id="{{ $usuario->id }}" data-name="{{ $usuario->nombre }}">
                                                <i data-id="{{ $usuario->id }}" data-name="{{ $usuario->nombre }}"
                                                    class="fas fa-trash-alt"></i>
                                            </button>




                                            <div id="myModal_{{ $usuario->id }}" class="modalEliminar">
                                                <div class="modal_content">
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
                                    @endif
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

    <div id="myModal" class="modalEliminar">
        <div class="modal_content">
            <p id="modalMessage"></p>
            <div class="button-container">
                <button id="cancelButton" class="modal-button">Cancelar</button>
                <form id="deleteForm" action="{{ route('destroyUser', ['id' => $usuario->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="confirmDelete" type="submit" class="btn-link modal-button">Eliminar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
