<table>
    <thead>
        <tr>
            <th>
                <div class="div_imgLogo" style="margin: 1em">
                    <img src="{{ public_path('imgs/logos/ags-export.png') }}" alt="LOGO-AGS" width="150"
                        style="border: 1px solid black;width: 50px: margin-left: 2em">
                </div>
            </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            {{-- <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>ID</b></th> --}}
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>FECHA DE PRESTAMO</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>DISPOSITIVO</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>CANTIDAD</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>CARACTERISTICAS</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>ESTADO</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>ENTREGA</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>RECIBE</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>FECHA DE DEVOLUCION</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>ENTREGA</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>RECIBE</b>
            </th>
            <th
                style="background-color: #1F4E78; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;">
                <b>OBSERVACION</b>
            </th>

        </tr>
    </thead>
    <tbody>
        @foreach ($procedimientos as $procedimiento)
            <tr>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica' }}
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->id_dispo ? $procedimiento->id_dispo : 'NO APLICA' }}
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    1
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->nameCategoria }}
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->estado ? $procedimiento->estado : 'NO APLICA' }}
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->nameEntrega ? $procedimiento->nameEntrega : 'NO APLICA' }}
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->nameRecibe ? $procedimiento->nameRecibe : 'NO APLICA' }}
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->fechaFin ? $procedimiento->fechaFin : 'NO APLICA' }}
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->nameRecibeDev ? $procedimiento->nameRecibeDev : 'NO APLICA' }}
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->nameEntregaDev ? $procedimiento->nameEntregaDev : 'NO APLICA' }}
                </td>
                <td style="vertical-align: middle;border: 1px solid black; word-wrap: break-word;">
                    {{ $procedimiento->observacion ? $procedimiento->observacion : 'NO APLICA' }}
                </td>

            </tr>
        @endforeach
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>
                <img src="{{ public_path('imgs/logos/logosPrestamos.png') }}" alt="LOGO-AGS" width="400"
                    style="border: 1px solid black; align-items: center; vertical-align: middle;">
            </th>
        </tr>
    </tbody>
</table>
