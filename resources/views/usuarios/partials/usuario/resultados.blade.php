<!-- users/partials/usuario/resultados.blade.php -->

@if ($users->count() > 0)
    <div class="table-container">
        <div class="table">
            <table>
                <thead>
                    <th>
                        Id
                    </th>
                    <th>
                        Usuario
                    </th>
                    <th>
                        Correo
                    </th>
                    <!-- Agrega más columnas según tus necesidades -->
                </thead>
                <tbody>
                    @foreach ($users as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <!-- Agrega más columnas según tus necesidades -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination">
        {{ $users->links('pagination.custom') }}
    </div>
@else
    <p>No hay users disponibles.</p>
@endif
