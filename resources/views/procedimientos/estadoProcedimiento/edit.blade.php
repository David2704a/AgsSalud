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

    <form action="{{route('updateEstadoP', ['id', $estadoProcedimiento->idEstadoP])}}" method="POST">
    @csrf
    @method('PUT')
    <label for="Estado">Estado</label>
    <input type="text" name="estado" id="estado" value="{{$estadoProcedimiento->estado}}">
    <input type="text" name="descripcion" id="descripcion" value="{{$estadoProcedimiento->descripcion}}">

    <button type="submit">Editar</button>
</form>

</body>
</html>
