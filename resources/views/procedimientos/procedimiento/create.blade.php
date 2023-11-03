<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Crear un procedimiento</h1>

    <form action="{{ route('storeProcedimiento') }}" method="POST">
        @csrf
        <label for="fechaInicio">Fecha Inicio</label>
        <input type="date" name="fechaInicio" id="fechaInicio">
        <label for="fechaFin">Fecha Fin</label>
        <input type="date" name="fechaFin" id="fechaFin">
        <label for="hora">Hora</label>
        <input type="time" name="hora" id="hora">
        <label for="fechaReprogramada">Fecha Reprogramada</label>
        <input type="date" name="fechaReprogramada" id="fechaReprogramada">
        <label for="observacion">Observacion</label>
        <input type="text" name="observacion" id="observacion">
        <label for="idResponsableEntrega">Responsable Entrega</label>
        <select name="idResponsableEntrega" id="idResponsableEntrega">
            <option value="">Seleccionar una opción</option>
            @foreach ($usuario as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
            @endforeach
        </select>
        {{-- <label for="idResponsableRecibe">Responsable Recibe</label>
        <select name="idResponsableRecibe" id="idResponsableRecibe">
            <option value="">Seleccionar una opción</option>
            @foreach ($usuario as $usuario)
                <option value="{{ $usuario->idResponsableRecibe }}">{{ $usuario->name }}</option>
            @endforeach
        </select> --}}
        <label for="idElemento">Elemento</label>
        <select name="idElemento" id="idElemento">
            <option value="">Seleccionar una opción</option>
            @foreach ($elemento as $elemento)
                <option value="{{ $elemento->idElemento }}">{{ $elemento->modelo }}</option>
            @endforeach
        </select>
        <label for="idEstadoProcedimiento">Estado Procedimiento</label>
        <select name="idEstadoProcedimiento" id="idEstadoProcedimiento">
            <option value="">Seleccionar una opción</option>
            @foreach ($estadoProcedimiento as $estadoProcedimiento)
                <option value="{{ $estadoProcedimiento->idEstadoP }}">{{ $estadoProcedimiento->estado }}</option>
            @endforeach
        </select>
        <label for="idTipoProcedimiento">Tipo Procedimiento</label>
        <select name="idTipoProcedimiento" id="idTipoProcedimiento">
            <option value="">Seleccionar una opción</option>
            @foreach ($tipoProcedimiento as $tipoProcedimiento)
                <option value="{{ $tipoProcedimiento->idTipoProcedimiento }}">{{ $tipoProcedimiento->tipo }}</option>
            @endforeach
        </select>
        <button type="submit">Crear</button>
    </form>

</body>
</html>
