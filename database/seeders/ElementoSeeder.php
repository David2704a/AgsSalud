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
            "idTipoElemento"=> 1,
            "idEstadoEquipo"=> 1,
            "idCategoria"=> 1,
            "idUsuario"=> 1,
            "idFactura"=> 1,
            "descripcion"=> "Asus ROG Strix",
            "serial" => "124789",
            "garantia"=> "1 año",
            "valor"=> "2500000",
            "referencia"=> "Asus ROG Strix",
        ]);
        Elemento::create([
            "marca"=> "Asus",
            "modelo"=> "TUF",
            "idTipoElemento"=> 1,
            "idEstadoEquipo"=> 2,
            "idCategoria"=> 1,
            "idUsuario"=> 2,
            "idFactura"=> 1,
            "descripcion"=> "TUF",
            "serial" => "4795qf",
            "garantia"=> "1 año",
            "valor"=> "3700000",
            "referencia"=> "TUF",
        ]);
        Elemento::create([
            "marca"=> "Acer",
            "modelo"=> "Nitro 5",
            "idTipoElemento"=> 1,
            "idEstadoEquipo"=> 2,
            "idCategoria"=> 1,
            "idFactura"=> 1,
            "idUsuario"=> 3,
            "descripcion"=> "Nitro 5",
            "serial" => "7sd8q",
            "garantia"=> "1 año",
            "valor"=> "4500000",
            "referencia"=> "Nitro 5",
        ]);
        Elemento::create([
            "marca"=> "Silla reclinable",
            "modelo"=> "Gamer",
            "idTipoElemento"=> 2,
            "idEstadoEquipo"=> 2,
            "idCategoria"=> 7,
            "idUsuario"=> 3,
            "idFactura"=> 1,
            "descripcion"=> "Gamer, silla reclinable",
            "serial" => "7sd8q",
            "garantia"=> "3 meses",
            "valor"=> "700000",
            "referencia"=> "Gamer, silla reclinable",
        ]);
    }
}
