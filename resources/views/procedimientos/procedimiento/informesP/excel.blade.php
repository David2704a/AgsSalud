<table>
    <thead>
        <tr>
            <th><img src="{{public_path('imgs/logos/ags-export.png')}}" alt="LOGO-AGS" style="border: 1px solid black;"></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>FECHA DE PRESTAMO</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>DISPOSITIVO</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>CANTIDAD</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>CARACTERISTICAS</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>ESTADO</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>ENTREGA</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>RECIBE</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>FECHA DE DEVOLUCION</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>ENTREGA</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>RECIBE</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>OBSERVACION</b></th>

        </tr>
    </thead>
    <tbody>
        @foreach ($procedimientos as $procedimiento)
                <tr>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica'}}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->elemento->categoria->nombre }}
                    </td>
                    <td style="border: 1px solid black;">
                        1
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->elemento->idElemento }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->elemento->estado->estado}}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'No aplica' }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'No aplica' }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->fechaFin }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'No aplica' }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'No aplica' }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $procedimiento->observacion }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <th></th><th></th><th>
                <th><img src="{{ public_path('imgs/logos/iso-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
                <th><img src="{{ public_path('imgs/logos/iqnet-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
                <th><img src="{{ public_path('imgs/logos/escudo-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
                <th><img src="{{ public_path('imgs/logos/enterritorio-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
                <th><img src="{{ public_path('imgs/logos/fondo-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
                <th><img src="{{ public_path('imgs/logos/sena-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
            </tr>
    </tbody>
</table>
