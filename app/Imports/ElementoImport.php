<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Elemento;
use App\Models\EstadoElemento;
use App\Models\Factura;
use App\Models\TipoElemento;
use App\Models\User;
use Dotenv\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ElementoImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Puedes agregar lógica de validación aquí si es necesario
        $this->validateRow($row);

        return new Elemento([
            'id_dispo' => $row['ID'],
            'marca' => $row['MARCA'],
            'referencia' => $row['REFERENCIA'],
            'serial' => $row['SERIAL'],
            'procesador' => $row['PROCESADOR'],
            'ram' => $row['RAM'],
            'disco_duro' => $row['DISCO DURO'],
            'tajeta_grafica' => $row['TARJETA GRAFICA'],
            'modelo' => null, // Dejamos en blanco
            'garantia' => $row['GARANTIA'],
            'valor' => null, // Dejamos vacío
            'descripcion' => $row['OBSERVACION'],
            'idEstadoEquipo' => $row['ESTADO'], // Asegúrate de que coincida con la descripción en la tabla 'estadoelemento'
            'idTipoElemento' => null, // Dejamos nulo
            'idCategoria' => $row['DISPOSITIVO'], // Asegúrate de que coincida con la descripción en la tabla 'categoria'
            'idFactura' => null, // Dejamos nulo
            'idUsuario' => null, // Dejamos nulo
        ]);
    }

    private function validateRow(array $row)
    {
        // Puedes implementar lógica de validación si es necesario
        // Puedes usar el Validador de Laravel aquí
        $validator = FacadesValidator::make($row, [
            // Define las reglas de validación aquí
        ]);

        if ($validator->fails()) {
            // Lanza una excepción o maneja los errores según tus necesidades
            throw new \Exception('Error de validación: ' . implode(', ', $validator->errors()->all()));
        }
    }
}