<?php

namespace Database\Seeders;

use App\Models\Elemento;
use Illuminate\Database\Seeder;

class ElementoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Elemento::create([
            "marca"=> "Asus",
            "modelo"=> "ROG Strix",
            "ram" => "8 ram",
            "procesador" => "intel core i5",
            "disco_duro" => "ssd 500gb",
            "tarjeta_grafica" => "RTX 3050 4gb",
            "idTipoElemento"=> 1,
            "idEstadoEquipo"=> 1,
            "idCategoria"=> 1,
            "idUsuario"=> 1,
            "idFactura"=> 1,
            "descripcion"=> "Asus ROG Strix",
            "serial" => "124789",
            "garantia"=> "1 año",
            "referencia"=> "Asus ROG Strix",
        ]);
        Elemento::create([
            "marca"=> "Asus",
            "modelo"=> "TUF",
            "ram" => "8 ram",
            "procesador" => "intel core i5",
            "disco_duro" => "ssd 500gb",
            "tarjeta_grafica" => "RTX 3050 4gb",
            "idTipoElemento"=> 1,
            "idEstadoEquipo"=> 2,
            "idCategoria"=> 1,
            "idUsuario"=> 2,
            "idFactura"=> 1,
            "descripcion"=> "TUF",
            "serial" => "4795qf",
            "garantia"=> "1 año",
            "referencia"=> "TUF",
        ]);
        Elemento::create([
            "marca"=> "Acer",
            "modelo"=> "Nitro 5",
            "ram" => "8 ram",
            "procesador" => "intel core i5",
            "disco_duro" => "ssd 500gb",
            "tarjeta_grafica" => "RTX 3050 4gb",
            "idTipoElemento"=> 1,
            "idEstadoEquipo"=> 2,
            "idCategoria"=> 1,
            "idFactura"=> 1,
            "idUsuario"=> 3,
            "descripcion"=> "Nitro 5",
            "serial" => "7sd8q",
            "garantia"=> "1 año",
            "referencia"=> "Nitro 5",
        ]);
        Elemento::create([
            "marca"=> "Silla reclinable",
            "modelo"=> "Gamer",
            "idTipoElemento"=> 2,
            "idEstadoEquipo"=> 2,
            "idCategoria"=> 4,
            "idUsuario"=> 3,
            "idFactura"=> 1,
            "descripcion"=> "Gamer, silla reclinable",
            "serial" => "7sd8q",
            "garantia"=> "3 meses",
            "referencia"=> "Gamer, silla reclinable",
        ]);

    }
}
