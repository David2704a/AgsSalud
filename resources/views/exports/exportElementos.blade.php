<table>
    <thead>
        <tr>
            <th><p style="text-align: center; vertical-align: middle;"><img src="{{public_path('imgs/logos/ags-export.png')}}" alt="LOGO-AGS" style="border: 1px solid black;margin-left:20%;"></p></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
            <th><img src="{{ public_path('imgs/logos/encabezado.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
            <th><img src="{{ public_path('imgs/logos/iqnet-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
            <th><img src="{{ public_path('imgs/logos/escudo-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
            <th><img src="{{ public_path('imgs/logos/enterritorio-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
            <th><img src="{{ public_path('imgs/logos/fondo-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
            <th><img src="{{ public_path('imgs/logos/sena-export.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>ID DISPOSITIVO</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>CATEGORIA</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>MARCA</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>REFERENCIA</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>SERIAL</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>ESPECIFICACIONES</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>MODELO</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>GARANTIA</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>VALOR</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>ESTADO</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>TIPO</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>FACTURA</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>ASIGNADO</b></th>
            <th style="background-color: #343D7C; font-family: Arial; border: 1px solid black; text-align: center; vertical-align: middle;"><b>DESCRIPCION</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($elementos as $elemento)

                <tr>
                    <td style="border: 1px solid black;">{{$elemento->id_dispo ? $elemento->id_dispo : 'No aplica'}}</td>
                    <td style="border: 1px solid black;">{{ $elemento->categoria->nombre ?? 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->marca ? $elemento->marca : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->referencia ? $elemento->referencia : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->serial ? $elemento->serial : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->especificaciones ? $elemento->especificaciones : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->modelo ? $elemento->modelo : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->garantia ? $elemento->garantia : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->valor ? $elemento->valor : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->estado->estado ?? 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->tipoElemento->tipo ?? 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->procedimiento->tipoProcedimiento->tipo ?? 'No aplica'}}</td>
                    <td style="border: 1px solid black;">{{ $elemento->factura->codigoFactura ?? 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->user->name ?? 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->descripcion ? $elemento->descripcion : 'No aplica' }}</td>
                </tr>
            @endforeach
    </tbody>
</table>
