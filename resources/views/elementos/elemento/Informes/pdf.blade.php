<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Referencia</th>
            <th>Serial</th>
            <th>Modelo</th>
            <th>Garantia</th>
            <th>Valor</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Tipo</th>
            <th>Procedimiento</th>
            <th>Categoria</th>
            <th>N° Factura</th>
            <th>Asignado A:</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($elementos as $elemento)
        <tr>
            <td>alooo</td>
            <td>{{ $elemento->marca ? $elemento->marca : 'No aplica' }}</td>
            <td>{{ $elemento->referencia ? $elemento->referencia : 'No aplica' }}</td>
            <td>{{ $elemento->serial ? $elemento->serial : 'No aplica' }}</td>
            <td>{{ $elemento->modelo ? $elemento->modelo : 'No aplica' }}</td>
            <td>{{ $elemento->garantia ? $elemento->garantia : 'No aplica' }}</td>
            <td>{{ $elemento->valor ? $elemento->valor : 'No aplica' }}</td>
            <td>{{ $elemento->descripcion ? $elemento->descripcion : 'No aplica' }}</td>
            <td>{{ $elemento->estado->estado ?? 'No aplica' }}</td>
            <td>{{ $elemento->tipoElemento->tipo ?? 'No aplica' }}</td>
            <td>{{ $elemento->procedimiento->tipoProcedimiento->tipo ?? 'No aplica'}}</td>
            <td>{{ $elemento->categoria->nombre ?? 'No aplica' }}</td>
            <td>{{ $elemento->factura->codigoFactura ?? 'No aplica' }}</td>
            <td>{{ $elemento->user->name ?? 'No aplica' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
