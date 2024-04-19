@if ($users->count() > 0)
    <table>
      
        <tbody>
            @foreach ($users as $usuario)
            {{-- @dd($usuario,'aaaaaaaaaaa') --}}
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->user_name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td>
                        <a class="edit-button"
                            href="{{ route('usuarios.edit', $usuario->id) }}"
                            title="Editar">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>

                        <button type="button" class="delete-button"
                            data-id="{{ $usuario->id }}"
                            data-name="{{ $usuario->name }}"
                            title="Eliminar">
                            <i data-id="{{ $usuario->id }}" data-name="{{ $usuario->name }}"
                                class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $users->links('pagination.custom') }}
    </div>
@else
    <p>No se encontraron usuarios.</p>
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
