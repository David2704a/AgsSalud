<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estado Procedimiento</title>
</head>
<body>

    <h1>Estado Procedimiento Index</h1>

    <a href="{{route('createEstadoP')}}">Crear</a>

    <table>
        <thead>
            <th>
                ID
            </th>
            <th>
                Estado
            </th>
            <th>
                Descripcion
            </th>
            <th>
                Acciones
            </th>
        </thead>
        <tbody>
            @foreach ($estadoProcedimiento as $estadoProcedimiento)

            <tr>
                <td>
                    {{$estadoProcedimiento->id}}
                </td>
                <td>
                    {{$estadoProcedimiento->estado}}
                </td>
                <td>
                    {{$estadoProcedimiento->descripcion}}
                </td>
                <td>
                    <a href="{{ route('editEstadoP', ['id' => $estadoProcedimiento->idEstadoP]) }}">Editar</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
