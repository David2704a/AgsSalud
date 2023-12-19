<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name"=> "Johan",
            "email"=> "admin@gmail.com",
            'idPersona' => 4,
            "password"=> bcrypt("1234567890")
        ]);
        $user->assignRole('administrador');

        $user = User::create([
            "name"=> "JuanOrozco",
            "email"=> "juanjoseorozco9@gmail.com",
            "idPersona" => 3,
            "password"=> bcrypt("1234567890")
        ]);
        $user->assignRole('superAdmin');
        
        $user = User::create([
            "name"=> "Pedro",
            "email"=> "tecnico@gmail.com",
            "password"=> bcrypt("1234567890")
        ]);
        $user->assignRole('tecnico');

        $user = User::create([
            "name"=> "andres",
            "email"=> "colaborador@gmail.com",
            "password"=> bcrypt("1234567890")
        ]);
        $user->assignRole('colaborador');
    }
}
