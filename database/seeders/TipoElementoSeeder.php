<?php

namespace Database\Seeders;

use App\Models\TipoElemento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoElementoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoElemento::create([
            'tipo' => 'Electronico',
            'descripcion' => 'Electronico'
        ]);

        TipoElemento::create([
            'tipo' => 'Inmueble',
            'descripcion' => 'Inmueble'
        ]);
    }
}
