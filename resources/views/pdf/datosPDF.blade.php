
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos prueba Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

    @foreach ($elementos as $elemento)
    <table id="table-descripcion" class="table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 100px;">DESCRIPCIÓN</th>
                <th rowspan="2" style="width: 100px;">MARCA</th>
                <th rowspan="2" style="width: 100px;">MODELO</th>
                <th rowspan="2" style="width: 100px;">N° SERIAL</th>
                <th colspan="2" style="width: 100px;">ESTADO</th>
            </tr>
            <tr>
                <th style="padding: 2px 0; width: 100px;">B</th>
                <th style="padding: 2px 0; width: 100px;">M</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{$elemento->descripcion}}</td>
                <td>{{$elemento->marca}}</td>
                <td>{{$elemento->modelo}}</td>
                <td>{{$elemento->serial}}</td>
                @if($elemento->estado)
                <td>{{$elemento->estado->idEstadoE}}</td>
                <td>{{$elemento->estado->estado}}</td>
            @else
                <td colspan="2">Sin Estado</td>
            @endif
            <td style="width: 50px;"><button class="btn btn-primary">Ver</button></td>
            </tr>
        </tbody>

    </table>

    @endforeach

    <style>
        
        #table-descripcion {
            width: 100%;
            padding: 0 20px;
        }
        #table-descripcion thead tr th{
            padding: 5px 0;
            border: 1px solid black;
            text-align: center;
        }
        #table-descripcion td {
            border: 1px solid black;
            padding: 2px;
            height: 5px;
        }
    </style>
    
</body>
</html>