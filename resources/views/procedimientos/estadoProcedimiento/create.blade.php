<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Create Estado Procedimiento</h1>

    <form action="{{route('storeEstadoP')}}" method="POST">
    @csrf
    <label for="estado">Estado</label>
    <input type="text" name="estado" id="estado">
    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion" id="descripcion">

    <button type="submit">Crear</button>
    </form>

</body>
</html>
