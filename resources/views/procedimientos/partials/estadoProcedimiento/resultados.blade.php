<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>




@if ($estadoProcedimiento->count() > 0)
    <table>
        <tbody>
            @foreach ($estadoProcedimiento as $estadoProcedimientos)

            <tr>
                <td>
                    {{$estadoProcedimientos->idEstadoP}}
                </td>
                <td>
                    {{$estadoProcedimientos->estado}}
                </td>
                <td>
                    {{$estadoProcedimientos->descripcion}}
                </td>
                <td>
                    <a href="{{ route('editEstadoP', ['id' => $estadoProcedimientos->idEstadoP]) }}">Editar</a>
                </td>
                <td>
                    <form action="{{route('destroyEstadoP', ['id' => $estadoProcedimientos->idEstadoP])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
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
