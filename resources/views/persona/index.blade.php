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
                        <button type="submit" href="{{ route('editarPerfiluser', ['id' => Auth::user()->id]) }}" class=" btn btn-danger" id="formSubmit">Guardar cambios</button>
                        <a href="{{ route('personas.update', ['id' => Auth::user()->id]) }}" class="btn btn-primary">Actualizar Información</a>
                </div>
            </form>

            <br>
<br>
<br>
        </div>
    </div>
  
    </div>



</div>



<div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="actualizarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Contenido del modal aquí -->
            <div class="modal-header">
                <h5 class="modal-title" id="actualizarModalLabel">Actualizar Información</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para la actualización -->
                <form action="{{ route('personas.update', ['id' => Auth::user()->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if(isset($user) && isset($user->persona))
                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="nombre1" class="form-label">Primer Nombre</label>
                        <input type="text" class="form-control" id="nombre1" name="nombre1" value="{{ old('nombre1', $user->persona->nombre1) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre2" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" id="nombre2" name="nombre2" value="{{ old('nombre2', $user->persona->nombre2) }}">
                    </div>

                    <div class="mb-3">
                        <label for="apellido1" class="form-label">Primer Apellido</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1" value="{{ old('apellido1', $user->persona->apellido1) }}">
                    </div>

                    <div class="mb-3">
                        <label for="apellido2" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" id="apellido2" name="apellido2" value="{{ old('apellido2',$user->persona->apellido2) }}">
                    </div>

                    <div class="mb-3">
                        <label for="idTipoIdentificacion" class="form-label">Tipo de Identificación</label>
                        <!-- Aquí puedes poner tu lógica para seleccionar el tipo de identificación -->
                        <input type="text" class="form-control" id="idTipoIdentificacion" name="idTipoIdentificacion" value="{{ old('idTipoIdentificacion', $user->personaidTipoIdentificacion) }}">
                    </div>

                    <div class="mb-3">
                        <label for="identificacion" class="form-label">Número de Identificación</label>
                        <input type="text" class="form-control" id="identificacion" name="identificacion" value="{{ old('identificacion', $user->persona->identificacion) }}" unique>
                    </div>

                    <div class="mb-3">
                        <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNac" name="fechaNac" value="{{ old('fechaNac', $user->persona->fechaNac) }}">
                    </div>

                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <input type="text" class="form-control" id="sexo" name="sexo" value="{{ old('sexo', $user->persona->sexo) }}">
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $user->persona->direccion) }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->persona->email) }}">
                    </div>

                    <div class="mb-3">
                        <label for="celular" class="form-label">Número de Celular</label>
                        <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular', $user->celular) }}">
                    </div>


                    <button type="submit" class="btn btn-primary">Actualizar</button>

                    @else
                <p>Error: Usuario o persona no encontrados.</p>
            @endif

                </form>
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