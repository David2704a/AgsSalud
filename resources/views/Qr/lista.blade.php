<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('css/estilos-pdf.css') }}">

</head>
<body>
    @foreach ($datos as $dato)
    <div class="contenido">
        <table class="tabla">
            <tr>
                <td>
                    <img src="{{ public_path('img/versión 1 Dos colores-Recuperado.png') }}" alt="QR Code" width="100px"/>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{ $dato->codigo }}" alt="QR Code" width="100px"/>
                </td>
            </tr>
            <tr>
                <td>
                    {{ $dato->id_dispo }}
                </td>
            </tr>
        </table>
    </div>
    @endforeach
</body>
</html>
