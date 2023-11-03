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
                    {{$estadoProcedimiento->idEstadoP}}
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
                <td>
                    <form action="{{route('destroyEstadoP', ['id' => $estadoProcedimiento->idEstadoP])}}" method="POST">
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
