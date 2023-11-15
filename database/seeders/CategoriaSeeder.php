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
            'nombre' => 'Portatil',
            'descripcion' => 'Portatil',
        ]);
        Categoria::create([
            'nombre' => 'Movil',
            'descripcion' => 'Movil',
        ]);
        Categoria::create([
            'nombre' => 'Impresora',
            'descripcion' => 'Impresora',
        ]);
        Categoria::create([
            'nombre' => 'Mouse',
            'descripcion' => 'Mouse',
        ]);
        Categoria::create([
            'nombre' => 'Teclado',
            'descripcion' => 'Teclado',
        ]);
        Categoria::create([
            'nombre' => 'Monitor',
            'descripcion' => 'Monitor',
        ]);
        Categoria::create([
            'nombre' => 'Silla',
            'descripcion' => 'Silla',
        ]);
    }
}
