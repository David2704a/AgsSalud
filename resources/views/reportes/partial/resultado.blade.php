@if ($elementos->count() > 0)
<table>

    <tbody>
        @foreach ($elementos as $elemento)
        <tr>
            <td>{{ $elemento->id_dispo ? $elemento->id_dispo : 'NO APLICA'}}</td>
            <td>{{ $elemento->marca ? $elemento->marca : 'NO APLICA' }}</td>
            <td>{{ $elemento->referencia ? $elemento->referencia : 'NO APLICA' }}</td>
            <td>{{ $elemento->serial ? $elemento->serial : 'NO APLICA' }}</td>
            <td>{{ $elemento->procesador ? $elemento->procesador : 'NO APLICA'}}</td>
            <td>{{ $elemento->ram ? $elemento->ram : 'NO APLICA'}}</td>
            <td>{{ $elemento->disco_duro ? $elemento->disco_duro : 'NO APLICA'}}</td>
            <td>{{ $elemento->tarjeta_grafica ? $elemento->tarjeta_grafica : 'NO APLICA'}}</td>
            <td>{{ $elemento->modelo ? $elemento->modelo : 'NO APLICA' }}</td>
            <td>{{ $elemento->garantia ? $elemento->garantia : 'NO APLICA' }}</td>
            <td>{{ $elemento->descripcion ? $elemento->descripcion : 'NO APLICA' }}</td>
            <td>{{ $elemento->estado->estado ?? 'NO APLICA' }}</td>
            <td>{{ $elemento->tipoElemento->tipo ?? 'NO APLICA' }}</td>
            <td>{{ $elemento->procedimiento->tipoProcedimiento->tipo ?? 'NO APLICA'}}</td>
            <td>{{ $elemento->categoria->nombre ?? 'NO APLICA' }}</td>
            <td>{{ $elemento->factura->codigoFactura ?? 'NO APLICA' }}</td>
            <td>{{ $elemento->factura->proveedor->nombre ?? 'NO APLICA'}}</td>
            <td>{{ $elemento->user->persona->nombre1 ?? 'NO APLICA' }} {{ $elemento->user->persona->apellido1 ?? 'NO APLICA'}}</td>
        </tr>
        @endforeach

    </tbody>
</table>
@else
    <tr class="mensaje-vacio">
        <td colspan="12">No se encontraron registros</td>
    </tr>
@endif
