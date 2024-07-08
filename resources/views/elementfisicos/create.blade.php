@extends('layouts.app')

@section('title', 'Elemento')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/elemento/elementosfisicos.css') }}">
    <script src="{{ asset('js/elemento/elemento.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('content')


<div class="container mt-5">
    <div class="text-center">
        <h1 class="page-title">Crear elementos físicos</h1>
        <div class="green-line mx-auto my-3"></div>
    </div>

    <div class="d-flex justify-content-between my-4 button-container" style="width: 50%">
        <a href="{{ url('/dashboard') }}" class="btn btn-primary button-izquierda arrow-left">
            <i class="fa-solid fa-circle-arrow-left"></i> Regresar
        </a>
        {{-- @if (auth()->user()->hasRole(['superAdmin', 'administrador', 'tecnico'])) --}}
        <a class="btn btn-success button-derecha">
            <i class="fas fa-file"></i>
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Seleccionar Archivo Excel:</label>
                    <input type="file" name="file" class="form-control" accept=".xlsx, .xls">
                </div>
                <button type="submit" class="btn btn-primary">Subir</button>
            </form>
        </a>
        {{-- @endif --}}
    </div>

    
    

    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <form class="form" action="{{route('elementos-fisicos.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="progress-bar">
                <div class="progress" id="progress" style="width: 0%;"></div>
                <div class="markers">
                    <span class="marker filled" style="left: 30%;">1</span>
                    <span class="marker" style="left: 70%;">2</span>
                </div>
            </div>
    
                <div class="form-part active" id="parte1">
                    
                    <label for="idCategoria">Categoria</label>
                    <select name="idCategoria" id="idCategoria" class="input" >
                        <option value="">Seleccionar la Categoria </option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre}}
                        @endforeach
                    </select>
                    <label for="idDispo">Id Dispositivo</label>
                    <input type="text" name="id_dispo" id="id-dispo-input" class="input" readonly>


                <label for="marca">Marca del producto (*)</label>
                <input type="text" name="marca" id="marca" class="input">
                
                <label for="idUser">Asignado A:</label>
                <select name="idUser" id="idUser" class="input">
                    <option value="">Seleccionar una opción</option>
                    @foreach ($persona as $user)
                        <option value="{{ $user->id}}">
                            {{ $user->identificacion }} - 
                            {{ $user->nombre1 }} 
                            {{ $user->nombre2 ?? '' }} 
                            {{ $user->apellido1 }} 
                            {{ $user->apellido2 ?? '' }}
                        </option>
                    @endforeach
                </select>

                <label for="estado_ofi">Estado oficina (*)</label>
                <input type="text" name="estado_ofi" id="estado_ofi" class="input">

                <label for="idEstadoEquipo">Estado del producto</label>
                <select name="idEstadoEquipo" id="idEstadoEquipo" class="input" >
                    <option value="">Seleccionar el estado</option>
                    @foreach ($estados as $estado)
                        <option value="{{$estado->idEstadoE}}">{{ $estado->estado}}</option>
                    @endforeach
                </select>

                <button type="button" onclick="mostrarParte('parte2')">Siguiente</button>
            </div>
    
            <div class="form-part" id="parte2">
                <label for="observacion">Observacion (*)</label>
                <input type="text" name="observacion" id="observacion" class="input">

                <label for="sede">Sede</label>
                <input type="text" name="sede" id="sede" class="input">

                <label for="ubicacion_interna">Ubicacion interna</label>
                <input type="text" name="ubicacion_interna" id="ubicacion_interna" class="input">

                <label for="ubicacion_especifica">ubicacion expecifica</label>
                <input type="text" name="ubicacion_especifica" id="ubicacion_especifica" class="input">

                <div class="button-container">
                    <button type="button" onclick="mostrarParte('parte1')">Anterior</button>
                    <button type="submit">Crear</button>
                </div>
    
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#idCategoria').change(function() {
        var idCategoria = $(this).val();

        $.ajax({
            url: '{{ route('elementos.iddispo') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                idCategoria: idCategoria
            },
            success: function(response) {
                $('#id-dispo-input').val(response.id_dispo).prop('readonly', true); // Establecer readonly después de llenar el valor
            },
            error: function(xhr, status, error) {
                var mensaje = JSON.parse(xhr.responseText);
                console.log(mensaje);

                Swal.fire({
                    title: "Error",
                    text: mensaje.message,
                    icon: "error"
                });

                $('#id-dispo-input').prop('readonly', false).val(''); // Permitir edición y limpiar el campo en caso de error
            }
        });
    });
});

</script>


@endsection

