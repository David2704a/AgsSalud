@extends('layouts.app')

@section('title', 'Procedimiento')


@section('links')

<link rel="stylesheet" href="{{asset('/css/procedimiento/procedimiento.css')}}">


@endsection

@section('content')

<div class="content">
    <h1 class="page-title">PROCEDIMIENTOS</h1>
    <div class="green-line"></div>

    <div class="menu-container">
        <ul class="menu">
            <li>
                <a href="#" data-filtro="Todos">Todos</a>
            </li>
            <li>
                <a href="#" data-filtro="En-proceso">En proceso</a>
            </li>
            <li>
                <a href="#" data-filtro="Terminado">Terminados</a>

            </li>
            <li>
                <a href="#" data-filtro="Pendiente">Pendientes</a>
            </li>
        </ul>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                   <th>ID</th>
                   <th>Fecha Inicio</th>
                   <th>Fecha Fin</th>
                   <th>Hora</th>
                   <th>Fecha Reprogramada</th>
                   <th>Observación</th>
                   <th>Responsable de Entrega</th>
                   <th>Responsable que Recibe</th>
                   <th>Elemento</th>
                   <th>Estado del Procedimiento</th>
                   <th>Tipo de Procedimiento</th>
                   <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="mensaje-vacio" style="display: none;">
                    <td colspan="12">No se encontraron registros</td>
                </tr>
                @foreach ($procedimiento as $procedimiento)
                <tr class="estado-{{ str_replace(' ', '-', $procedimiento->estadoProcedimiento->estado) }}">
                    <td>
                        {{ $procedimiento->idProcedimiento }}
                    </td>
                    <td>
                        {{ $procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->fechaFin ? $procedimiento->fechaFin : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->hora ? $procedimiento->hora : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->fechaReprogramada ? $procedimiento->fechaReprogramada : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->observacion }}
                    </td>
                    <td>
                        {{ $procedimiento->responsableEntrega ? $procedimiento->responsableEntrega->name : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->responsableRecibe ? $procedimiento->responsableRecibe->name : 'No aplica' }}
                    </td>
                    <td>
                        {{ $procedimiento->elemento->modelo }}
                    </td>
                    <td>
                        {{ $procedimiento->estadoProcedimiento->estado }}
                    </td>
                    <td>
                        {{ $procedimiento->tipoProcedimiento->tipo }}
                    </td>
                    <td>
                        <a href="{{ route('editProcedimiento', $procedimiento->idProcedimiento) }}">Editar</a>
                        <form action="{{ route('destroyProcedimiento', ['id' => $procedimiento->idProcedimiento]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

</div>


{{--
    ============================================================
    Funcion de filtrado con los botones
    ============================================================
--}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const menuItems = document.querySelectorAll('.menu a');
    const tableRows = document.querySelectorAll('tbody tr');
    const mensajeVacio = document.querySelector('.mensaje-vacio'); // Obtener la fila de mensaje vacío

    menuItems.forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            const filtro = event.target.getAttribute('data-filtro');
            let filasVisibles = 0;

            tableRows.forEach(row => {
                const estado = row.classList[0].replace('estado-', '');
                console.log(estado);
                if (filtro === estado || filtro === 'Todos') {
                    row.style.display = '';
                    filasVisibles++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Mostrar el mensaje de "No se encontraron registros" si no hay filas visibles
            mensajeVacio.style.display = filasVisibles === 0 ? 'table-row' : 'none';
        });
    });
});
    </script>

@endsection
