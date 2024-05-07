<table>
    <thead>
        <tr>
            <th><p style="text-align: center; vertical-align: middle;"><img src="{{public_path('imgs/logos/ags-export.png')}}" alt="LOGO-AGS" style="border: 1px solid black;margin-left:20%;"></p></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
            <th><img src="{{ public_path('imgs/logos/encabezado.png') }}" alt="LOGO-AGS" style="border: 1px solid black; align-items: center; vertical-align: middle;"></th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($elementos as $elemento)
                <tr>
                    <td style="border: 1px solid black;">{{$elemento->id_dispo ? $elemento->id_dispo : 'No aplica'}}</td>
                    <td style="border: 1px solid black;">{{ $elemento->nameCategoria ? $elemento->nameCategoria :  'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->marca ? $elemento->marca : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->referencia ? $elemento->referencia : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->serial ? $elemento->serial : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->procesador ? $elemento->procesador : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->ram ? $elemento->ram : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->disco_duro ? $elemento->disco_duro : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->tarjeta_grafica ? $elemento->tarjeta_grafica : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->identificacion ? $elemento->identificacion : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->nombre1 }} {{$elemento->nombre2}} {{$elemento->apellido1}} {{$elemento->apellido2}}</td>
                    <td style="border: 1px solid black;">{{ $elemento->fechaCompra ?? 'No aplica'}}</td>
                    <td style="border: 1px solid black;">{{ $elemento->garantia ? $elemento->garantia : 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->codigoFactura ?? 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->nameProveedor ?? 'No aplica'}}</td>
                    <td style="border: 1px solid black;">{{ $elemento->estadoElemento ?? 'No aplica' }}</td>
                    <td style="border: 1px solid black;">{{ $elemento->descripcion ? $elemento->descripcion : 'No aplica' }}</td>
                </tr>
            @endforeach
    </tbody>
</table>
