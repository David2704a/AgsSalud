<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Creacion Tipo procedimiento</h1>

    <form action="{{route('storeTipoP')}}" method="POST">
    @csrf

    <label for="tipo">Tipo</label>
    <input type="text" name="tipo" id="tipo">
    <br>
    <label for="descripcion">Descripcion
        </label>
    <input type="text" name="descripcion" id="descripcion">

    <button type="submit">registrar</button>

    </form>

</body>
</html>
