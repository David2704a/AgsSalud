<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
     
        Categoria::create([
            'nombre' => 'IMPRESORA',
            'descripcion' => 'Impresora',
        ]);
        Categoria::create([
            'nombre' => 'MOUSE',
            'descripcion' => 'Mouse',
        ]);
        Categoria::create([
            'nombre' => 'TECLADO',
            'descripcion' => 'Teclado',
        ]);
        Categoria::create([
            'nombre' => 'MONITOR',
            'descripcion' => 'Monitor',
        ]);
      
    }
}
