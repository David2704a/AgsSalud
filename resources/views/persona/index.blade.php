@extends('layouts.app')

@section('title', 'Perfil')

@php
    use Illuminate\Support\Facades\Auth;
@endphp



@section('links')
    <link rel="stylesheet" href="{{ asset('/css/persona.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
    <div class="content2">
        <div class="content">
            <h1 class="page-title">ACTUALIZAR USUARIO</h1>
            <div class="green-line"></div>
        </div>


        <div class="button-container">
            <a href="{{ url('/dashboard') }}" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i>
                Regresar</a>
        </div>


        @if (session('success'))
            <script>
                alertSwitch('success', 'El Usuario ha sido actualizado con éxito', 3500)
            </script>
        @endif
        @if (session('successInfoPer'))
            <script>
                alertSwitch('success', 'La información personal del usuario ha sido actualizada con éxito', 3500)
            </script>
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

        <div class="contenidoForm">
            <div class="container">
                <div class="form-container">
                    <h1>Actualizar Usuario</h1>
                    <form id="updateProfileForm" action="{{ route('Actualizar', ['id' => Auth::user()->id]) }}"
                        method="POST">
                        @csrf
                        <div class="input-group">
                            <div class="icon">
                                <img src="https://img.icons8.com/material-outlined/24/ffffff/user.png" alt="Username Icon">
                            </div>
                            <input  type="text" placeholder="Usuario" name="name" id="name"
                                value="{{ Auth::user()->name }}">
                        </div>
                        <div class="input-group">
                            <div class="icon">
                                <img src="https://img.icons8.com/material-outlined/24/ffffff/email.png" alt="Email Icon">
                            </div>
                            <input type="email" placeholder="E-mail" name="email" id="email"
                                value="{{ Auth::user()->email }}">
                        </div>
                        @if (auth()->user()->hasRole(['superAdmin', 'admin']))
                            <div class="input-group">
                                <div class="icon" id="iconPassword">
                                    <img src="https://img.icons8.com/material-outlined/24/ffffff/lock.png"
                                        alt="Password Icon">
                                </div>
                                <input type="password" placeholder="Contraseña" name="password" id="password">
                                <div id="btnEyes" class="password-toggle">
                                    <img
                                        src="https://img.icons8.com/material-outlined/24/ffffff/invisible.png"alt="Toggle Password Visibility">
                                </div>
                            </div>
                        @endif
                        <div class="div_btn_actualizarP">
                            <a class="btn_actualizarP" href="{{ route('editarPerfil', ['id' => Auth::user()->id]) }}"
                                style="float: right;">Actualizar Información Personal</a>
                        </div>
                        @if (auth()->user()->hasRole(['superAdmin', 'admin']))
                            <button type="submit" href="{{ route('ActualizarPerfil') }} ">Guardar cambios</button>
                        @else
                            <button class="btn_guardarC" id="btn_guardarC">Guardar cambios</button>
                        @endif
                    </form>
                </div>
                <div class="illustration-container">
                    @auth
                        @if (Auth::user()->persona && in_array(Auth::user()->persona->sexo, ['M', 'F', 'O', null]))
                            @if (Auth::user()->persona->sexo === 'M')
                                <img src="{{ asset('img/undraw_Progress_indicator_re_4o4n.png') }}" alt="Illustration">
                            @elseif (Auth::user()->persona->sexo === 'F')
                                <img src="{{ asset('img/undraw_subscriptions_re_k7jj.png') }}" alt="Illustration">
                            @elseif(Auth::user()->persona->sexo === 'O')
                                <img src="{{ asset('img/undraw_Progress_indicator_re_4o4n.png') }}" alt="Illustration">
                            @elseif (Auth::user()->persona->sexo === null)
                                <img src="{{ asset('img/undraw_Progress_indicator_re_4o4n.png') }}" alt="Illustration">
                            @endif
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#btnEyes').on('click', function() {
            if ($('#password').attr('type') === 'password') {
                $('#password').attr('type', 'text');
                $('#btnEyes img').attr('src', 'https://img.icons8.com/material-outlined/24/ffffff/visible.png');
            } else {
                $('#password').attr('type', 'password');
                $('#btnEyes img').attr('src', 'https://img.icons8.com/material-outlined/24/ffffff/invisible.png');
            }
        })

        $('#btn_guardarC').on('click', function() {
            $('#btn_guardarC').attr('type', 'button');
            alertSwitch('error', 'El rol que posees no tiene permitido realizar esta acción. Por favor comunícate con un administrador', 4500)
        })
    </script>
@endsection
