
@if ($procedimientos->count() > 0)
    <table>
        <tbody>
            @foreach ($procedimientos as $procedimiento)
                <tr>
                    <td>
                        {{ $procedimiento->idProcedimiento }}
                    </td>
                    <td>
                        {{ $procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->fechaFin ? $procedimiento->fechaFin : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->hora ? $procedimiento->hora : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->fechaReprogramada ? $procedimiento->fechaReprogramada : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->observacion }}
                    </td>
                    <td>
                        {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->elemento->modelo }}
                    </td>
                    <td>
                        {{ $procedimiento->estadoProcedimiento->estado }}
                    </td>
                    <td>
                        {{ $procedimiento->tipoProcedimiento->tipo }}
                    </td>

                    @if(auth()->user()->hasRole(['superAdmin','administador']))
                    <td>
                        @if(auth()->user()->hasRole(['superAdmin','administador']))
                        <a class="edit-button"
                            href="{{ route('editProcedimiento', $procedimientos->idProcedimiento) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        @endif
                        @if(auth()->user()->hasRole(['superAdmin']))
                        <button type="button" class="delete-button"
                            data-id="{{ $procedimientos->idProcedimiento }}"
                            data-name="{{ $procedimientos->elemento->modelo }}
                                <span class='record-id-message'>Con el proceso</span>
                                {{ $procedimientos->tipoProcedimiento->tipo }}">
                            <i data-id="{{ $procedimientos->idProcedimiento }}"
                                data-name="{{ $procedimientos->elemento->modelo }}
                                <span class='record-id-message'>y el proceso</span>
                                {{ $procedimientos->tipoProcedimiento->tipo }}"
                                class="fas fa-trash-alt">
                            </i>
                        </button>
                        @endif
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <tr class="mensaje-vacio">
        <td colspan="12">No se encontraron registros</td>
    </tr>
@endif
