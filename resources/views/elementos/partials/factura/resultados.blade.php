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
                    <td>
                        <a class="edit-button"
                            href="{{ route('facturas.edit', $factura->idFactura) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>

                    <button type="button" class="delete-button"
                        data-id="{{$factura->idFactura }}"
                        data-name="{{ $factura->codigoFactura }}">
                        <i data-id="{{ $factura->idFactura }}"
                        data-name="{{ $factura->codigoFactura}}" class="fas fa-trash-alt">
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
