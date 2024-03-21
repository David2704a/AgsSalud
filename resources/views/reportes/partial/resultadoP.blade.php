<table>

    <tbody>

        @foreach ($procedimientos as $procedimiento)
        @if ($procedimiento->idTipoProcedimiento == 3)
<tr>
    <td>
        {{ $procedimiento->idProcedimiento}}
    </td>
    <td style="border: 1px solid black;">
        {{ $procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'NO APLICA'}}
    </td>
    <td style="border: 1px solid black;">
        {{ $procedimiento->elemento->categoria->nombre }}
    </td>
    <td style="border: 1px solid black;">
        1
    </td>
    <td style="border: 1px solid black;">
        {{ $procedimiento->elemento->modelo }}
    </td>
    <td style="border: 1px solid black;">
        {{ $procedimiento->elemento->estado->estado}}
    </td>
    <td style="border: 1px solid black;">
        {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'NO APLICA' }}
    </td>
    <td style="border: 1px solid black;">
        {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'NO APLICA' }}
    </td>
    <td style="border: 1px solid black;">
        {{ $procedimiento->fechaFin ? $procedimiento->fechaFin : 'NO APLICA' }}
    </td>

    <td style="border: 1px solid black;">
        {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'NO APLICA' }}
    </td>
    <td style="border: 1px solid black;">
        {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'NO APLICA' }}
    </td>
    <td style="border: 1px solid black;">
        {{ $procedimiento->observacion }}
    </td>

</tr>
@endif
@endforeach
</tbody>

</table>
