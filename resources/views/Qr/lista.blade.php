<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('css/estilos-pdf.css') }}">
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        @page {
            margin-top: 120px ;
            margin-bottom: -20px ;
        }
        header {
            position: fixed;
            top: -120px;
            text-align: center;
            opacity: 10;
        }
    </style>
</head>
<body>
    <header>
        <p style="font-size: 10px; margin-top:50px; text-align: right;"><i><span class="page-number"><b>Página </b></span></i></p>
    </header>
    @php
        $j = 0;
    @endphp
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
        @php
            $j++;
        @endphp
        @if ($j == 18)
        @php
            $j = 0;
        @endphp
        <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
