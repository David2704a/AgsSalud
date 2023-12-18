<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Persona::create([
            'nombre1' => 'Juan',
            'apellido1' => 'Pérez',
            'idTipoIdentificacion' => 1, // Reemplaza con el ID correcto del tipo de identificación
            'identificacion' => '123456789',
            'fechaNac' => '1990-01-01',
            'sexo' => 'M',
            'direccion' => 'Calle 123',
            'email' => 'juan@example.com',
            'celular' => '1234567890',
        ]);
        Persona::create([
            'nombre1' => 'Andres',
            'apellido1' => 'Galindez',
            'idTipoIdentificacion' => 1, // Reemplaza con el ID correcto del tipo de identificación
            'identificacion' => '1234567891',
            'fechaNac' => '1990-01-01',
            'sexo' => 'M',
            'direccion' => 'Calle 123',
            'email' => 'juan@example.com',
            'celular' => '1234567890',
        ]);
        Persona::create([
            'nombre1' => 'Juan',
            'apellido1' => 'Orozco',
            'idTipoIdentificacion' => 1, // Reemplaza con el ID correcto del tipo de identificación
            'identificacion' => '1234567892',
            'fechaNac' => '1990-01-01',
            'sexo' => 'M',
            'direccion' => 'Calle 123',
            'email' => 'Juan@gmail.com',
            'celular' => '1234567890',
        ]);
        Persona::create([
            'nombre1' => 'Johan',
            'apellido1' => 'Bolaños',
            'idTipoIdentificacion' => 1, // Reemplaza con el ID correcto del tipo de identificación
            'identificacion' => '1234567893',
            'fechaNac' => '1990-01-01',
            'sexo' => 'M',
            'direccion' => 'Calle 123',
            'email' => 'johan@gmail.com',
            'celular' => '1234567890',
        ]);

    }
}
