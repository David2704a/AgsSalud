<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>




@if ($tipoProcedimiento->count() > 0)
    <table>
        <tbody>
            @foreach ($tipoProcedimiento as $tipoProcedimientos)
                <tr>
                    <td>
                        {{ $tipoProcedimientos->idTipoProcedimiento }}
                    </td>
                    <td>
                        {{ $tipoProcedimientos->tipo }}
                    </td>
                    <td>
                        {{ $tipoProcedimientos->descripcion }}
                    </td>
                    <td>
                        <a href="{{ route('editTipoP', ['id' => $tipoProcedimientos->idTipoProcedimiento]) }}">Editar</a>

                        <form action="{{ route('destroyTipoP', ['id' => $tipoProcedimientos->idTipoProcedimiento]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-link">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@else
<tr class="mensaje-vacio" >
    <td colspan="12">No se encontraron registros</td>
</tr>
@endif



</body>
</html>
