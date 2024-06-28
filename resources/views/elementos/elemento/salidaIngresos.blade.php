@extends('layouts.app')

@section('title', ' INGRESO Y/O SALIDA')

@section('links')

    <link rel="stylesheet" href="{{ asset('/css/elemento/elemento.css') }}">
    <script src="{{ asset('js/elemento/elemento.js') }}"></script>
    <script src="{{ asset('js/elemento/ingresoSalida.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

@endsection
@section('content')

    <div class="content2">
        <input type="hidden" id="idElementoIngresoS" value="{{ $elementos->idElemento }}">
        <div class="content" style="text-align: center">
            <h1 class="page-title">FORMULARIO DE INGRESO Y/O SALIDA</h1>
            <div class="green-line" style="width: 32em"></div>
        </div>
        <div class="acciones_buttons">
            <a href="{{ route('elementos.index') }}" class="button-izquierda arrow-left"><i
                    class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
            <button type="button" id="btnGenerarInforme" class="btn btn-success">GENERAR INFORME</button>
        </div>
        <div class="conainerPrincipalIngresoSalida">
            <div class="containerInfoPersonal">
                <div class="personaAutorizada">
                    <div class="titleFormAutorizada">
                        <h6>
                            PERSONA A QUIEN SE AUTORIZA
                        </h6>
                    </div>
                    <div class="input-container">
                        <label for="name">NOMBRE:</label>
                        <input type="text" id="nameUserAutorizado" name="name" value="{{ $elementos->user->name }}">
                        <input type="hidden" id="idUserAutorizado" value="{{ $elementos->idUsuario }}">
                    </div>
                    <div class="input-container">
                        <label for="position">CARGO:</label>
                        <input type="text" id="cargoUserAutorizado" name="position">
                    </div>
                    <div class="input-container">
                        <label for="id">IDENTIFICACIÓN:</label>
                        <input type="text" id="identiUserAutorizado" name="id"
                            value="{{ $elementos->user->persona->identificacion }}">
                    </div>
                </div>
                <div class="personaQueAutoriza">
                    <div class="titleFormAutorizada">
                        <h6>
                            PERSONA QUIEN AUTORIZA
                        </h6>
                    </div>
                    <div class="input-container">
                        <label for="name">NOMBRE:</label>
                        <input type="text" id="nameUserAutoriza" name="name" value="{{ auth()->user()->name }}">
                        <input type="hidden" id="idUserAutoriza" value="{{ auth()->user()->id }}">

                    </div>
                    <div class="input-container">
                        <label for="position">CARGO:</label>
                        <input type="text" id="cargoUserAutoriza" name="position">
                    </div>
                    <div class="input-container">
                        <label for="id">IDENTIFICACIÓN:</label>
                        <input type="text" id="identiUserAutoriza" name="id"
                            value="{{ auth()->user()->persona->identificacion }}">
                    </div>
                </div>
            </div>
            <div class="tiemposDeAccionFecha">
                <div class="tituloPrin">
                    <div class="tituloFechas">
                        <h6>FECHA DE INGRESO Y/O SALIDA</h6>
                    </div>
                </div>

                <div class="containerInputs">
                    <div class="input-container">
                        <label for="date">FECHA:</label>
                        <input type="date" id="fechaInicioIngreso" name="fechaInicioIngreso">
                    </div>
                    <div class="input-container">
                        <label for="time">HORA:</label>
                        <input type="time" id="horaInicioIngreso" name="horaInicioIngreso">
                    </div>
                    <div class="prestamoTemporal">
                        <div class="titlePrestamosTemp">
                            <h6>PRESTAMO TEMPORAL</h6>
                        </div>
                        <div class="checkbox-container">
                            <div class="checkPrestamoSi">
                                {{-- <label for="prestamo_si">SI</label>
                                <input type="checkbox" id="prestamo_si" name="prestamo" value="SI"> --}}
                                <label for="prestamo_si" class="custom-checkbox">
                                    <span class="labelMark" style="margin-right: 0.5em;">SI</span>
                                    <input type="radio" id="prestamo_si" name="prestamo" value="SI">
                                    <span class="checkmark"></span>
                                </label>

                            </div>
                            <div class="checkPrestamoNo">
                                <label for="prestamo_no" class="custom-checkbox">
                                    <span class="labelMark" style="margin-right: 0.5em">NO</span>
                                    <input type="radio" id="prestamo_no" name="prestamo" value="NO">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="prestamoTemporal">
                        <div class="titlePrestamosTemp">
                            <h6>DURACIÓN</h6>
                        </div>
                        <div class="inputsInformativos">
                            <div class="input-container">
                                <label for="date">DESDE</label>
                                <input type="date" id="duracionDesde" disabled name="duracionDesde">
                            </div>
                            <div class="input-container">
                                <label for="position">HASTA</label>
                                <input type="date" id="fechaFinSalida"  name="position">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="motivoIngresoSalida">

                <div class="tituloPrinMotivo">
                    <div class="tituloMotivo">
                        <h6>MOTIVO DE INGRESO Y/O SALIDA DE EQUIPOS DE COMPUTO</h6>
                    </div>
                </div>
                <div class="checkbox-containerMotivo">
                    <div class="checkMotivo">
                        <label for="mantenimientoRep" class="custom-checkbox">
                            <span class="labelMark"
                                style="margin-right: 0.5em; min-width:225px; max-width:225px;">Mantenimiento y/o
                                Reparación</span>
                            <input type="radio" id="mantenimientoRep" name="motivo_ingreso"
                                value="Mantenimiento y/o Reparación">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkMotivo">
                        <label for="capacitacion" class="custom-checkbox">
                            <span class="labelMark"
                                style="margin-right: 0.5em; min-width:225px; max-width:225px;">Mantenimiento y/o
                                Reparación</span>
                            <input type="radio" id="capacitacion" name="motivo_ingreso" value="Capacitación">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkMotivo">
                        <label for="noPropiedad" class="custom-checkbox">
                            <span class="labelMark" style="margin-right: 0.5em; min-width:225px; max-width:225px;">Por Ser
                                de su Propiedad</span>
                            <input type="radio" id="noPropiedad" name="motivo_ingreso"
                                value="Por Ser de su Propiedad">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkMotivo">
                        <label for="reunionExterna" class="custom-checkbox">
                            <span class="labelMark" style="margin-right: 0.5em; min-width:225px; max-width:225px;">Reunion
                                Externa</span>
                            <input type="radio" id="reunionExterna" name="motivo_ingreso" value="Reunion Externa">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkMotivo">
                        <label for="trabajoLaboral" class="custom-checkbox">
                            <span class="labelMark"
                                style="margin-right: 0.5em; min-width:225px; max-width:225px;">Realizar un Trabajo
                                Laboral</span>
                            <input type="radio" id="trabajoLaboral" name="motivo_ingreso"
                                value="Realizar un Trabajo Laboral">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkMotivo">
                        <label for="otrosMotiv" class="custom-checkbox">
                            <span class="labelMark"
                                style="margin-right: 0.5em; min-width:225px; max-width:225px;">Otros</span>
                            <input type="radio" id="otrosMotiv" name="motivo_ingreso" value="Otros">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="tableContainerPrin">
                <div class="tituloPrinDescripcion" style="margin-top:2em;">
                    <div class="tituloTamDescrip">
                        <div class="tituloDescripcion">
                            <h6>DESCRIPCIÓN DE EQUIPO DE COMPUTOS Y SUS ACCESORIOS</h6>
                        </div>
                    </div>
                    <div class="containerBtnAdd">
                        <button name="" id="btnTraerElementosfiltrados" class="btn btn-success"
                            data-bs-toggle="modal" data-bs-target="#modalFormSalidaIn">
                            <i class="fa-solid fa-plus" style="color: #fff;font-size:15px"></i>
                        </button>
                    </div>
                </div>
                <table id="TableDescripcionEquipos" class="table table-hover">
                    <thead>
                        <th>DESCRIPCIÓN</th>
                        <th>MARCA</th>
                        <th>MODELO</th>
                        <th>ID DISPOSITIVO</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="descripcionEquipo">
                                <div class="input-container">
                                    <label for="descripcionIngreso">DESCRIPCIÓN:</label>
                                    <input type="text" id="descripcionIngreso" name="descripcionIngreso">
                                </div>
                            </td>
                            <td id="marcaEquipo">{{ $elementos->marca ?? 'NO REGISTRA' }}</td>
                            <td id="modeloEquipo">{{ $elementos->modelo ?? 'NO APLICA' }}</td>
                            <td id="serialEquipo">{{ $elementos->id_dispo ?? 'NO REGISTRA' }}</td>
                            <td id="estadoEquipo">{{ $elementos->estado->estado ?? 'NO REGISTRA' }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @include('components.modal-form-salida-i-n')
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
@endsection
