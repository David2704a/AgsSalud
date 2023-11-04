@extends('layouts.app')

@section('title', 'Procedimiento')


@section('links')

<link rel="stylesheet" href="{{asset('/css/procedimiento/procedimiento.css')}}">


@endsection

@section('content')

<div class="content">
    <h1 class="page-title">Procedimientos</h1>
    <div class="green-line"></div>

    <div class="menu-container">
        <ul class="menu">
            <li>
                <a href="#">En proceso</a>
                <div class="linea"></div>
            </li>
            <li>
                <a href="#">Terminados</a>
                <div class="linea"></div>

            </li>
            <li>
                <a href="#">Pendientes</a>
                <div class="linea active"></div>
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
                @foreach ($procedimiento as $procedimiento)
            <tr>
                <td>
                    {{$procedimiento->idProcedimiento}}
                </td>
                <td>
                    {{$procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->fechaFin ? $procedimiento->fechaFin : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->hora ? $procedimiento->hora : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->fechaReprogramada ? $procedimiento->fechaReprogramada : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->observacion}}
                </td>
                <td>
                    {{$procedimiento->idResponsableEntrega ? $procedimiento->idResponsableEntrega : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->idResponsableRecibe ? $procedimiento->idResponsableRecibe : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->elemento->modelo }}
                </td>
                <td>
                    {{$procedimiento->estadoProcedimiento->estado}}
                </td>
                <td>
                    {{$procedimiento->tipoProcedimiento->tipo}}
                </td>
                <td>
                    <a href="{{route('editProcedimiento', $procedimiento->idProcedimiento)}}">Editar</a>

                    <form action="{{route('destroyProcedimiento', ['id' => $procedimiento->idProcedimiento])}}" method="POST">
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




    {{-- <a href="{{route('createProcedimiento')}}">Crear</a>
    <a href="{{route('createEstadoP')}}">Crear estadoP</a>
    <a href="{{route('createTipoP')}}">Crear tipoP</a>

    <table>
        <thead>
            <th>
                ID
            </th>
            <th>
                fechaInicio
            </th>
            <th>
                fechaFin
            </th>
            <th>
                hora
            </th>
            <th>
                fechaReprogramada
            </th>
            <th>
                observacion
            </th>
            <th>
                idResponsableEntrega
            </th>
            <th>
                idResponsableRecibe
            </th>
            <th>
                idElemento
            </th>
            <th>
                idEstadoProcedimiento
            </th>
            <th>
                idTipoProcedimiento
            </th>
        </thead>
        <tbody>
            @foreach ($procedimiento as $procedimiento)
            <tr>
                <td>
                    {{$procedimiento->idProcedimiento}}
                </td>
                <td>
                    {{$procedimiento->fechaInicio ? $procedimiento->fechaInicio : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->fechaFin ? $procedimiento->fechaFin : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->hora ? $procedimiento->hora : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->fechaReprogramada ? $procedimiento->fechaReprogramada : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->observacion}}
                </td>
                <td>
                    {{$procedimiento->idResponsableEntrega ? $procedimiento->idResponsableEntrega : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->idResponsableRecibe ? $procedimiento->idResponsableRecibe : 'No aplica'}}
                </td>
                <td>
                    {{$procedimiento->elemento->modelo }}
                </td>
                <td>
                    {{$procedimiento->estadoProcedimiento->estado}}
                </td>
                <td>
                    {{$procedimiento->tipoProcedimiento->tipo}}
                </td>
                <td>
                    <a href="{{route('editProcedimiento', $procedimiento->idProcedimiento)}}">Editar</a>
                </td>
                <td>
                    <form action="{{route('destroyProcedimiento', ['id' => $procedimiento->idProcedimiento])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table> --}}

@endsection
