<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tipo Procedimiento</title>
</head>
<body>

    <h1>Tipo Procedimiento Index</h1>

    <a href="{{route('createTipoP')}}">Crear</a>
    <table>
        <thead>
            <th>
                ID
            </th>
            <th>
                Tipo
            </th>
            <th>
                Descripcion
            </th>
            <th>
                Acciones
            </th>
        </thead>
        <tbody>
            @foreach ($tipoProcedimiento as $tipoProcedimiento)
                <tr>
                    <td>
                        {{$tipoProcedimiento->idTipoProcedimiento}}
                    </td>
                    <td>
                        {{$tipoProcedimiento->tipo}}
                    </td>
                    <td>
                        {{$tipoProcedimiento->descripcion}}
                    </td>
                    <td>
                        <a href="{{ route('editTipoP', ['id' => $tipoProcedimiento->idTipoProcedimiento]) }}">Editar</a>
                    </td>
                    <td>
                        <form action="{{ route('destroyTipoP', ['id' => $tipoProcedimiento->idTipoProcedimiento]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-link">Eliminar</button>
                        </form>
                    </td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
