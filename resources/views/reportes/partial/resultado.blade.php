<thead>
    <th>ID</th>
    <th>Marca</th>
    <th>Referencia</th>
    <th>Serial</th>
    <th>Procesador</th>
    <th>Ram</th>
    <th>Disco duro</th>
    <th>Tarjeta gráfica</th>
    <th>Modelo</th>
    <th>Garantia</th>
    <th>Descripcion</th>
    <th>Estado</th>
    <th>Tipo</th>
    <th>Procedimiento</th>
    <th>Categoria</th>
    <th>N° Factura</th>
    <th>Proveedor</th>
    <th>Asignado A:</th>
</thead>
<tbody>
    @foreach ($elementos as $elemento)
        <tr>
            <td>{{ $elemento->idElemento ? $elemento->idElemento : 'NO APLICA'}}</td>
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
