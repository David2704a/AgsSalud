@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Auth;
@endphp


@section('title', 'Home')
@section('links')

    <link rel="stylesheet" href="{{ asset('/css/welcome.css') }}">
@endsection


@section('content')
    <div class="content2">
        {{-- @include('components.loader-component') --}}
        <div id="loader-wrapper" class="loader-wrapper">
            <div class="loader"></div>
        </div>

        <div class="content">
            <h1 class="page-title">PANEL DE CONTROL</h1>
            <div class="green-line"></div>
        </div>

        <div class="contenedor">


            <div class="button-container">
                @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
                    <a href="{{ url('/procedimiento') }}" title="Procedimientos" class="button-link">
                        <div class="circle-button btn-background-circle">
                            <img src="{{ asset('imgs/icons/process.png') }}" alt="alo">
                        </div>
                        <span>PROCEDIMIENTOS</span>
                    </a>
                @endif


                @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'colaborador', 'tecnico']))
                    <a href="{{ url('/elementos') }}" title="Elementos" class="button-link">
                        <div class="circle-button btn-background-circle">
                            <img src="{{ asset('imgs/icons/elemento.svg') }}" alt="alo">
                        </div>
                        <span>ELEMENTOS</span>
                    </a>
                @endif


                @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico']))
                    <a href="{{ url('/categorias') }}" class="button-link">
                        <div class="circle-button btn-background-circle">
                            <img style="width: 87px;" src="{{ asset('img/categoria.png') }}" alt="alo">
                        </div>
                        <span>CATEGORIAS</span>
                    </a>
                @endif



                @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'colaborador', 'tecnico']))
                    <a href="{{ url('/reporte') }}" class="button-link" onclick="showLoader()">
                        <div class="circle-button btn-background-circle">
                            <img src="{{ asset('imgs/icons/reportes.svg') }}" alt="alo">
                        </div>
                        <span>REPORTES</span>
                    </a>
                @endif

                @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                    <a href="{{ url('/usuarios') }}" class="button-link">
                        <div class="circle-button btn-background-circle">
                            <img src="{{ asset('imgs/icons/users.svg') }}" alt="alo">
                        </div>
                        <span>USUARIOS</span>
                    </a>
                @endif

            </div>

        </div>

    </div>

    <style>
        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
        function showLoader() {
            const loaderWrapper = document.getElementById("loader-wrapper");
            loaderWrapper.style.display = "flex";

            document.body.style.overflow = "hidden";
        }

        document.addEventListener("DOMContentLoaded", function() {
            const loaderWrapper = document.getElementById("loader-wrapper");
            loaderWrapper.style.display = "none";
            document.body.style.overflow = "auto";
        });
    </script>
@endsection
