<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Edit de Tipo Procedimiento</h1>

    <form action="{{route('updateTipoP', ['id'=> $tipoProcedimiento->idTipoProcedimiento])}}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="idTipoProcedimiento" value="{{$tipoProcedimiento->idTipoProcedimiento}}">
    <div class="form-group">
        <label for="tipo">Tipo</label>
        <input type="text" class="form-control" id="tipo" name="tipo" value="{{$tipoProcedimiento->tipo}}">
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$tipoProcedimiento->descripcion}}">
    </div>
    <button type="submit" class="btn btn-primary">Editar</button>

    </form>

</body>
</html>
