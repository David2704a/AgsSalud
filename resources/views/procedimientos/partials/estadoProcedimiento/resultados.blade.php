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
                @if(auth()->user()->hasRole(['superAdmin','administrador','tecnico']))
                <td>
                    @if(auth()->user()->hasRole(['superAdmin','admin','tecnico']))
                    <a class="edit-button"
                        href="{{ route('editEstadoP', ['id' => $estadoProcedimientos->idEstadoP]) }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    @endif
                    @if(auth()->user()->hasRole(['superAdmin','admin','tecnico']))
                    <button type="button" class="delete-button"
                        data-id="{{ $estadoProcedimientos->idEstadoP }}"
                        data-name="{{ $estadoProcedimientos->estado }}">
                        <i data-id="{{ $estadoProcedimientos->idEstadoP }}"
                            data-name="{{ $estadoProcedimientos->estado }}" class="fas fa-trash-alt">
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
