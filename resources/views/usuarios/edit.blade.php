@php
    use Illuminate\Support\Facades\Auth;

@endphp

@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/editUsers.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

@endsection

@section('content')
    <div class="content2">
        <div class="content">
            <h1 class="page-title">Editar Usuario Perfil</h1>
            <div class="green-line mt-1"></div>
        </div>
        <div class="button-container" style="margin-bottom: -7px">
            <a href="javascript:void(0);" onclick="history.back();" class="button-izquierda arrow-left">
                <i class="fa-solid fa-circle-arrow-left"></i> Regresar
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



        @include('components.modal-asignar-rol')
        <div class="contenedorPrin">
            <div class="contenedorFondoImg">
                @include('components.svg-fondo-edit-p', [
                    'gradientId' => 'gradient_a',
                    'patternId' => 'pattern_b',
                ])
                <div class="card_photoEditP">
                    @if($usuario->persona->sexo == 'M' ||$usuario->persona->sexo == 'O' ||$usuario->persona->sexo == null)
                    <div class="card-photo"></div>
                    @elseif($usuario->persona->sexo == 'F')
                    @include('components.svg-perfil-femenino')
                    @endif
                </div>
            </div>
            <div class="contenedorForm">
                <div class="rolEditP">
                    <h6>ROL</h6>
                    @if ($rol !== null)
                        <p id="mostrarRolAsignado">{{ ucwords(preg_replace('/(?<!^)([A-Z])/', ' $1', $rol->name)) }}</p>
                    @else
                        <p id="mostrarRolAsignado"></p>
                    @endif

                    <button type="button" id="openModal" class="btnModalEditP">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                        </svg>
                        <span>Asignar Rol</span></button>

                </div>
                <form class="formEditP" action="{{ route('editarPerfilusersR', ['id' => $usuario->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($rol !== null)
                        <input type="hidden" id="role" name="role" value="{{ $rol->name }}">
                    @else
                        <input type="hidden" id="role" name="role">
                    @endif
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="name" class="form-label">Nombre de Usuario</label>
                            <div class="input-group">
                                <div class="icon">
                                    <img src="https://img.icons8.com/material-outlined/24/ffffff/user.png"
                                        alt="Username Icon">
                                </div>
                                <input type="text" placeholder="Usuario" name="name" id="name"
                                    value="{{ $usuario->name }}">
                            </div>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="email" class="form-label">Correo Electrónico</label>

                            <div class="input-group">
                                <div class="icon">
                                    <img src="https://img.icons8.com/material-outlined/24/ffffff/email.png"
                                        alt="Email Icon">
                                </div>
                                <input type="email" placeholder="E-mail" name="email" id="email"
                                    value="{{ $usuario->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <div class="icon" id="iconPassword">
                                    <img src="https://img.icons8.com/material-outlined/24/ffffff/lock.png"
                                        alt="Password Icon">
                                </div>
                                <input type="password" placeholder="Contraseña" name="password" id="password"
                                    value="{{ old('password') }}">
                                <div id="btnEyesEditP" class="password-toggle">
                                    <img
                                        src="https://img.icons8.com/material-outlined/24/ffffff/invisible.png"alt="Toggle Password Visibility">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="passwordConfirm" class="form-label">Confirmar Contraseña</label>
                            <div class="input-group" id="inputGropuConfirm">
                                <div class="icon" id="iconPassword">
                                    <img src="https://img.icons8.com/material-outlined/24/ffffff/lock.png"
                                        alt="Password Icon">
                                </div>
                                <input type="password" placeholder="Contraseña" name="passwordConfirm"
                                    id="passwordConfirm" value="{{ old('password') }}">
                                <div id="btnEyesEditPCon" class="password-toggle">
                                    <img
                                        src="https://img.icons8.com/material-outlined/24/ffffff/invisible.png"alt="Toggle Password Visibility">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="button_containerEditP">
                        <button type="submit" class="btn_guardarEditP">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#btnEyesEditP').on('click', function() {
            if ($('#password').attr('type') === 'password') {
                $('#password').attr('type', 'text');
                $('#btnEyesEditP img').attr('src',
                    'https://img.icons8.com/material-outlined/24/ffffff/visible.png');
            } else {
                $('#password').attr('type', 'password');
                $('#btnEyesEditP img').attr('src',
                    'https://img.icons8.com/material-outlined/24/ffffff/invisible.png');
            }
        })
        $('#btnEyesEditPCon').on('click', function() {
            if ($('#passwordConfirm').attr('type') === 'password') {
                $('#passwordConfirm').attr('type', 'text');
                $('#btnEyesEditPCon img').attr('src',
                    'https://img.icons8.com/material-outlined/24/ffffff/visible.png');
            } else {
                $('#passwordConfirm').attr('type', 'password');
                $('#btnEyesEditPCon img').attr('src',
                    'https://img.icons8.com/material-outlined/24/ffffff/invisible.png');
            }
        })

        $(document).ready(function() {
            function validatePassword() {
                if ($('#password').val() !== $('#passwordConfirm').val()) {
                    $('#inputGropuConfirm').addClass('border_red');
                    $('#inputGropuConfirm').removeClass('border_green');
                    $('.btn_guardarEditP').attr('type', 'button')
                } else {
                    $('.btn_guardarEditP').attr('type', 'submit')
                    $('#inputGropuConfirm').addClass('border_green');
                    $('#inputGropuConfirm').removeClass('border_red');

                }
            }

            $('#passwordConfirm').on('input focus', function() {
                validatePassword();
            });

            $('#passwordConfirm').on('blur', function() {
                if ($('#password').val() === $('#passwordConfirm').val()) {
                    $('#inputGropuConfirm').removeClass('border_red border_green');
                    $('.btn_guardarEditP').attr('type', 'submit')

                }
            });

            $('#password').on('input', function() {
                if ($('#passwordConfirm').is(':focus')) {
                    validatePassword();
                }
            });
        });

        $('.btn_guardarEditP').on('click', function() {
            if ($('.btn_guardarEditP').attr('type') === 'button') {
                alertSwitch('error', 'no se puede type button')
            }
        });


        $(document).ready(function() {
            $("#openModal").click(function() {
                $("#modalAsignarRol").fadeIn();
            });

            $(".close").click(function() {
                $("#modalAsignarRol").fadeOut(100);
            });

            $(window).click(function(event) {
                if (event.target.id === "modalAsignarRol") {
                    $("#modalAsignarRol").fadeOut(100);
                }
            });

            $(document).on('keydown', function(event) {
                if (event.key === "Escape") {
                    $('#modalAsignarRol').fadeOut(100);
                }
            });

        });

        $('.action_has.has_liked').click(function() {
            $('#modalAsignarRol').fadeOut(100);
            var idRol = $(this).data('idrol');
            var nameRol = $(this).data('namerol');
            var nombreRolFormateado = nameRol.replace(/(?<!^)([A-Z])/g, ' $1');
            $('#mostrarRolAsignado').text(nombreRolFormateado);

            $('#role').val(nameRol);
        })
    </script>
@endsection
