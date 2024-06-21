<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registro de Préstamo de Dispositivos</title>
    <style>
        @page {
            margin: 1.6cm 1.2cm;
        }
        body {
            font-family: "Roboto", sans-serif;
            /* font-family:"Calibri", sans-serif; */
            /* font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; */
            font-size: 12px;
            padding: 0;
            margin: 0;
        }

        .header {
            position: relative;
            top: -10em;
            width: 100%;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 150px;
        }

        .table {
            width: 70%;
            border-collapse: collapse;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid rgb(107, 107, 107);
        }

        .table th {
            font-weight: 400;
            background-color: #1F4E78;
            color: #fff;
            font-size: 11px;
            /* padding: 4.5px */
            padding: 1px 4.5px 1px 4.5px
        }

        .table th,
        .table td {
            text-align: center;
        }

        .table td {
            padding: 5px;
            font-size: 10px;
        }

        .logos img {
            width: 100px;
            margin: 10px;
        }

        .logos {
            display: flex;
            justify-content: space-between;
        }

        .page {
            /* page-break-after: always; Forzar salto de página después de cada .page */
            position: relative;
            /* Asegura que cada página comience desde la posición inicial */
            top: 0;
            left: 0;
            max-width: 100%;
            /* page-break-inside: avoid; */
            /* margin-bottom: 2cm; Espacio entre cada página */
        }
    </style>
</head>

<body>
    @php
        $colección = collect($objetos); // Convierte $objetos en una colección de Laravel
        $chunkedProcedimientos = $colección->chunk(5); // Divide los registros en grupos de 5
    @endphp

    @foreach ($chunkedProcedimientos as $chunk)
        <div class="page">
            <div class="header">
                <div class="img_logo"
                    style="width:14.3em; height: 4.9em; position: relative; right: 0em; top: 8em; border: 1px solid rgb(107, 107, 107)">
                    <img width="70" style="width:130px; margin:0.1em;"
                        src="{{ public_path('imgs/logos/ags-export.png') }}" alt="Logo AGSalud">
                </div>
                <div class="titulos_central">
                    <div class="tituloP"
                        style="width: 56em; height: 1.87em; position: relative; top:4.2em; left:10.8em; border:1px solid rgb(107, 107, 107); border-bottom:none; border-right:none;">
                        <h2 style="font-size: 9.5px; font-weight: 400; margin-top: 0.5em;">TICS E INNOVACIÓN</h2>
                    </div>
                    <div class="tituloS"
                        style="width: 56em; height: 1.87em; position: relative; top:3.76em; left:10.8em; border:1px solid rgb(107, 107, 107); border-bottom:none; border-right:none;">
                        <h3 style="font-size: 9.5px; font-weight: 400; margin-top: 0.5em;">REGISTRO PRÉSTAMO DE
                            DISPOSITIVOS TECNOLÓGICOS</h3>
                    </div>
                    <div class="subtitulo1"
                        style="width: 34.64em; height:1em; position:relative; top:3.1em; left:10.8em; border: 1px solid rgb(107, 107, 107);border-right:none;">
                        <p style="font-size: 8.5px;font-style: italic; margin-top: 0.1em;">Código: TEI-F-06</p>
                    </div>
                    <div class="subtitulo2"
                        style="width: 21.26em; height:1em; position:relative; top:2.22em; left:36.79em; border: 1px solid rgb(107, 107, 107); border-right:none;">
                        <p style="font-size: 8.5px; font-style: italic; margin-top: 0.1em;">Versión: 03</p>
                    </div>
                </div>
                <div class="fecha_modificacion"
                    style="width: 9.75em; height:4.9em; position:relative; top:-1.58em; left:52.8em; border: 1px solid rgb(107, 107, 107)">
                    <p style="font-size: 8.5px; font-style: italic; margin: 1.5em;">Fecha de Modificación: 10/06/2021
                    </p>
                </div>
            </div>

            <div class="tabla_prestamo" style="max-width:400px;position: relative; top: -11em;">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>FECHA DE PRÉSTAMO</th>
                            <th>DISPOSITIVO</th>
                            <th>CANTIDAD</th>
                            <th>CARACTERÍSTICAS</th>
                            <th>ESTADO</th>
                            <th>ENTREGA</th>
                            <th>RECIBE</th>
                            <th>FECHA DE DEVOLUCIÓN</th>
                            <th>ENTREGA</th>
                            <th>RECIBE</th>
                            <th>OBSERVACIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chunk as $procedimiento)
                            <tr>
                                <td style="width:75.855px; hyphens: auto; word-break: break-word;" class="fechaInicio">
                                    {{ $procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica' }}
                                </td>
                                <td style="width:75.9px; hyphens: auto; word-break: break-word;" class="id_dispo">
                                    {{ $procedimiento->id_dispo ? $procedimiento->id_dispo : 'NO APLICA' }}
                                </td>
                                <td style="width:30px; hyphens: auto; word-break: break-word;" class="cantidad">
                                    1
                                </td>
                                <td style="width: 125px; hyphens: auto; word-break: break-word;" class="categoria">
                                    {{ $procedimiento->nameCategoria }}
                                </td>
                                <td style="hyphens: auto; word-break: break-word;" class="estado">
                                    {{ $procedimiento->estado ? $procedimiento->estado : 'NO APLICA' }}
                                </td>
                                <td style="width: 73px; hyphens: auto; word-break: break-word;" class="nameEntrega">
                                    {{ $procedimiento->nameEntrega ? $procedimiento->nameEntrega : 'NO APLICA' }}
                                </td>
                                <td style="width: 70px; hyphens: auto; word-break: break-word;" class="nameRecibe">
                                    {{ $procedimiento->nameRecibe ? $procedimiento->nameRecibe : 'NO APLICA' }}
                                </td>
                                <td style="width: 50px; hyphens: auto; word-break: break-word;" class="fechaFin">
                                    {{ $procedimiento->fechaFin ? $procedimiento->fechaFin : 'NO APLICA' }}
                                </td>
                                <td style="width: 73px; hyphens: auto; word-break: break-word;" class="nameRecibeDev">
                                    {{ $procedimiento->nameRecibeDev ? $procedimiento->nameRecibeDev : 'NO APLICA' }}
                                </td>
                                <td style="width: 71px; hyphens: auto; word-break: break-word;" class="nameEntregaDev">
                                    {{ $procedimiento->nameEntregaDev ? $procedimiento->nameEntregaDev : 'NO APLICA' }}
                                </td>
                                <td style="width: 108px;hyphens: auto; word-break: break-word;" class="break-line">
                                    {{ $procedimiento->observacion ? $procedimiento->observacion : 'NO APLICA' }}
                                </td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td colspan="11">

                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            {{-- <div class="logos" style="width: 99.4%; height: 4.9px position: relative;">
                <img src="{{ public_path('imgs/logos/logosPrestamos.png') }}" alt="LOGO-AGS"
                    style="width: 29em; margin-left: 10em;">
            </div> --}}

            <div class="logos" style="width: 99.76%; height:4.9em; position: relative; top: -11em; border: 1px solid rgb(107, 107, 107); border-top:none;">
                <img src="{{ public_path('imgs/logos/logosPrestamos.png') }}" alt="LOGO-AGS" style="width: 25em; margin-left: 29em; position: relative; top:-0.5em" >
            </div>
        </div>
    @endforeach
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const cells = document.querySelectorAll('.break-line');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{14})/g, '$1\u100B');
            });
            const fechaInicio = document.querySelectorAll('.fechaInicio');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
            const id_dispo = document.querySelectorAll('.id_dispo');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
            const cantidad = document.querySelectorAll('.cantidad');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
            const categoria = document.querySelectorAll('.categoria');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
            const estado = document.querySelectorAll('.estado');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
            const nameEntrega = document.querySelectorAll('.nameEntrega');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
            const nameRecibe = document.querySelectorAll('.nameRecibe');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
            const fechaFin = document.querySelectorAll('.fechaFin');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
            const nameRecibeDev = document.querySelectorAll('.nameRecibeDev');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
            const nameEntregaDev = document.querySelectorAll('.nameEntregaDev');
            cells.forEach(cell => {
                const text = cell.innerHTML;
                cell.innerHTML = text.replace(/(.{18})/g, '$1\u100B');
            });
        });
    </script>
</body>

</html>
