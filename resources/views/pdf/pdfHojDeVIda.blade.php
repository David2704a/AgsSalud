<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOJA DE VIDA EQUIPOS TECNOLOGICOS</title>
    <link rel="stylesheet" href="{{ public_path('/css/pdf/pdfHojaDeVida.css') }}">
</head>

<body>

    <header>
        <div>
            <table class="table-header">
                <tr class="table-header">
                    <td rowspan="3" class="table-header"><img
                            src="{{ public_path('img/versión 1 Dos colores-Recuperado.png') }}" class="agsLogo">
                    </td>
                    <th colspan="2" class="table-header">TICS E INNOVACIÓN</th>
                    <td rowspan="2" class="table-header" id="alineacion">Fecha de modificación:
                        <br>02/01/2023
                    </td>
                </tr>
                <tr class="table-header">
                    <td colspan="2" class="table-header">CHECKLIST HOJAS DE VIDA EQUIPOS TECNOLOGICOS</td>
                </tr>
                <tr>
                    <td colspan="1" class="table-header" id="alineacion"><i><b>Código:</b> TEI-F-20</i> </td>
                    <td colspan="1" class="table-header" id="alineacion"><i><b>Versión:</b> 03</i> </td>
                    <td colspan="1" class="table-header" id="alineacion"><i><b>Página </b><span
                                class="page-number"></span> de 2</i> </td>
                </tr>
            </table>
            <hr>
        </div>
    </header>

    <footer>
        <img class="logos" src="{{ public_path('img/unnamed.png') }}">
    </footer>

    <main>

        <table>
            <tr>
                <th id="codigo">CODIGO DEL EQUIPO:</th>
                <th>{{ $elemento->id_dispo ?? 'NO APLICA' }}</th>
                <th id="serial">SERIAL DEL EQUIPO:</th>
            </tr>
        </table>
        <table>

            <tr id="border">
                <th id="codigo">CODIGO DEL CARGADOR:</th>

                <th>
                    @foreach ($elementos as $cargador)
                        @if ($cargador->categoria->nombre == 'CARGADOR PORTATIL' && $cargador->serial == $elemento->serial)
                            {{ $cargador->id_dispo }}
                        @endif
                    @endforeach

                </th>

                <th id="serial">{{ $elemento->serial ?? 'NO APLICA' }}</th>
            </tr>
        </table>
        <table>

            <tr id="border">
                <td colspan="6" class="separator"></td>
            </tr>
        </table>
        <table>
            <tr id="border">
                <th class="factura">Factura:</th>
                <td>{{ $elemento->factura->codigoFactura ?? 'NO APLICA' }}</td>
                <th class="fechacompra">Fecha de compra:</th>
                <td class="factura">{{ $elemento->factura->fechaCompra ?? 'NO APLICA' }}</td>
                <th class="fechacompra">Fecha de baja:</th>
                <td class="factura"></td>
            </tr>
        </table>
        <table>
            <tr id="border">
                <td colspan="6" class="separator"></td>
            </tr>
        </table>


        <table>
            <tbody>
                <tr id="border">
                    <th colspan="6">MANTENIMIENTOS PREVENTIVOS (DD/MM/AAAA)</th>
                </tr>
                <tr>
                    <th colspan="1" id="celda">TRIMESTRE</th>
                    <th colspan="1" id="date">FECHA</th>
                    <th colspan="4">RESPONSABLE DEL EQUIPO</th>
                </tr>
                <tr>
                    <td colspan="1">PRIMERO</td>
                    <td colspan="1"></td>
                    <td colspan="4">{{ $elemento->user->name ?? 'NO APLICA' }}</td>
                </tr>
                <tr>
                    <td colspan="1">SEGUNDO</td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="1">TERCERO</td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="1">CUARTO</td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr id="border">
                    <th colspan="6">MANTENIMIENTO CORRECTIVO O MODIFICACIONES DE HARDWARE EN EL EQUIPO (DD/MM/AAAA)
                    </th>
                </tr>
                <tr>
                    <td colspan="1" id="numero">Número</td>
                    <td colspan="1" id="fecha">Fecha</td>
                    <td colspan="4">DIAGNOSTICO U OBSERVACIÓN</td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="4"></td>
                </tr>
            </tbody>
        </table>
    </main>

    <div class="page-break">
    </div>

    <main>
        <table>
            <tr>
                <td colspan="6" class="celdas"><b>COMPROMISO:</b> Me comprometo a utilizar adecuadamente durante la
                    jornada laboral los elementos de trabajo recibidos y mantenerlos en buen estado, dándole uso
                    exclusivo para el desarrollo actividades propias del contrato. Declaro que he recibido información
                    sobre el uso adecuado de los mismos.
                    <br>NOTA: El colaborador será el responsable inmediato de los daños ocasionados al equipo de cómputo
                    y sus componentes, en caso de malas prácticas y no acatar las recomendaciones dadas por el proceso
                    de TICS e Innovación, en las políticas del buen uso de los recursos tecnológicos.
                </td>
            </tr>
            <tr>
                <th colspan="6">PRESTAMOS EQUIPO DE COMPUTO (DD, MM, AAAA)</th>
            </tr>
            <tr>
                <th colspan="3">PRESTAMO</th>
                <th colspan="3">DEVOLUCIÓN</th>
            </tr>
            <tr>
                <th colspan="1" id="fecha">FECHA</th>
                <th colspan="1" id="recibe">RECIBE</th>
                <th colspan="1" id="entrega">ENTREGA</th>
                <th colspan="1" id="fecha">FECHA</th>
                <th colspan="1" id="entrega">ENTREGA</th>
                <th colspan="1" id="recibe">RECIBE</th>
            </tr>

            <tr>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
            </tr>
            <tr>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
            </tr>
            <tr>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
            </tr>
            <tr>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
            </tr>
            <tr>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
            </tr>
            <tr>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
            </tr>
            <tr>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
                <th colspan="1"></th>
            </tr>
            <tr>
                <td colspan="6" id="observacion"><b>Observación:</td>
            </tr>
        </table>
    </main>

</body>

</html>
