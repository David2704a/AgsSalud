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
        User::create([
            "name"=> "Johan",
            "email"=> "johan@gmail.com",
            'idPersona' => 4,
            "password"=> bcrypt("123")
        ]);
        $user = User::create([
            "name"=> "JuanOrozco",
            "email"=> "juanjoseorozco9@gmail.com",
            "idPersona" => 3,
            "password"=> bcrypt("1234567890")
        ]);
        $user->assignRole('superAdmin');
        
        User::create([
            "name"=> "Pedro",
            "email"=> "pedro@gmail.com",
            "password"=> bcrypt("123")
        ]);
    }
}
