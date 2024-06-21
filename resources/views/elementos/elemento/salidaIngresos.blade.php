@extends('layouts.app')

@section('title', 'Elemento')

@section('links')

    <link rel="stylesheet" href="{{ asset('/css/elemento/elemento.css') }}">
    <script src="{{ asset('js/elemento/elemento.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

@endsection
@section('content')

    <div class="content2">

        <div class="content" style="text-align: center">
            <h1 class="page-title">FORMULARIO DE INGRESO Y / O SALIDA</h1>
            <div class="green-line" style="width: 30em"></div>
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
                        <input type="text" id="nameUserAutorizado" name="name" value="{{$elementos->user->name}}">
                    </div>
                    <div class="input-container">
                        <label for="position">CARGO:</label>
                        <input type="text" id="cargoUserAutorizado" name="position">
                    </div>
                    <div class="input-container">
                        <label for="id">IDENTIFICACIÓN:</label>
                        <input type="text" id="identiUserAutorizado" name="id" value="{{$elementos->user->persona->identificacion}}">
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
                        <input type="text" id="nameUserAutoriza" name="name">
                    </div>
                    <div class="input-container">
                        <label for="position">CARGO:</label>
                        <input type="text" id="cargoUserAutoriza" name="position">
                    </div>
                    <div class="input-container">
                        <label for="id">IDENTIFICACIÓN:</label>
                        <input type="text" id="identiUserAutoriza" name="id">
                    </div>
                </div>
            </div>
            <div class="tiemposDeAccionFecha">
                <div class="tituloPrin">
                    <div class="tituloFechas">
                        <h6>FECHA DE INGRESO Y / O SALIDA</h6>
                    </div>
                </div>

                <div class="containerInputs">
                    <div class="input-container">
                        <label for="date">FECHA:</label>
                        <input type="date" id="date" name="date">
                    </div>
                    <div class="input-container">
                        <label for="time">HORA:</label>
                        <input type="time" id="time" name="time">
                    </div>
                    <div class="prestamoTemporal">
                        <div class="titlePrestamosTemp">
                            <h6>PRESTAMO TEMPORAL</h6>
                        </div>
                        <div class="checkbox-container">
                            <div class="checkPrestamoSi">
                                <label for="prestamo_si">SI</label>
                                <input type="checkbox" id="prestamo_si" name="prestamo" value="si">
                            </div>
                            <div class="checkPrestamoNo">
                                <label for="prestamo_no">NO</label>
                                <input type="checkbox" id="prestamo_no" name="prestamo" value="no">
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
                                    <input type="date" id="fechaInSalida" name="date">
                                </div>
                                <div class="input-container">
                                    <label for="position">HASTA</label>
                                    <input type="date" id="fechaFinSalida" name="position">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="motivoIngresoSalida">

                <div class="tituloPrinMotivo">
                    <div class="tituloMotivo">
                        <h6>MOTIVO DE INGRESO Y / O SALIDA DE EQUIPOS DE COMPUTO</h6>
                    </div>
                </div>

                <div class="checkbox-containerMotivo">
                    <div class="checkMotivo">
                        <label for="mantenimientoRep">Mantenimiento y/o Reparación</label>
                        <input type="checkbox" id="mantenimientoRep" name="prestamo" value="si">
                    </div>
                    <div class="checkMotivo">
                        <label for="capacitacion">Capacitación</label>
                        <input type="checkbox" id="capacitacion" name="prestamo" value="si">
                    </div>
                    <div class="checkMotivo">
                        <label for="noPropiedad">Por Ser de su Propiedad</label>
                        <input type="checkbox" id="noPropiedad" name="prestamo" value="si">
                    </div>
                    <div class="checkMotivo">
                        <label for="reunionExterna">Reunion Externa</label>
                        <input type="checkbox" id="reunionExterna" name="prestamo" value="si">
                    </div>
                    <div class="checkMotivo">
                        <label for="trabajoLaboral">Realizar un Trabajo Laboral</label>
                        <input type="checkbox" id="trabajoLaboral" name="prestamo" value="si">
                    </div>
                    <div class="checkMotivo">
                        <label for="otrosMotiv">Otros</label>
                        <input type="checkbox" id="otrosMotiv" name="prestamo" value="si">
                    </div>
                </div>
            </div>

{{-- --------------------------------------------- --}}

            <table id="table-descripcion" class="table">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 100px;">DESCRIPCIÓN</th>
                        <th rowspan="2" style="width: 100px;">MARCA</th>
                        <th rowspan="2" style="width: 100px;">MODELO</th>
                        <th rowspan="2" style="width: 100px;">N° SERIAL</th>
                        <th colspan="2" style="width: 100px;">ESTADO</th>
                    </tr>
                    <tr>
                        <th style="padding: 2px 0; width: 100px;">B</th>
                        <th style="padding: 2px 0; width: 100px;">M</th>
                    </tr>
                </thead>
        
                <tbody>
                    <tr>
                        {{-- <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td> --}}
                        <td>{{$elementos->descripcion}}</td>
                        <td>{{$elementos->marca}}</td>
                        <td>{{$elementos->modelo}}</td>
                        <td>{{$elementos->serial}}</td>
                        @if($elementos->estado)
                        @if ($elementos->estado->estado == 'BUENO')
                            <td>{{$elementos->estado->estado}}</td>
                            <td></td>
                        @elseif($elementos->estado->estado == 'MALO')
                            <td>{{$elementos->estado->estado}}</td>
                            <td></td>
                        @endif  
                        @else
                            <td colspan="2">Sin Estado</td>
                        @endif
                    </tr>
                </tbody>
            </table>

            <br><br>
            <a class="btn btn-success" href="{{route('pdf.view', $elementos->idElemento)}}">Generar PDF</a>


            


{{-- -------------------------------------------------- --}}
        

        </div>

    </div>



@endsection
