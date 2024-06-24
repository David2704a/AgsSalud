<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoja de Vida Equipos de Computo, Hardware y Software</title>
    <link rel="stylesheet" href="{{public_path('/css/elemento/elementopdf.css')}}">
</head>
<body>
    
@foreach ($elemento as $Elemento)
    <table width="100%" id="tablehead" style="border-collapse: collapse; ">
        <tbody>
            <tr>
                <td rowspan="3" width="20%"><img src="{{public_path('/imgs/logos/Ags.png')}}" alt="" id="logo"></td>
                <td colspan="6" style="font-family: Arial, Helvetica, sans-serif;">TICS E INNOVACIÓN</td>
                <td rowspan="3" colspan="1" width="20%" style="font-family: Arial, Helvetica, sans-serif; font-size: 10pt;"><i>Fecha de Modificación: <br>10/06/2021</i></td>                
            </tr>
            <tr>   
                <td colspan="6" style="font-family: Arial, Helvetica, sans-serif;"><div style="">HOJA DE VIDA EQUIPOS DE COMPUTO, HARDWARE Y SOFTWARE</div></td>
            </tr>
            <tr>
                <td width="30%" style="line-height: 1.2; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; font-size: 11pt;"><div style=" font-size: 11pt;"><i>Código: TEI-F-04</i></div></td>
                <td colspan="" width="30%" style="font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; font-size: 11pt;"><div style=""><i>Versión: 03</i></div></td>
            </tr>
            <tr>
                <td colspan="8" style="border-bottom-color: #fff;">
                    <div style="padding: 2px;"></div>
                </td>
            </tr>
        </tbody>                   
    </table>
    <div id="content-font">
        <div id="border-content">
            <p id="section-title" style="border-top-color: #244062;">
                1. HOJA DE VIDA EQUIPOS DE COMPUTO, HARDWARE Y SOFTWARE
            </p>  
            <table style="border-collapse: collapse; " width="100%">
                <tbody>
                    <br>
                    <tr>
                        <td colspan="10" style="border: 0; padding: 0">
                            <table id="table-hoja" style="padding: 0">
                                <tbody>
                                    <tr>
                                        <td style="width: 140px; padding: 0; border-left:1px solid #fff; line-height: 1.3;">Ciudad y Fecha</td>
                                        <td style="width: 280px; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;">{{$Elemento->user->name}}</td>
                                        <td style="border-bottom:1px solid #fff; border-top:1px solid #fff;"></td>
                                        <td style="width: 80px;">EMPRESA:</td>
                                        <td style="width: 140px; border-right:1px solid #fff; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;">{{$Elemento->user->name}}</td>
                                        <tr>
                                            <td colspan="5" style="border:1px solid #fff">
                                                <br>
                                            </td>
                                        </tr>
                                    </tr>
                                    <tr>
                                        <td style="width: 140px; border-left: 1px solid #fff">Nombre de Usuario</td>
                                        <td colspan="6" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight:normal;">{{$Elemento->user->name}}</td>
                                        <td style="width: 80px; text-align: left">Contraseña</td>
                                        <td colspan="2" style="width: 155px; border-right:1px solid #fff; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 140px; border-left:1px solid #fff">Nombre del equipo</td>
                                        <td colspan="9" style="border-right:1px solid #fff; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 140px; border-left:1px solid #fff">Usuario del Equipo</td>
                                        <td colspan="9" style="border-right:1px solid #fff; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;">{{$Elemento->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 140px; border-left:1px solid #fff">Grupo de Trabajo</td>
                                        <td colspan="9" style="border-right:1px solid #fff; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 140px; border-left:1px solid #fff">Direccion IP</td>
                                        <td colspan="9" style="border-right:1px solid #fff; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <section style="margin-top: -5px; line-height: 1.2;">
            <p id="section-title">
                2. TIPO DE EQUIPO
            </p>
            <div class="border-content">

            
            <table id="tabla-casillas">
                <tbody>
                    <tr>
                        <th style="text-align: center; padding-left: 5px; line-height: 1.3;">PC</th>
                        <th><div class="checkbox"></div></th>
                        <th>IMPRESORA</th>
                        <th><div class="checkbox">{{ $Elemento->categoria->nombre == 'IMPRESORA' ? 'X' : '' }}</div></th>
                        <th>MONITOR</th>
                        <th><div class="checkbox">{{ $Elemento->categoria->nombre == 'MONITOR' ? 'x': '' }}</div></th>
                        <th colspan="3" rowspan="4" style="padding-right: 790px;"></th>
                    </tr>
                    <tr>
                        <th style="text-align: center; padding-left: 6px;">PORTATIL</th>
                        <th><div class="checkbox">{{ $Elemento->categoria->nombre == 'PC PORTATIL' ? 'X' : '' }}</div></th>
                        <th>ACCESORIO</th>
 
                        <th style="line-height: 1.3;">
                            <div class="checkbox">
                                {{
                                    !in_array($Elemento->categoria->nombre, ['PC', 'IMPRESORA', 'MONITOR', 'PORTATIL', 'DVR', 'MAC', 'SERVIDOR', 'CAMARA', 'EQUIPO TODO EN UNO','PC PORTATIL']) || $Elemento->categoria->nombre == 'ACCESORIO' ? 'x' : ''
                                }}
                            </div>                             
                        </th>
                        <th>DVR</th>
                        <th style="line-height: 1.3;"><div class="checkbox">{{ $Elemento->categoria->nombre == 'DVR' ? 'X' : '' }}</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; padding-left: 6px;">MAC</th>
                        <th style="line-height: 1.3;"><div class="checkbox">{{ $Elemento->categoria->nombre == 'MAC' ? 'X' : '' }}</div></th>
                        <th>SERVIDOR</th>
                        <th style="line-height: 1.3;"><div class="checkbox">{{ $Elemento->categoria->nombre == 'EQUIPO TODO EN UNO' ? 'X' : '' }}</div></th>
                        <th>CAMARA</th>
                        <th style="border-top: 1px solid #fff; line-height: 1.3;"><div class="checkbox">{{ $Elemento->categoria->nombre == 'CAMARA' ? 'X' : '' }}</div></th>      
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="6" style="border-top: 1px solid #fff; padding:6px; border-right: 1px solid #fff;">                                   
                        </td>
                    </tr>
                </tbody>
            </table>
</div>
            
        </section>
        <p id="section-title" style="border-left-color: black;">
            3. IDENTIFICACION DEL EQUIPO
        </p>       
        <table id="table-identificacion-equipo" style="width: 100%; border-bottom:1px solid #ffffff">
            <tbody>
                <tr>
                    <td style="padding-right: 32px; ">Marca</td>
                    <td style="border-bottom:1px solid black; width: 70px; max-width:80px; background-color: #ffffff; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;">{{$Elemento->marca}}</td>
                    <td style="padding-right: 30px; ">Referencia</td>
                    <td style="border-bottom:1px solid black; width: 70px; max-width:80px; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;">{{$Elemento->referencia}}</td>
                    <td style="padding-right: 30px;">Activo fijo</td>
                    <td style="border-bottom:1px solid black;width: 70px; max-width:80px; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;">{{$Elemento->referencia}}</td>
                </tr>
            </tbody>
        </table>
        <table id="table-identificacion-equipo" style="width: 100%; border-top:1px solid #fff; margin-top: -1px; padding_bottom: 10px;">
            <tr>
                <td style="padding-right: 20px; border-top:1px solid #fff; line-height: 1.3;">Descripción</td>
                <td style="border-bottom:1px solid black; width: 580px; max-width: 580px;text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"> {{$Elemento->descripcion}}</td>
            </tr>
        </table>           
        <p id="section-title">
            4. LICENCIAS PRINCIPALES DEL EQUIPO
        </p>

        <div class="border-content">

        
        @foreach($elemento as $Elemento)

        
        <table style="border-collapse: collapse;" id="table4licencias" width="100%">
            <tbody>
            <tr>
                <td style="width: 132px; line-height: 1.3;">Sistema Operativo</td>
                <td colspan="3" style=" text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                <td style="text-align: left; line-height: 1.3;">Licencia</td>
                <td style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
            </tr>
            <tr>
                <td style="width: 132px; line-height: 1.3;">Fecha de instalación S.O</td>
                <td  colspan="3" style=" text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 132px; line-height: 1.3;">Office:</td>
                <td  colspan="3" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                <td style="text-align: left; line-height: 1.3;">Licencia</td>
                <td style="width: 150px;text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
            </tr>
            <tr>
                <td style="line-height: 1.3;">Antivirus:</td>
                <td  colspan="3" style="line-height: 1.3; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                <td style="text-align: left">Licencia</td>
                <td  style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
            </tr>
            </tbody>         
            <tbody>
                <tr>
                    <td colspan="6" id="section-title" style="line-height: 1.2;">
                        5. CARACTERISTICAS FISICAS DEL EQUIPO
                    </td>
                </tr>
            </tbody>         
            <tbody>
                <tr>
                    <td style="text-align: center; line-height: 1.3;">Main Board</td>
                    <td colspan="5" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;">Procesador</td>
                    <td colspan="5" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal; "></td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;">Memoria RAM</td>
                    <td colspan="5" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;">{{$Elemento->ram}}</td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;">Disco duro</td>
                    <td colspan="5" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;">{{$Elemento->disco_duro}}</td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;"">Tarjetas</td>
                    <td colspan="5" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;">{{$Elemento->tarjeta_grafica}}</td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;"">Fuente</td>
                    <td colspan="5" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;"">Monitor</td>
                    <td colspan="1" style="width: 15 0px; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td style="text-align: left">S/N:</td>
                    <td  style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td style="text-align: left">Activo fijo</td>
                    <td  style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;">Teclado</td>
                    <td colspan="1" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td style="text-align: left">P/N:</td>
                    <td style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td style="text-align: left">Activo fijo</td>
                    <td style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;">Mouse</td>
                    <td colspan="1" style="line-height: 1.3; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td style="text-align: left">P/N</td>
                    <td style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td colspan="1" style="text-align: left">S/N:</td>
                    <td style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>                         
                </tr>
                <tr>
                    <td style="line-height: 1.3;">Parlantes</td>
                    <td colspan="3"  style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;">Impresora Local</td>
                    <td colspan="3"  style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td style="text-align: left">Activo fijo</td>
                    <td style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;">Impresoras Conectadas</td>
                    <td colspan="3" style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="line-height: 1.3;">Recursos Compartidos</td>
                    <td colspan="3"  style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>   
                    <td style="line-height: 1.3;">Unidades de RED</td>
                    <td colspan="3"  style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="line-height: 1;"><br></td>
                    <td colspan="3"  style="line-height: 1.3; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            @endforeach
            <tbody>         
                <tr>
                    <td colspan="6" id="section-title" style="line-height: 1.2; border-bottom-color: #244062;">
                        6. OTROS PROGRAMAS Y CONFIGURACIONES Y ANOTACIONES
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th colspan="6" style="margin: 0; padding: 0; border-collapse: collapse;">                           
                            <table id="m" style="border-collapse: collapse; width: 100%; padding: 0; margin: 0; border-top: 1px solid #fff; border-bottom: 1px solid #fff;">
                                <tbody>   
                                    <tr>
                                        <td colspan="7" style="line-height: 1.3; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"><br></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="line-height: 1.3; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"><br></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="line-height: 1.3; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"><br></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="line-height: 1.3; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"><br></td>
                                    </tr>   
                                    <tr>
                                        <td style="width: 130px; line-height: 1.3;">Correo</td>
                                        <td style="text-align: center; line-height: 1.3;">Nombre de usuario</td>
                                        <td colspan="3"  style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"><div style="padding-right: 200px;"></div></td>                                            
                                        <td colspan="" style="text-align: left"; line-height: 1.3;>Contraseña</td>
                                        <td style="width: 145px; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal; padding-left: 69px;"></td>
                                    </tr>
                                </tbody>
                            </table>                           
                    </th>
                </tr>
            </tbody>                             
            <tbody>
                <tr>
                    <td colspan="6" id="section-title" style="line-height: 1.2; border-top-color: #244062;">
                        7. RESPONSABLES HOJA DE VIDA
                    </td>
                </tr>
            </tbody>
            <tbody style="border-bottom: 1px solid black;">
                <tr>
                    <td style="text-align: left; line-height: 1.2;">Realizado por:</td>
                    <td style="width: 140px; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <th colspan="1" style="padding:6px"></th>
                    <td style="text-align: left; line-height: 1.2;">Revisado por:</td>
                    <td colspan="2" style="padding:6px; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                </tr>
                <tr>
                    <td style="text-align: left; line-height: 1.2;">Cargo</td>
                    <td style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <th colspan="1" style="padding:6px; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></th>
                    <td style="text-align: left; line-height: 1.2;">Cargo:</td>
                    <td colspan="2" style="padding:6px;text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                </tr>
                <tr>
                    <td style="text-align: left; line-height: 1.3;">Email:</td>
                    <td style="text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                    <th colspan="1" style="padding:6px"></th>
                    <td style="text-align: left; line-height: 1.3;">Email</td>
                    <td colspan="2" style="padding:6px; text-align: center; white-space: nowrap; z-index: 1; overflow: hidden; text-overflow: ellipsis; font-weight: normal;"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding:6px;" style="text-align: center; font-weight: normal; border-bottom:1px solid black;">
                        <div style="padding-top: 51px; ">                         
                            FIRMA
                        </div>
                    </td>
                    <th style="border-bottom:1px solid black;" colspan="1" style="padding: 7px; line-height: 1;"></th>
                    <td colspan="3" style="text-align: center; font-weight: normal;border-bottom:1px solid black; ">
                        <div style="padding-top: 51px; ">                         
                            FIRMA
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    </div>
@endforeach        
</body>
</html>