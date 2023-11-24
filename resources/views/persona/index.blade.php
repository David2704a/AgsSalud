@extends('layouts.app')

@section('title', 'Perfil')

@php 
    use Illuminate\Support\Facades\Auth;
@endphp



@section('links')

<link rel="stylesheet" href="{{asset('/css/categoria/categoria.css')}}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection



@section('content')
<div class="content">
<h1 class="page-title">Actualizar perfil</h1>
<div class="green-line"></div>

<div class="button-container">
    <a href="/dashboard" class="button-izquierda arrow-left"><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
</div>



   
    <div class="table-container">
        
          
    <div class="card" style="width:50%; margin-left:25%">
        <div class="card-body">
            <form action="{{ route('Actualizar') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="">
                        <h4 class="margin-left:25%">{{ Auth::user()->name}}</h4>
                    </div>
                </div>

                
                <div>
                    <div class="form-group">
                        <label class="col-lg-8 control-label" for="name">Nombre de Usuario</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="form-control">
                    </div>
                </div>
                <div>
                    <div class="form-group ">
                        <label for="name">correo</label>
                        <input style="align:center" type="email" name="email"
                            value="{{ Auth::user()->email}}" class="form-control">
                    </div>
                </div>
                <br>
                <br>
                <div class="row text-center mb-4 mt-5">
                    <div class="cold-md-12">
                        <button type="submit" class=" btn btn-danger" id="formSubmit">Guardar cambios</button>
                        <a href="{{ route('editarPerfil', ['id' => Auth::user()->id]) }}" class="btn btn-primary">Actualizar Información</a>
                </div>
            </form>

            <br>
<br>
<br>
        </div>
    </div>
  
    </div>




</div>




<br>
<br>
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