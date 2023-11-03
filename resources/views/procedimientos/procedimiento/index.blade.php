<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Index Procedimientos</h1>

    <a href="{{route('createProcedimiento')}}">Crear</a>
    <a href="{{route('createEstadoP')}}">Crear estadoP</a>
    <a href="{{route('createTipoP')}}">Crear tipoP</a>

    <table>
        <thead>
            <th>
                ID
            </th>
            <th>
                fechaInicio
            </th>
            <th>
                fechaFin
            </th>
            <th>
                hora
            </th>
            <th>
                fechaReprogramada
            </th>
            <th>
                observacion
            </th>
            <th>
                idResponsableEntrega
            </th>
            <th>
                idResponsableRecibe
            </th>
            <th>
                idElemento
            </th>
            <th>
                idEstadoProcedimiento
            </th>
            <th>
                idTipoProcedimiento
            </th>
        </thead>
        <tbody>
            @foreach ($procedimiento as $procedimiento)
            <tr>
                <td>
                    {{$procedimiento->idProcedimiento}}
                </td>
                <td>
                    {{$procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->fechaFin ? $procedimiento->fechaFin : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->hora ? $procedimiento->hora : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->fechaReprogramada ? $procedimiento->fechaReprogramada : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->observacion}}
                </td>
                <td>
                    {{$procedimiento->idResponsableEntrega ? $procedimiento->idResponsableEntrega : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->idResponsableRecibe ? $procedimiento->idResponsableRecibe : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->elemento->modelo }}
                </td>
                <td>
                    {{$procedimiento->estadoProcedimiento->estado}}
                </td>
                <td>
                    {{$procedimiento->tipoProcedimiento->tipo}}
                </td>
                <td>
                    <a href="{{route('editProcedimiento', $procedimiento->idProcedimiento)}}">Editar</a>
                </td>
                <td>
                    <form action="{{route('destroyProcedimiento', ['id' => $procedimiento->idProcedimiento])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</body>
</html>
