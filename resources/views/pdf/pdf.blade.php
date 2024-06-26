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
            @foreach ($datos as $dato)
            <p>Fecha Salida: <u style="font-weight: normal;">{{ $dato->fecha_in_salida}}</u></p>
            <p>Hora: <u style="font-weight: normal;">{{ $dato->hora_in_salida}}</u></p>
            <p>Fecha Salida: <u style="font-weight: normal;">{{$fechaFinSalida}}</u></p>
            <p>Hora: <u style="font-weight: normal;">{{$horaInicioIngreso}}</u></p>
              
        </div>

        <div id="info-prestamo">
                <p><i>Prestamo temporal:</i><p>
                <i>si <span style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;{{ $prestamo == 'SI' ? 'X' : ''}}</span></i></p>
                <p><i>no <span style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;{{ $prestamo == 'NO' ? 'X' : ''}}</span></i></p></p>
                <p><i>Desde: {{$fechaInicioIngreso}}</i></p> <p><i>Hasta: {{$fechaFinSalida}}</i></p>
        </div>
    </div>

     <p id="section-title">
        1. MOTIVO DE INGRESO Y/O SALIDA DE EQUIPOS DE COMPUTO
    </p>

    <section>
        <table id="tabla-casillas">
            <tr>
                {{-- <th><div class="checkbox"></div></th>
                <th>Mantenimiento y/o reparación</th>
                <th><div class="checkbox"></div></th>
                <th>Capacitación</th>
                <th><div class="checkbox"></div></th>
                <th>Por ser de su propiedad</th>
                <th><div class="checkbox"></div></th>
                <th></th> --}}
                <th>Mantenimiento y/o reparación'</th>
                <th><div class="checkbox">{{ $motivoIngreso == 'Mantenimiento y/o Reparación' ? 'X' : ''}}</div></th>
                <th>Capacitación</th>
                <th><div class="checkbox">{{ $motivoIngreso == 'Capacitación' ? 'X' : ''}}</div></th>
                <th>Por ser de su propiedad</th>
                <th><div class="checkbox">{{ $motivoIngreso == 'Por Ser de su Propiedad' ? 'X' : ''}}</div></th>
            </tr>
            <tr>
                <th>Reunión externa</th>
                <th><div class="checkbox">{{ $motivoIngreso == 'Reunion Externa' ? 'X' : ''}}</div></th>
                <th>Realizar un trabajo laboral</th>
                <th><div class="checkbox">{{ $motivoIngreso == 'Realizar un Trabajo Laboral' ? 'X' : ''}}</div></th>
                <th>Otros</th>
                <th><div class="checkbox">{{ $motivoIngreso == 'Otros' ? 'X' : ''}}</th>
                    {{-- <th><div class="checkbox"></div></th>
                    <th>Reunión externa</th>
                    <th><div class="checkbox"></div></th>
                    <th>Realizar un trabajo laboral</th>
                    <th><div class="checkbox"></div></th>
                    <th>Otros</th>
                    <th><div class="checkbox"></div></th>
                    <th></th> --}}
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
                <td>NOMBRE: <span style="font-weight: normal;">{{$usuarioAutoriza}}</span></td>
                <td>NOMBRE: <span style="font-weight:normal;"></span></td>
            </tr>
            <tr>
                <td>CARGO: <span style="font-weight:normal;"></td>
                    <td>CARGO: <span style="font-weight:normal;"></td>
                    </tr>
                    <tr>
                        <td>IDENTIFICACIÓN: <span style="font-weight:normal;">{{$idenAutorizado}}</span></td>
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
            <tr>
                <td>{{ $descripcionIngreso }}</td>
                <td>{{$marca}}</td>
                <td>{{$modelo}}</td>
                <td>{{$id_dispo}}</td>
                <td>
                    {{ $estadoElemento == 'BUENO' ||  $estadoElemento == 'REGULAR' ||  $estadoElemento == 'DEVOLUCION' ||  $estadoElemento == 'NUEVO' ||  $estadoElemento == 'NUEVA' ? 'X' : ''}}
                </td>             
                <td>
                    {{ $estadoElemento == 'BAJA' ||  $estadoElemento == 'MALO' ||  $estadoElemento == 'NO APLICA' ||  $estadoElemento == 'MALA' ||  $estadoElemento == 'PERDIDA' ||  $estadoElemento == 'NO HAY DATOS' ||  $estadoElemento == 'OBSOLETO' ? 'X' : ''}}
                </td> 
            </tr>
            @foreach ($elementos as $elemento)
            <tr>
                <td>{{ $descripcionIngreso }}</td>
                <td>{{ $elemento['marca'] }}</td>
                <td>{{ $elemento['modelo'] }}</td>
                <td>{{ $elemento['id_dispo'] }}</td>
                <td>
                    {{ $elemento['estadoElemento'] == 'BUENO' ||  $elemento['estadoElemento'] == 'REGULAR' ||  $elemento['estadoElemento'] == 'DEVOLUCION' ||  $elemento['estadoElemento'] == 'NUEVO' ||  $elemento['estadoElemento'] == 'NUEVA' ? 'X' : ''}}
                </td>             
                <td>
                    {{ $elemento['estadoElemento'] == 'BAJA' ||  $elemento['estadoElemento'] == 'MALO' ||  $elemento['estadoElemento'] == 'NO APLICA' ||  $elemento['estadoElemento'] == 'MALA' ||  $elemento['estadoElemento'] == 'PERDIDA' ||  $elemento['estadoElemento'] == 'NO HAY DATOS' ||  $elemento['estadoElemento'] == 'OBSOLETO' ? 'X' : ''}}
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






{{--<!DOCTYPE html>
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
            @foreach ($data as $dato)
            <p>Fecha Salida: <u style="font-weight: normal;">{{ }}</u></p>
            <p>Hora: <u style="font-weight: normal;">{{ $dato->hora_in_salida}}</u></p>
                
        </div>

        <div id="info-prestamo">
                <p><i>Prestamo temporal:</i><p>
>>>>>>> 1afc44751871857dae880d960459598984d9fc1f
                <i>si <span style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;{{ $dato->prestamo == 'SI' ? 'X' : ''}}</span></i></p>
                <p><i>no <span style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;{{ $dato->prestamo == 'NO' ? 'X' : ''}}</span></i></p></p>
                <p><i>Desde: {{ $dato->fecha_in_salida}}</i></p> <p><i>Hasta: {{ $dato->fecha_fin_salida}}</i></p>
        </div>
    </div>

     <p id="section-title">
        1. MOTIVO DE INGRESO Y/O SALIDA DE EQUIPOS DE COMPUTO
    </p>

    <section>
        <table id="tabla-casillas">
            <tr>
                <th>Mantenimiento y/o reparación'</th>
                <th><div class="checkbox">{{ $dato->motivo_ingreso == 'Mantenimiento y/o Reparación' ? 'X' : ''}}</div></th>
                <th>Capacitación</th>
                <th><div class="checkbox">{{ $dato->motivo_ingreso == 'Capacitación' ? 'X' : ''}}</div></th>
                <th>Por ser de su propiedad</th>
                <th><div class="checkbox">{{ $dato->motivo_ingreso == 'Por Ser de su Propiedad' ? 'X' : ''}}</div></th>
            </tr>
            <tr>
                <th>Reunión externa</th>
                <th><div class="checkbox">{{ $dato->motivo_ingreso == 'Reunion Externa' ? 'X' : ''}}</div></th>
                <th>Realizar un trabajo laboral</th>
                <th><div class="checkbox">{{ $dato->motivo_ingreso == 'Realizar un Trabajo Laboral' ? 'X' : ''}}</div></th>
                <th>Otros</th>
                <th><div class="checkbox">{{ $dato->motivo_ingreso == 'Otros' ? 'X' : ''}}</th>
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
                <td>NOMBRE: <span style="font-weight: normal;">{{ $dato->nombre_usuario}} {{ $dato->nombre_usuario2}} {{ $dato->apellido1}} {{ $dato->apellido2}}</span></td>
                <td>NOMBRE: <span style="font-weight:normal;"></span></td>
            </tr>
            <tr>
                <td>CARGO: <span style="font-weight:normal;"></td>
                <td>CARGO: <span style="font-weight:normal;"></td>
            </tr>
            <tr>
                <td>IDENTIFICACIÓN: <span style="font-weight:normal;">{{ $dato->identificacion_usuario}}</span></td>
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
            <tr>
                <td>{{ $dato->descripcion_equipo_ingreso}}</td>
                <td>{{ $dato->marca1}}</td>
                <td>{{ $dato->modelo1}}</td>
                <td>{{ $dato->id_dispo1}}</td>
                <td>
                    {{ $dato->estado1 == 'BUENO' ||  $dato->estado1 == 'REGULAR' ||  $dato->estado1 == 'DEVOLUCION' ||  $dato->estado1 == 'NUEVO' ||  $dato->estado1 == 'NUEVA' ? 'X' : ''}}
                </td>             
                <td>
                    {{ $dato->estado1 == 'BAJA' ||  $dato->estado1 == 'MALO' ||  $dato->estado1 == 'NO APLICA' ||  $dato->estado1 == 'MALA' ||  $dato->estado1 == 'PERDIDA' ||  $dato->estado1 == 'NO HAY DATOS' ||  $dato->estado1 == 'OBSOLETO' ? 'X' : ''}}
                </td>
            </tr>
            <tr>     
                <td>{{ $dato->descripcion_equipo_ingreso_2}}</td>
                <td>{{ $dato->marca2}}</td>
                <td>{{ $dato->modelo2}}</td>
                <td>{{ $dato->id_dispo2}}</td>
                <td>
                    {{ $dato->estado2 == 'BUENO' ||  $dato->estado2 == 'REGULAR' ||  $dato->estado2 == 'DEVOLUCION' ||  $dato->estado2 == 'NUEVO' ||  $dato->estado2 == 'NUEVA' ? 'X' : ''}}
                </td>             
                <td>
                    {{ $dato->estado2 == 'BAJA' ||  $dato->estado2 == 'MALO' ||  $dato->estado2 == 'NO APLICA' ||  $dato->estado2 == 'MALA' ||  $dato->estado2 == 'PERDIDA' ||  $dato->estado2 == 'NO HAY DATOS' ||  $dato->estado2 == 'OBSOLETO' ? 'X' : ''}}
                </td>
            </tr>
            <tr>
                <td>{{ $dato->descripcion_equipo_ingreso_3}}</td>
                <td>{{ $dato->marca3}}</td>
                <td>{{ $dato->modelo3}}</td>
                <td>{{ $dato->id_dispo3}}</td>
                <td>
                    {{ $dato->estado3 == 'BUENO' ||  $dato->estado3 == 'REGULAR' ||  $dato->estado3 == 'DEVOLUCION' ||  $dato->estado3 == 'NUEVO' ||  $dato->estado3 == 'NUEVA' ? 'X' : ''}}
                </td>             
                <td>
                    {{ $dato->estado3 == 'BAJA' ||  $dato->estado3 == 'MALO' ||  $dato->estado3 == 'NO APLICA' ||  $dato->estado3 == 'MALA' ||  $dato->estado3 == 'PERDIDA' ||  $dato->estado3 == 'NO HAY DATOS' ||  $dato->estado3 == 'OBSOLETO' ? 'X' : ''}}
                </td>
            </tr>
            <tr>
                <td>{{ $dato->descripcion_equipo_ingreso_4}}</td>
                <td>{{ $dato->marca4}}</td>
                <td>{{ $dato->modelo4}}</td>
                <td>{{ $dato->id_dispo4}}</td>
                <td>
                    {{ $dato->estado4 == 'BUENO' ||  $dato->estado4 == 'REGULAR' ||  $dato->estado4 == 'DEVOLUCION' ||  $dato->estado4 == 'NUEVO' ||  $dato->estado4 == 'NUEVA' ? 'X' : ''}}
                </td>             
                <td>
                    {{ $dato->estado4 == 'BAJA' ||  $dato->estado4 == 'MALO' ||  $dato->estado4 == 'NO APLICA' ||  $dato->estado4 == 'MALA' ||  $dato->estado4 == 'PERDIDA' ||  $dato->estado4 == 'NO HAY DATOS' ||  $dato->estado4 == 'OBSOLETO' ? 'X' : ''}}
                </td>
            </tr>
        </tbody>
    </table>

    @endforeach


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
<<<<<<< HEAD
</html>
=======
</html> --}}
>>>>>>> 1afc44751871857dae880d960459598984d9fc1f
