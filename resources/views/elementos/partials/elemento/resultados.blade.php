@if ($elementos->count() > 0)
    <table>
        <tbody>
            @foreach ($elementos as $elemento)
                <tr>
                    <td>{{ $elemento->idElemento ? $elemento->idElemento : 'NO APLICA' }}</td>
                    <td>{{ $elemento->id_dispo ? $elemento->id_dispo : 'NO APLICA' }}</td>
                    <td>{{ $elemento->marca ? $elemento->marca : 'NO APLICA' }}</td>
                    <td>{{ $elemento->referencia ? $elemento->referencia : 'NO APLICA' }}</td>
                    <td>{{ $elemento->serial ? $elemento->serial : 'NO APLICA' }}</td>
                    <td>{{ $elemento->procesador ? $elemento->procesador : 'NO APLICA' }}</td>
                    <td>{{ $elemento->ram ? $elemento->ram : 'NO APLICA' }}</td>
                    <td>{{ $elemento->disco_duro ? $elemento->disco_duro : 'NO APLICA' }}</td>
                    <td>{{ $elemento->tarjeta_grafica ? $elemento->tarjeta_grafica : 'NO APLICA' }}</td>
                    <td>{{ $elemento->modelo ? $elemento->modelo : 'NO APLICA' }}</td>
                    <td>{{ $elemento->garantia ? $elemento->garantia : 'NO APLICA' }}</td>
                    <td>{{ $elemento->descripcion ? $elemento->descripcion : 'NO APLICA' }}</td>
                    <td>{{ $elemento->estado->estado ?? 'NO APLICA' }}</td>
                    <td>{{ $elemento->tipoElemento->tipo ?? 'NO APLICA' }}</td>
                    <td>{{ $elemento->procedimiento->estadoProcedimiento->estado ?? 'NO APLICA' }}</td>
                    <td>{{ $elemento->categoria->nombre ?? 'NO APLICA' }}</td>
                    <td>{{ $elemento->factura->codigoFactura ?? 'NO APLICA' }}</td>
                    <td>{{ $elemento->user->name ?? 'NO REGISTRADO'}}</td>


                    @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                    <td>
                        @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                            <a class="edit-button" title="Editar"
                                href="{{ route('elementos.edit', $elemento->idElemento) }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        @endif

                        @if (auth()->user()->hasRole(['superAdmin', 'administrador']))
                                            <a class="pdf-button" title="Mostrar"
                                                href="{{ route('elementos.pdf', $elemento->idElemento) }}">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                        @endif
                                        
                        @if (auth()->user()->hasRole('superAdmin'))
                            <button type="button" class="delete-button" title="Eliminar"
                                data-id="{{ $elemento->idElemento }}" data-name="{{ $elemento->modelo }}">

                                <i data-id="{{ $elemento->idElemento }}"
                                    data-name="{{ $elemento->modelo }}" class="fas fa-trash-alt"></i>
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
