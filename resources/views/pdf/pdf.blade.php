<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF´s</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{public_path('css/pdf/pdfEquipos.css')}}">
</head>
<body id="body-pdf">
    <div id="border-content">
        <header>
            <table id="table-header">
                <thead>
                    <tr>
                        <th><img src="{{public_path('img/AgsPDFequipos.png')}}" width="100%" height="52"></th>
                        <th style="font-weight:normal;">
                            <div id="titles-header-pdf">
                                <p style="border-bottom: 1px solid black; padding:4px;">TICS E INNOVACIÓN</p>
                                <p style="border-bottom: 1px solid black; padding:2px; margin-top:-8px;">INGRESO Y SALIDA DE EQUIPOS DE CÓMPUTO</p>
                                    <div class="codigo-version">
                                        <span class="codigo1" style="display:inline-block; padding-right:12px;"><i>Codigo: TEI-F-08</i></span>
                                        <span class="version1" style="display:inline-block;"><i>Versión: 04</i></span>
                                    </div>
                            </div>
                        </th>
                        <th><span style="font-style: italic; padding: 5px;">Fecha de Modificación: 10/06/2021</span></th>
                    </tr>
                </thead>
            </table>
        </header>

    <div id="info-tiempo">


        <div id="fechas">
            <p>Fecha Salida: <u style="font-weight: normal;">{{$ingresoSalida->fecha_in_salida}}</u></p>
            <p>Hora: <u style="font-weight: normal;">{{$ingresoSalida->hora_in_salida}}</u></p>
        </div>

        <div id="info-prestamo">
                <p><i>Prestamo temporal:</i><p>
                <i>si <span style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;{{ $ingresoSalida->prestamo == 'SI' ? 'X' : ''}}</span></i></p>
                <p><i>no <span style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;{{ $ingresoSalida->prestamo == 'NO' ? 'X' : ''}}</span></i></p></p>
                <p><i>Desde: {{$ingresoSalida->fecha_in_salida}}</i></p> <p><i>Hasta: {{$ingresoSalida->fecha_fin_salida}}</i></p>
        </div>
    </div>

    <p id="section-title">
        1. MOTIVO DE INGRESO Y/O SALIDA DE EQUIPOS DE COMPUTO
    </p>

    <section>
        <table id="tabla-casillas">
            <tr>
                <th>Mantenimiento y/o reparación'</th>
                <th><div class="checkbox">{{ $ingresoSalida->motivo_ingreso == 'Mantenimiento y/o Reparación' ? 'X' : ''}}</div></th>
                <th>Capacitación</th>
                <th><div class="checkbox">{{ $ingresoSalida->motivo_ingreso == 'Capacitación' ? 'X' : ''}}</div></th>
                <th>Por ser de su propiedad</th>
                <th><div class="checkbox">{{ $ingresoSalida->motivo_ingreso == 'Por Ser de su Propiedad' ? 'X' : ''}}</div></th>
            </tr>
            <tr>
                <th>Reunión externa</th>
                <th><div class="checkbox">{{ $ingresoSalida->motivo_ingreso == 'Reunion Externa' ? 'X' : ''}}</div></th>
                <th>Realizar un trabajo laboral</th>
                <th><div class="checkbox">{{ $ingresoSalida->motivo_ingreso == 'Realizar un Trabajo Laboral' ? 'X' : ''}}</div></th>
                <th>Otros</th>
                <th><div class="checkbox">{{ $ingresoSalida->motivo_ingreso == 'Otros' ? 'X' : ''}}</th>
                </tr>
        </table>
    </section>

    <p id="section-title" style="margin-bottom: 12px;">
        2. DATOS GENERALES DE LOS RESPONSABLES
    </p>

    <table id="table-responsables">
        <thead>
            <tr>
                <th>PERSONA A QUIEN SE AUTORIZA</th>
                <th style="border-left:1px solid black;">PERSONA QUIEN AUTORIZA</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>NOMBRE: <span style="font-weight: normal;">{{$usuarioAutoriza->name}}</span></td>
                <td>NOMBRE: <span style="font-weight:normal;"></span></td>
            </tr>
            <tr>
                <td>CARGO: <span style="font-weight:normal;"></td>
                    <td>CARGO: <span style="font-weight:normal;"></td>
                    </tr>
                    <tr>
                        <td>IDENTIFICACIÓN: <span style="font-weight:normal;">{{$personaAutorizada->identificacion}}</span></td>
                        <td>IDENTIFICACIÓN: <span style="font-weight:normal;"></span></td>
                    </tr>
        </tbody>
    </table>

    <p id="section-title">
        3. DESCRIPCIÓN DE EQUIPO DE COMPUTOS Y SUS ACCESORIOS
    </p>

    <table id="table-descripcion">
        <thead>
            <tr>
                <th rowspan="2" style="width: 160px;">DESCRIPCIÓN</th>
                <th rowspan="2" style="width: 100px;">MARCA</th>
                <th rowspan="2" style="width: 80px;">MODELO</th>
                <th rowspan="2" style="width: 180px;">ID DISPOSITIVO</th>
                <th colspan="2">ESTADO</th>
            </tr>
            <tr>
                <th style="padding: 2px 0;">B</th>
                <th style="padding: 2px 0;">M</th>
            </tr>
        </thead>

        <tbody>

            @php
            $descripcionEquipos = [
                $ingresoSalida->descripcion_equipo_ingreso,
                $ingresoSalida->descripcion_equipo_ingreso_2,
                $ingresoSalida->descripcion_equipo_ingreso_3,
                $ingresoSalida->descripcion_equipo_ingreso_4,
                $ingresoSalida->descripcion_equipo_ingreso_5,
            ];
            @endphp

            @foreach ($elementos as $index => $elemento)
            <tr>
                <td>{{$descripcionEquipos[$index]}}</td>
                <td>{{$elemento->marca}}</td>
                <td>{{$elemento->modelo}}</td>
                <td>{{$elemento->id_dispo}}</td>
                <td>
                    {{ $elemento->estado_elemento == 'BUENO' ||  $elemento->estado_elemento == 'REGULAR' ||  $elemento->estado_elemento == 'DEVOLUCION' ||  $elemento->estado_elemento == 'NUEVO' ||  $elemento->estado_elemento == 'NUEVA' ? 'X' : ''}}
                </td>
                <td>
                    {{ $elemento->estado_elemento == 'BAJA' ||  $elemento->estado_elemento == 'MALO' ||  $elemento->estado_elemento == 'NO APLICA' ||  $elemento->estado_elemento == 'MALA' ||  $elemento->estado_elemento == 'PERDIDA' ||  $elemento->estado_elemento == 'NO HAY DATOS' ||  $elemento->estado_elemento == 'OBSOLETO' ? 'X' : ''}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



    <p id="section-title">
        4. FIRMA DE ENTREGA Y RECIBE EL ELEMENTO Y LEE EL COMPROMISO
    </p>

    <table id="table-firmas">
        <tr>
            <td colspan="2" style="padding: 10px 5px;">El trabajador que solicita el ingreso y salida del equipo de computo se compromete
                a utilizar adecuadamente el equipo dentro y fuera de las instalaciones de AGS SALUD SAS
                con el fin de salva guardar la información almacenada y el equipo fisico.
            </td>
        </tr>
        <tr>
            <tr>
                <th style="border-top:1px solid black; border-right:1px solid black; padding-bottom:60px;">SOLICITADO POR:</th>
                <th style="border-top:1px solid black; padding-bottom:60px;">AUTORIZADO POR:</th>
            </tr>
            <tr>
                <td style="text-align:center; border-right:1px solid black;">
                    <div class="text-success">
                        <hr class="border border-primary border-1 opacity-75" width="252px" style="padding: 1px; margin: 2px auto;">
                    </div>
                    <p style="font-weight: bold;">TRABAJADOR Y/O PRACTICANTE</p>
                </td>
                <td style="text-align:center">
                    <div class="text-success">
                        <hr class="border border-primary border-1 opacity-75" width="252px" style="padding: 1px; margin: 2px auto;">
                    </div>
                    <p style="font-weight: bold;">RESPONSABLE GESTIÓN TECNOLOGICA</p>
                </td>
            </tr>

        </tr>
    </table>

    <p id="section-title">
        5. DEVOLUCIÓN DEL EQUIPO
    </p>

    <p style="border-bottom: 1px solid black; padding-left:4px;">Fecha de ingreso:</p>
    <div style="height: 90px">
        <table id="table-devolucion">
            <tbody style="margin: 0;">
                <tr>
                    <th style="">
                        <p style="border-bottom:1px solid black;">ENTREGA:</p>
                        <div style="padding-top: 40px;">
                            <div class="text-success">
                                <hr class="border border-primary border-1 opacity-75" width="252px" style="padding: 1px; margin: 2px auto;">
                            </div>
                            <p style="font-weight: bold; padding: 0; margin: 0;">TRABAJADOR Y/O PRACTICANTE</p>
                            </div>
                    </th>
                    <th>
                        <p style="border-bottom:1px solid black">RECIBE:</p>
                        <div style="padding-top: 40px;">
                            <div class="text-success">
                                <hr class="border border-primary border-1 opacity-75" width="252px" style="padding: 1px; margin: 2px auto;">
                            </div>
                        <p style="font-weight: bold; padding: 0; margin: 0;">RESPONSABLE GESTIÓN TECNOLOGICA</p>
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>