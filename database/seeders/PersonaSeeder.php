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
    
            "nombre1"=> "vanesa",
            "nombre2"=> "vanesa",
            "apellido1"=> "vanesa",
            "identificacion"=>"1233445567899"
           
        ]);
    }
}
