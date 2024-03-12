@if ($categorias->count() > 0)
    <table>

        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->idCategoria }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->descripcion }}</td>
                    <!-- Agrega más celdas según tus necesidades -->
                    @if(auth()->user()->hasRole(['superAdmin','administador']))
                        <td>


                            @if(auth()->user()->hasRole(['superAdmin','administrador']))
                            <a class="edit-button" method="POST"
                             href="{{ route('categorias.edit', ['idCategoria' => $categoria->idCategoria]) }}"
                                title="Editar"><i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            @endif

                            @if(auth()->user()->hasRole(['superAdmin']))
                            <button type="button" class="delete-button" title="Eliminar"
                            data-id="{{ $categoria->idCategoria }}"
                             data-name="{{ $categoria->nombre }}">

                                <i data-id="{{ $categoria->idCategoria }}" data-name="{{ $categoria->nombre }}" class="fas fa-trash-alt"></i>
                            </button>
                            @endif
                        </td>
                        @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $categorias->links('pagination.custom') }}
    </div>
@else
    <p>No se encontraron categorías.</p>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
