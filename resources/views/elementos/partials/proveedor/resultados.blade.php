{{-- @if ($proveedores->count() > 0)
    <table>
        <tbody>
            @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->idProveedor}}</td>
                    <td>{{ $proveedor->nombre}}</td>
                    <td>{{ $proveedor->nit}}</td>
                    <td>{{ $proveedor->telefono}}</td>
                    <td>{{ $proveedor->correoElectronico}}</td>
                    <td>{{ $proveedor->direccion}}</td>
                    <td>
                        <a
                        class="edit-button"
                        href="{{ route('proveedores.edit',$proveedor->idProveedor)}}"
                        title="Editar"><i class="fa-regular fa-pen-to-square"></i>
                    </a>


                    <button
                        type="button" class="delete-button" title="Eliminar"
                        data-id="{{ $proveedor->idProveedor}}"
                        data-name="{{$proveedor->nombre}}">

                    <i
                        data-id="{{ $proveedor->idProveedor }}"
                        data-name="{{$proveedor->nombre}}"
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
@endif --}}
<h1>holiiiiii</h1>
