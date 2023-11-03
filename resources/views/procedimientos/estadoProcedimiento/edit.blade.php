<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Edit Estado Procedimiento</h1>
   <form action="{{route('updateEstadoP', ['id'=> $estadoProcedimiento->idEstadoP])}}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="idEstadoP" value="{{$estadoProcedimiento->idEstadoP}}">
    <div class="form-group">
        <label for="tipo">Tipo</label>
        <input type="text" class="form-control" id="estado" name="estado" value="{{$estadoProcedimiento->estado}}">
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$estadoProcedimiento->descripcion}}">
    </div>
    <button type="submit" class="btn btn-primary">Editar</button>

    </form>


</body>
</html>
