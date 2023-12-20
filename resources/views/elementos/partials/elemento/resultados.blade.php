@if ($elementos->count() > 0)
    <table>
        <tbody>
            @foreach ($elementos as $elemento)
                <tr>
                    <td>{{$elemento->idElemento }}</td>
                    <td>{{$elemento->marca ? $elemento->marca : 'NO APLICA'}}</td>
                    <td>{{$elemento->referencia ? $elemento->referencia : 'NO APLICA'}}</td>
                    <td>{{$elemento->serial ? $elemento->serial : 'NO APLICA'}}</td>
                    <td>{{$elemento->procesador ? $elemento->procesador : 'NO APLICA'}}</td>
                    <td>{{$elemento->ram ? $elemento->ram : 'NO APLICA'}}</td>
                    <td>{{$elemento->disco_duro ? $elemento->disco_duro : 'NO APLICA'}}</td>
                    <td>{{$elemento->tarjeta_grafica ? $elemento->tarjeta_grafica : 'NO APLICA'}}</td>
                    <td>{{$elemento->modelo ? $elemento->modelo : 'NO APLICA'}}</td>
                    <td>{{$elemento->garantia ? $elemento->garantia : 'NO APLICA'}}</td>
                    <td>{{$elemento->descripcion}}</td>
                    <td>{{$elemento->estado->estado}}</td>
                    <td>{{$elemento->tipoElemento ? $elemento->tipoElemento->tipo : 'NO APLICA' }}</td>
                    <td>{{$elemento->categoria->nombre}}</td>
                    <td>{{$elemento->factura ? $elemento->factura->codigoFactura : 'NO APLICA'}}</td>
                    <td>{{$elemento->user ? $elemento->user->name : 'NO APLICA'}}</td>
                    <td>
                        <a class="edit-button"
                            href="{{ route('elementos.edit', $elemento->idElemento) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>

                    <button type="button" class="delete-button"
                        data-id="{{$elemento->idElemento}}"
                        data-name="{{ $elemento->marca}}">
                        <i data-id="{{ $elemento->idElemento }}"
                        data-name="{{ $elemento->marca}}" class="fas fa-trash-alt">
                        </i>
                </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <tr class="mensaje-vacio">
        <td colspan="12">No se encontraron registros</td>
    </tr>
@endif
