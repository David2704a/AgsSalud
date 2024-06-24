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

    <div class="card table-container">
        <div class="card-body ">
            
            <div class="table-responsive table" >
                <form action="">

                    <div class="group">
                        <label for="" class="form-label">name</label>
                        <input type="text" class="form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

@endsection

