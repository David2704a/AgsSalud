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
        {{-- <table id="table-identificacion-equipo" style="width: 100%; border-bottom:1px solid #fff">
            <tbody>
                <tr>
                    <td style="padding-right: 30px;">Fecha Salida:</td>
                    <td style="border-bottom:1px solid black; width: 70px; max-width:80px;"></td>
                    <td style="padding-right: 30px;">Hora: </td>
                    <td style="border-bottom:1px solid black; width: 70px; max-width:80px;"></td>                </tr>
            </tbody>
        </table> --}}

        <div id="fechas">
            <p>Fecha Salida: ______________</p>
            <p>Hora: ______________</p>
        </div>

        <div id="info-prestamo">
                <p><i>Prestamo temporal: </i><p><i>si ____</i></p> <p><i>no ____</i></p></p>
                <p><i>Desde: 12/02/2024</i></p><p><i>Hasta: </i></p>
        </div>
    </div>

     <p id="section-title">
        1. MOTIVO DE INGRESO Y/O SALIDA DE EQUIPOS DE COMPUTO
    </p>

    <section>
        <table id="tabla-casillas">
            <tr>
                <th>Mantenimiento y/o reparación</th>
                <th><div class="checkbox"></div></th>
                <th>Capacitación</th>
                <th><div class="checkbox"></div></th>
                <th>Por ser de su propiedad</th>
                <th><div class="checkbox"></div></th>
            </tr>

            <tr>
                <th>Reunión externa</th>
                <th><div class="checkbox"></div></th>
                <th>Realizar un trabajo laboral</th>
                <th><div class="checkbox"></div></th>
                <th>Otros</th>
                <th><div class="checkbox"></th>
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
                <td>NOMBRE: </td>
                <td>NOMBRE: </td>
            </tr>
            <tr>
                <td>CARGO:</td>
                <td>CARGO:</td>
            </tr>
            <tr>
                <td>IDENTIFICACIÓN:</td>
                <td>IDENTIFICACIÓN:</td>
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
                <th rowspan="2" style="width: 180px;">N° SERIAL</th>
                <th colspan="2">ESTADO</th>
            </tr>
            <tr>
                <th style="padding: 2px 0;">B</th>
                <th style="padding: 2px 0;">M</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
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