@extends('layouts.app')

@section('title', 'Procedimiento')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/procedimiento/procedimiento.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/prodedimiento/procedimiento.js') }}"></script>

@endsection
@section('content')

    <div class="content2">
        <div class="containerTitle">
            <h1 class="page-title">CREAR PROCEDIMIENTOS</h1>
            <div class="green-line"></div>
        </div>



        <div class="button-container">
            <a href="{{ route('mostrarProcedimiento') }}" class="button-izquierda arrow-left"><i
                    class="fa-solid fa-circle-arrow-left"></i> Regresar</a>

        </div>

        <div class="menu-containers">
            <ul class="menu">
                <li>
                    <a href="{{ route('mostrarEstadoP') }}">Estado de Procedimiento</a>
                </li>
                <li>
                    <a href="{{ route('mostrarTipoP') }}">Tipo de Procedimiento</a>
                </li>
            </ul>
        </div>

        @if ($errors->any())
            <div id="alert" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form" action="{{ route('storeProcedimiento') }}" method="POST">
            @csrf

            <div class="progress-bar">
                <div class="progress" id="progress" style="width: 50%;"></div>
                <div class="markers">
                    <span class="marker filled" style="left: 50%;">1</span>
                    <span class="marker" style="left: 100%;">2</span>
                    {{-- <span class="marker" style="left: 100%;">3</span> --}}
                </div>
            </div>

            <!-- Parte 1 -->
            <div class="form-part active" id="parte1">

                <label for="idTipoProcedimiento">Tipo Procedimiento</label>
                <select name="idTipoProcedimiento" id="idTipoProcedimiento" onchange="traerElementosSinUsuario()">
                    <option value="">Seleccionar una opción</option>
                    @foreach ($tipoProcedimiento as $tipoProcedimiento)
                        <option value="{{ $tipoProcedimiento->idTipoProcedimiento }}"
                            data-tipo="{{ $tipoProcedimiento->tipo }}">{{ $tipoProcedimiento->tipo }}
                        </option>
                    @endforeach
                </select>
                <br>

                <div class="elementoSelect" style="flex: 1;min-width: 640px">
                    <label for="idElemento">Elemento</label>
                    <select class="selectElemento select2" name="idElemento" onchange="changeElemento()" id="idElemento"
                        style="max-width: 10%;">
                        <option value="">Seleccionar un Elemento</option>
                        @foreach ($elementosSinPrestamo as $elemento)
                            <option value="{{ $elemento->idElemento }}">{{ $elemento->id_dispo }}
                                {{ $elemento->categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="idResponsableEntrega">Responsable Recibe</label>
                <select name="idResponsableEntrega" id="idResponsableEntrega" class="selectEntregaTodos">
                    <option value="">Seleccionar una opción</option>
                    @foreach ($usuariosEntregaFiltrados as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
                <select name="idResponsableEntrega" hidden id="idResponsableEntrega" class="selectEntregaTecnico">
                    <option value="">Seleccionar una opción</option>
                    @foreach ($usuariosRecibe as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>


                <label for="idResponsableRecibe">Responsable Entrega</label>
                <select name="idResponsableRecibe" id="idResponsableRecibe" class="selectRecibeTecnico">
                    <option value="">Seleccionar una opción</option>
                    @foreach ($usuariosRecibe as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
                <select name="idResponsableRecibe" hidden id="idResponsableRecibe" class="selectRecibeTodos">
                    <option value="">Seleccionar una opción</option>
                    @foreach ($usuariosEntregaFiltrados as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>


                <label for="idEstadoProcedimiento">Estado Procedimiento</label>
                <select name="idEstadoProcedimiento" id="idEstadoProcedimiento">
                    <option value="">Seleccionar una opción</option>
                    @foreach ($estadoProcedimiento as $estadoProcedimiento)
                        <option value="{{ $estadoProcedimiento->idEstadoP }}">{{ $estadoProcedimiento->estado }}</option>
                    @endforeach
                </select>

                <br>
                <button type="button" onclick="mostrarParte('parte2')">Siguiente</button>
            </div>

            <!-- Parte 2 -->
            <div class="form-part" id="parte2">
                <label for="fechaReprogramada">Fecha Reprogramada</label>
                <input type="date" name="fechaReprogramada" id="fechaReprogramada" value="alo" disabled>
                <span class="input-message">La fecha reprogramada se asignará automáticamente al terminar el
                    procedimiento.</span>
                <label for="observacion">Observación</label>
                <input type="text" name="observacion" id="observacion"
                    placeholder="Escriba aqui una observación sobre el procedimiento...">


                <label for="fechaInicio">Fecha Inicio</label>
                <input type="date" name="fechaInicio" id="fechaInicio">

                <label for="fechaFin">Fecha Fin</label>
                <input type="date" name="fechaFin" id="fechaFin">
                <br>
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora">
                <br>

                <button type="button" onclick="mostrarParte('parte1')">Anterior</button>
                <button type="submit">Crear</button>
            </div>

            <!-- Parte 3 -->


            {{-- <div class="form-part" id="parte3">

                <script>
                    $(document).ready(function() {
                        $('.select2').select2({
                            theme: null
                        }).next('.select2-container').find('.select2-selection').css('width', '100%');
                    });
                </script>
                <br>
                <label for="idEstadoProcedimiento">Estado Procedimiento</label>
                <select name="idEstadoProcedimiento" id="idEstadoProcedimiento">
                    <option value="">Seleccionar una opción</option>
                    @foreach ($estadoProcedimiento as $estadoProcedimiento)
                        <option value="{{ $estadoProcedimiento->idEstadoP }}">{{ $estadoProcedimiento->estado }}</option>
                    @endforeach
                </select>
                <br>
                <div class="button-container">
                    <button type="button" onclick="mostrarParte('parte2')">Anterior</button>
                    <button type="submit">Crear</button>
                </div>
            </div> --}}
        </form>

        <script>
            function changeElemento() {
                var idElemento = $('#idElemento').val();

                $.ajax({
                    url: urlBase + '/mostrarResponsableEntrega',
                    type: "GET",
                    data: {
                        idElemento: idElemento
                    },
                    success: function(data) {
                        if (data !== '') {
                        $('#idResponsableEntrega').empty();
                        $('#idResponsableEntrega').append('<option value="">Seleccionar una opción</option>');
                            $('#idResponsableEntrega').append('<option value="' + data.id + '" selected>' + data
                                .name +
                                '</option>');
                        }
                    }
                })
            }
        </script>

    @endsection
