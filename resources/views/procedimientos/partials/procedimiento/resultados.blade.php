<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>



@if ($procedimientos->count() > 0)
    <table>
        <tbody>
            @foreach ($procedimientos as $procedimiento)
                <tr>
                    <td>
                        {{ $procedimiento->idProcedimiento }}
                    </td>
                 <td>
                    {{$procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica' }}
                 </td>
                 <td>
                    {{$procedimiento->fechaFin ? $procedimiento->fechaFin : 'No aplica' }}
                 </td>
                 <td>
                    {{$procedimiento->hora ? $procedimiento->hora : 'No aplica' }}
                 </td>
                 <td>
                    {{$procedimiento->fechaReprogramada ? $procedimiento->fechaReprogramada : 'No aplica' }}
                 </td>
                 <td>
                    {{$procedimiento->observacion}}
                 </td>
                 <td>
                    {{$procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'No aplica' }}
                 </td>
                 <td>
                    {{$procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'No aplica' }}
                 </td>
                 <td>
                    {{$procedimiento->elemento->modelo}}
                 </td>
                 <td>
                    {{$procedimiento->estadoProcedimiento->estado}}
                 </td>
                 <td>
                    {{$procedimiento->tipoProcedimiento->tipo}}
                 </td>
                 <td>
                    <a href="{{ route('editProcedimiento', $procedimiento->idProcedimiento) }}">Editar</a>
                    <form action="{{ route('destroyProcedimiento', ['id' => $procedimiento->idProcedimiento]) }}" method="POST">
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
