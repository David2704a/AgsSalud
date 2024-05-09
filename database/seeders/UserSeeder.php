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
            "email"=> "admin1@gmail.com",
            "password"=> bcrypt("1234567890")
        ]);
        $user->assignRole('administrador');

        $user = User::create([
            "name"=> "JuanOrozco",
            "email"=> "juanjoseorozco9@gmail.com",
            "password"=> bcrypt("1234567890")
        ]);
        $user->assignRole('superAdmin');
        $user = User::create([
            "name"=> "JessicaVanesa",
            "email"=> "admin@gmail.com",
            "password"=> bcrypt("1234567890")
        ]);
        $user->assignRole('superAdmin');

        
    }
}
