<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACTA DE ENTREGA DE EQUIPOS TEGNOLOGICOS
    </title>
    <link rel="stylesheet" href="{{ public_path('/css/pdf/pdfActa.css') }}">
</head>
    <body>
        <table id="table">
            <tbody id="head">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <tbody id="body">
                <tr>
                    <th rowspan="3" colspan="3"><img src="{{ public_path('img/versión 1 Dos colores-Recuperado.png') }}" class="agsLogo"></th>
                    <th colspan="14">TICS E INNOVACIÓN</th>
                    <th rowspan="3" colspan="3">
                        <p>Fecha de modificacion:</p>
                        <p>02/01/2023</p>
                    </th>
                </tr>
                <tr>
                    <th colspan="14">ACTA DE ENTREGA DE EQUIPOS TEGNOLOGICOS</th>
                </tr>
                <tr>
                    <th colspan="7"><i><b>Código:</b> TEI-F-17</i> </th>
                    <th colspan="7"><i><b>Version:</b> 04</i> </th>
                </tr>
                <tr>
                    <th colspan="20" class="separator"></th>
                </tr>
                <tr>
                    <th colspan="20" class="fondo">1. INSTRUCCIONES</th>
                </tr>
                <tr>
                    <td colspan="20">
                        <p>Hoy XXX de XXXX del 2023, Con el ánimo de formalizar la entrega de los dispositivos tecnológicos peroféricos de trabajo para el desarrollo de las actividades laborales, le solicitamos diligenciar completamente la presente Acta. En ella se debe relacionar los asuntos de su competencia y el estado de cada uno de ellos. Para los casos de Terminación de Contrato o Retiro Voluntario, el colaborador debe hacer entrega al proceso de Gestión TICS e Innovación los recursos asignados y la presente acta, pues este será requisito indispensable para la firma del paz y salvo solicitado desde el proceso de talento humano. </p>
                    </td>
                </tr>
                <tr>
                    <th colspan="20" class="fondo">2. DATOS GENERALES DEL TRABAJADOR</th>
                </tr>
                <tr>
                    <td colspan="2"><b>NOMBRE:</b></td>
                    <td colspan="8">{{$elemento->user->name}}</td>
                    <td colspan="4"><b>CEDULA:</b></td>
                    <td colspan="6">{{$elemento->user->persona->identificacion}}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>CARGO:</b></td>
                    <td colspan="8"></td>
                    <td colspan="4"><b>DIRECCIÓN:</b></td>
                    <td colspan="6">{{$elemento->user->persona->direccion}}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>PROCESO:</b></td>
                    <td colspan="8"></td>
                    <td colspan="4"><b>TELÉFONO:</b></td>
                    <td colspan="6">{{$elemento->user->persona->celular}}</td>
                </tr>
                <tr>
                    <th colspan="20" class="fondo">3. DESCRIPCIÓN DE LA ENTREGA</th>
                </tr>
                <tr>
                    <th colspan="4">DISPOSITIVO TECNOLÓGICO</th>
                    <th colspan="2">FECHA ENTREGA</th>
                    <th colspan="2">ESTADO DE ENTREGA</th>
                    <th colspan="12">OBSERVACIÓN</th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2"></th>
                    <th colspan="1">B</th>
                    <th colspan="1">R</th>
                    <th colspan="12"></th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2"></th>
                    <th colspan="1">B</th>
                    <th colspan="1">R</th>
                    <th colspan="12"></th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2"></th>
                    <th colspan="1">B</th>
                    <th colspan="1">R</th>
                    <th colspan="12"></th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2"></th>
                    <th colspan="1">B</th>
                    <th colspan="1">R</th>
                    <th colspan="12"></th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2"></th>
                    <th colspan="1">B</th>
                    <th colspan="1">R</th>
                    <th colspan="12"></th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2"></th>
                    <th colspan="1">B</th>
                    <th colspan="1">R</th>
                    <th colspan="12"></th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th colspan="2"></th>
                    <th colspan="1">B</th>
                    <th colspan="1">R</th>
                    <th colspan="12"></th>
                </tr>
                <tr>
                    <th colspan="20" class="separator"></th>
                </tr>
                <tr>
                    <th colspan="20" class="fondo">4. CONTROL DE CAMBIOS Y NOVEDADES</th>
                </tr>
                <tr>
                    <th colspan="12" class="fondo">DEVOLUCIÓN</th>
                    <th colspan="8" class="fondo">NUEVA ENTREGA</th>
                </tr>
                <tr>
                    <th colspan="4">DISPOSITIVOS TECNOLÓGICOS PERIFÉRICOS DEVUELTOS</th>
                    <th colspan="2">FECHA</th>
                    <th colspan="2">ESTADO DE DEVOLUCION</th>
                    <th colspan="4">MOTIVO DE DEVOLUCIÓN Y/O CAMBIO</th>
                    <th colspan="4">DESCRIPCIÓN DE LOS DISPOSITIVOS TECNOLÓGICOS ENTREGADOS</th>
                    <th colspan="2">FECHA DE ENTREGA</th>
                    <th colspan="2">ESTADO DE ENTREGA</th>
                </tr>
            </tbody>
        </table>

        <table id="table">
            <tbody id="body">
                <tr>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="2">B</th>
                    <th colspan="2">R</th>
                    <th colspan="2">M</th>
                    <th colspan="12"></th>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="3">B</th>
                    <th colspan="3">R</th>
                </tr>
                <tr>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="2">B</th>
                    <th colspan="2">R</th>
                    <th colspan="2">M</th>
                    <th colspan="12"></th>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="3">B</th>
                    <th colspan="3">R</th>
                </tr>
                <tr>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="2">B</th>
                    <th colspan="2">R</th>
                    <th colspan="2">M</th>
                    <th colspan="12"></th>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="3">B</th>
                    <th colspan="3">R</th>
                </tr>
                <tr>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="2">B</th>
                    <th colspan="2">R</th>
                    <th colspan="2">M</th>
                    <th colspan="12"></th>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="3">B</th>
                    <th colspan="3">R</th>
                </tr>
                <tr>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="2">B</th>
                    <th colspan="2">R</th>
                    <th colspan="2">M</th>
                    <th colspan="12"></th>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="3">B</th>
                    <th colspan="3">R</th>
                </tr>
                <tr>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="2">B</th>
                    <th colspan="2">R</th>
                    <th colspan="2">M</th>
                    <th colspan="12"></th>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="3">B</th>
                    <th colspan="3">R</th>
                </tr>
                <tr>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="2">B</th>
                    <th colspan="2">R</th>
                    <th colspan="2">M</th>
                    <th colspan="12"></th>
                    <th colspan="12"></th>
                    <th colspan="6"></th>
                    <th colspan="3">B</th>
                    <th colspan="3">R</th>
                </tr>
                <tr class="headt">                     
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                </tr>
            </tbody>
        </table>
        <table id="table" style="border-bottom: 1px black solid;">
            <tbody id="body">      
                <tr>
                    <th colspan="20" class="fondo">5. COMPROMISO</th>
                </tr>
                <tr>
                    <td colspan="20"> <p id="text">Me comprometo a utilizar adecuadamente durante la jornada laboral los elementos de trabajo recibidos y mantenerlos en buen estado, dandole uso exclusivo para el desarrollo actividades propias del contrato. Declaro que he recibido información sobre el uso adecuado de los mismos. </p> 
                        <p><b>NOTA: El colaborador será el responsable inmediato de los daños ocacionados al equipo de computo y sus componentes, en caso de malas practicas y no acatar las recomendaciones dadas por el proceso de Gestión tecnológicas, en las politicas del buen uso de los recursos tecnológicos</b></p></td>
                </tr>
                <tr>
                    <td colspan="20"> <b>OBSERVACIONES:</b></td>
                </tr>
                <tr>
                    <th colspan="20"></th>
                </tr>
                <tr>
                    <th colspan="20"></th>
                </tr>
                <tr>
                    <th colspan="20"></th>
                </tr>
                <tr>
                    <th colspan="20"></th>
                </tr>
                <tr>
                    <th colspan="20"></th>
                </tr>
                <tr>
                    <td colspan="20"><b>TIEMPO ESTIMADO DE USO:</b> Se establece que el trabajador responsable dispondrá del equipamiento durante la duracion de: Contrato laboral y Practica laboral. </td>
                </tr>
                <tr>
                    <th colspan="20" class="fondo">6. FIRMA DE QUIEN ENTREGA DISPOSITIVOS TECNOLÓGICOS Y RECIBE PARA AGS SALUD SAS</th>
                </tr>
                <tr>
                    <th rowspan="7" colspan="3">ENTREGA DE DISPOSITIVOS TECNOLÓGICOS</th>
                    <td rowspan="1" colspan="7">QUIEN ENTREGA: ALEXANDER LULIGO RUIZ </td>
                    <th rowspan="7" colspan="3">DEVOLUCION DE DISPOSITIVOS TECNOLOGICOS</th>
                    <td rowspan="1" colspan="7">QUIEN RECIBE:</td>
                <tr>
                    <td rowspan="1" colspan="7">CARGO: ANALISTA DE SOPORTE TECNICO</td>
                    <td rowspan="1" colspan="7">CARGO:</td>
                </tr>
                <tr>
                    <td rowspan="1" colspan="7">PROCESO: TICS E INNOVACION</td>
                    <td rowspan="1" colspan="7">PROCESO:</td>
                </tr>
                <tr>
                    <td rowspan="1" colspan="7"><b>FECHA DE ENTREGA:</b></td>
                    <td rowspan="1" colspan="7"><b>FECHA DE DEVOLUCIÓN:</b></td>
                </tr>
                <tr>
                    <td rowspan="1" colspan="7">QUIEN RECIBE: {{$elemento->user->name}}</td>
                    <td rowspan="1" colspan="7">QUIEN ENTREGA:</td>
                </tr>
                <tr>
                    <td rowspan="1" colspan="7">CARGO: </td>
                    <td rowspan="1" colspan="7">CARGO:</td>
                </tr>
                <tr>
                    <td rowspan="1" colspan="7">PROCESO: </td>
                    <td rowspan="1" colspan="7">PROCESO: </td>
                </tr>
            </tbody>
            <tbody id="firma">
                <tr>
                    <th rowspan="6" colspan="13">
                        <img src="{{ public_path('img/encabezados-i.png') }}" class="encabezadosLogo">
                    </th> 
                    <td rowspan= "1" colspan="7" class="fondo"><b>FIRMA DE PAZ Y SALVO</b></td>
                </tr>
                <tr>
                    <td rowspan= "1" colspan="7"></td>
                </tr>
                <tr>
                    <td rowspan= "1" colspan="7"></td>
                </tr>
                <tr>
                    <td rowspan= "1" colspan="7"></td>
                </tr>
                <tr>
                    <td rowspan= "1" colspan="7"></td>
                </tr>
                <tr>
                    <td rowspan= "1" colspan="7"></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>