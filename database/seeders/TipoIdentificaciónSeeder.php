<?php

namespace Database\Seeders;

use App\Models\TipoIdentificacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoIdentificaciónSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoIdentificacion::created([
            'detalle' => 'Cedula de Ciudadania'
        ]);
    }
}
