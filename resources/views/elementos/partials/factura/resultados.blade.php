@if ($facturas->count() > 0)
    <table>
        <tbody>
            @foreach ($facturas as $factura)
                <tr>
                    <td>{{ $factura->idFactura }}</td>
                    <td>{{ $factura->codigoFactura}}</td>
                    <td>{{ $factura->fechaCompra}}</td>
                    <td>{{ $factura->proveedor->nombre}}</td>
                    <td>{{ $factura->metodoPago}}</td>
                    <td>{{ $factura->valor}}</td>
                    <td>{{ $factura->descripcion}}</td>
                    @if(auth()->user()->hasRole(['superAdmin','administrador']))
                    <td>
                        <a class="show-button" title="Ver" onclick="mostrarArchivo('{{$factura->rutaFactura }}')">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        @if(auth()->user()->hasRole(['superAdmin','admin']))
                        <a class="edit-button" title="Editar"
                            href="{{ route('facturas.edit',$factura->idFactura) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        @endif

                        @if(auth()->user()->hasRole(['superAdmin']))
                        <button title="Eliminar"
                            type="button" class="delete-button"
                            data-id="{{$factura->idFactura }}"
                            data-tipo="{{$factura->codigoFactura}}">
                            <i class="fas fa-trash-alt"></i>
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
