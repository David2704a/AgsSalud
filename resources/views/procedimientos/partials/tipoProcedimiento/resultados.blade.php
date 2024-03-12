



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
                    @if(auth()->user()->hasRole(['superAdmin','administador']))
                    <td>
                        @if(auth()->user()->hasRole(['superAdmin','administrador']))
                        <a
                            class="edit-button"
                            href="{{ route('editTipoP',
                            ['id' => $tipoProcedimientos->idTipoProcedimiento]) }}"
                            title="Editar"><i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        @endif
                        @if(auth()->user()->hasRole(['superAdmin']))
                        <button
                            type="button" class="delete-button" title="Eliminar"
                            data-id="{{ $tipoProcedimientos->idTipoProcedimiento }}"
                            data-name="{{$tipoProcedimientos->tipo}}">

                        <i
                            data-id="{{ $tipoProcedimientos->idTipoProcedimiento }}"
                            data-name="{{$tipoProcedimientos->tipo}}"
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
<tr class="mensaje-vacio" >
    <td colspan="12">No se encontraron registros</td>
</tr>
@endif
