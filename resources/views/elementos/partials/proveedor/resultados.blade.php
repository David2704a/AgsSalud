



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
                        @if(auth()->user()->hasRole(['superAdmin','administrador']))
                        <td>
                            @if(auth()->user()->hasRole(['superAdmin','administrador']))                        <a class="edit-button"
                                href="{{ route('proveedores.edit',$proveedor->idProveedor) }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            @endif
                            @if(auth()->user()->hasRole(['superAdmin']))                        <button title="Eliminar"
                            type="button" class="delete-button"
                            data-id="{{ $proveedor->idProveedor }}"
                            data-tipo="{{$proveedor->nombre}}">
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
<tr class="mensaje-vacio" >
    <td colspan="12">No se encontraron registros</td>
</tr>
@endif
