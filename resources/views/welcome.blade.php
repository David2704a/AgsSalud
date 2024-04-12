@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Auth;
@endphp


@section('title','Home')
@section('links')

<link rel="stylesheet" href="{{asset('/css/welcome.css')}}">
@endsection


@section('content')

<div class="content">
    <h1 class="page-title">PANEL DE CONTROL</h1>
    <div class="green-line"></div>
</div>

<div class="contenedor">


<div class="button-container">


    @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
    <a href="{{url('/procedimiento')}}" title="Procedimientos" class="button-link">
        <div class="circle-button btn-background-circle">
            <img src="{{asset('imgs/icons/process.png')}}" alt="alo">
        </div>
        <span>PROCEDIMIENTOS</span>
    </a>
    @endif


    @if(auth()->user()->hasRole(['superAdmin','administrador','colaborador','tecnico']))
    <a href="{{ url('/elementos') }}" title="Elementos" class="button-link">
        <div class="circle-button btn-background-circle">
            <img src="{{asset('imgs/icons/elemento.svg')}}" alt="alo">
        </div>
        <span>ELEMENTOS</span>
    </a>
    @endif


    @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
    <a href="{{ url('/categorias') }}" class="button-link">
        <div class="circle-button btn-background-circle">
            <img style="width: 87px;" src="{{asset('img/categoria.png')}}" alt="alo">
        </div>
        <span>CATEGORIAS</span>
    </a>
    @endif



    @if(auth()->user()->hasRole(['superAdmin','administrador','colaborador','tecnico']))
    <a href="{{ url('/reporte')}}" class="button-link">
        <div class="circle-button btn-background-circle">
            <img src="{{asset('imgs/icons/reportes.svg')}}" alt="alo">
        </div>
        <span>REPORTES</span>
    </a>
    @endif

    @if(auth()->user()->hasRole(['superAdmin','administrador']))

    <a href="{{url('/usuarios')}}" class="button-link">
        <div class="circle-button btn-background-circle">
            <img src="{{asset('imgs/icons/users.svg')}}" alt="alo">
        </div>
        <span>USUARIOS</span>
    </a>
    @endif

</div>

</div>


@endsection

