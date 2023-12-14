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
        @foreach ($elementos as $elemento)
                <tr>
                    @foreach ($elemento->procedimientos as $procedimiento)
                        <td>{{ $procedimiento->fechaInicio }}</td>
                    @endforeach
                    <td style="border: 1px solid black;">{{ $elemento->categoria->nombre ? $elemento->categoria->nombre : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">1</td>
                    <td style="border: 1px solid black;">{{ $elemento->id ? $elemento->id : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->estado->estado ? $elemento->estado->estado : 'No aplica' }}</td>
                    @foreach ($elemento->procedimientos as $procedimiento)
                        <td>{{ $procedimiento->responsableEntrega->name }}</td>
                    @endforeach
                    @foreach ($elemento->procedimientos as $procedimiento)
                        <td>{{ $procedimiento->responsableRecibe->name }}</td>
                    @endforeach
                    @foreach ($elemento->procedimientos as $procedimiento)
                        <td>{{ $procedimiento->fechaFin}}</td>
                    @endforeach
                    @foreach ($elemento->procedimientos as $procedimiento)
                        <td>{{ $procedimiento->responsableRecibe->name }}</td>
                    @endforeach
                    @foreach ($elemento->procedimientos as $procedimiento)
                        <td>{{ $procedimiento->responsableEntrega->name }}</td>
                    @endforeach
                    @foreach ($elemento->procedimientos as $procedimiento)
                        <td>{{ $procedimiento->observacion }}</td>
                    @endforeach
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