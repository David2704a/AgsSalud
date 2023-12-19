@if ($categorias->count() > 0)
    <table>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>
                        {{ $categoria->idCategoria}}
                    </td>
                    <td>
                        {{ $categoria->nombre }}
                    </td>
                    <td>
                        {{ $categoria->descripcion }}
                    </td>
                    <td>
                        <a class="edit-button" href="{{ route('categorias.edit', ['id' => $categoria->id]) }}" title="Editar">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>

                        <button type="button" class="delete-button" title="Eliminar" data-id="{{ $categoria->id }}" data-name="{{ $categoria->nombre }}">
                            <i data-id="{{ $categoria->id }}" data-name="{{ $categoria->nombre }}" class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <tr class="mensaje-vacio">
        <td colspan="4">No se encontraron categorías.</td>
    </tr>
@endif
