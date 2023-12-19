@if ($elementos->count() > 0)
    <table>
        <tbody>
            @foreach ($elementos as $elemento)
                <tr>
                    <td>{{$elemento->idElemento}}</td>
                    <td>{{$elemento->marca}}</td>
                    <td>{{$elemento->referencia}}</td>
                    <td>{{$elemento->serial}}</td>
                    <td>{{$elemento->especificaciones}}</td>
                    <td>{{$elemento->modelo}}</td>
                    <td>{{$elemento->garantia}}</td>
                    <td>{{$elemento->valor}}</td>
                    <td>{{$elemento->descripcion}}</td>
                    <td>{{$elemento->estado->estado}}</td>
                    <td>{{$elemento->tipoElemento->tipo}}</td>
                    <td>{{$elemento->categoria->nombre}}</td>
                    <td>{{$elemento->factura->codigoFactura}}</td>
                    <td>{{$elemento->user->name}}</td>
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

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
