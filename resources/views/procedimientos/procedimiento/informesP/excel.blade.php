



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
                <th>Estado del procedimiento</th>
                <th>Tipo de procedimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($procedimientos as $procedimiento)
            <tr style="background-color: #000000;">
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
            </tr>
            @endforeach
        </tbody>

    </table>



    <style>
        td {
            background-color: #000000;
        }
    </style>
