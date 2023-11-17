



@if ($proveedor->count() > 0)
    <table>
        <tbody>
            @foreach ($proveedor as $proveedores)
                <tr>
                    <tr>
                        <td>{{$proveedores->idProveedor}}</td>
                        <td>{{$proveedores->nombre}}</td>
                        <td>{{$proveedores->nit}}</td>
                        <td>{{$proveedores->telefono}}</td>
                        <td>{{$proveedores->correoElectronico}}</td>
                        <td>{{$proveedores->direccion}}</td>
                    <td>
                        <a
                        class="edit-button"
                        href="{{ route('editTipoP',
                        ['id' => $proveedores->idProveedor]) }}"
                        title="Editar"><i class="fa-regular fa-pen-to-square"></i>
                    </a>


                    <button
                        type="button" class="delete-button" title="Eliminar"
                        data-id="{{ $proveedores->idProveedor }}"
                        data-name="{{$proveedores->nombre}}">

                    <i
                        data-id="{{ $proveedores->idProveedor }}"
                        data-name="{{$proveedores->nombre}}"
                        class="fas fa-trash-alt">
                    </i>
                    </button>
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
