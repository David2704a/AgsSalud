@if ($tipoElementos->count() > 0)
    <table>
        <tbody>
            @foreach ($tipoElementos as $tipoElemento)
                <tr>
                    <td>{{ $tipoElemento->idTipoElemento }}</td>
                    <td>{{ $tipoElemento->tipo }}</td>
                    <td>{{ $tipoElemento->descripcion }}</td>
                    <td>
                        @if(auth()->user()->hasRole(['superAdmin','administrador']))
                            <a class="edit-button" method="POST" href="{{ route('tipoElementos.edit', ['idTipoElemento' => $tipoElemento->idTipoElemento]) }}" title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                        @endif

                        @if(auth()->user()->hasRole(['superAdmin']))
                            <button type="button" class="delete-button" title="Eliminar" data-id="{{ $tipoElemento->idTipoElemento }}" data-name="{{ $tipoElemento->tipo }}">
                                <i data-id="{{ $tipoElemento->idTipoElemento }}" data-name="{{ $tipoElemento->tipo }}" class="fas fa-trash-alt"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $tipoElementos->links('pagination.custom') }}
    </div>
@else
    <p>No se encontraron tipos de elementos.</p>
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
