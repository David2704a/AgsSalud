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
            "name"=> "adminSuperior",
            "email"=> "auxiliartics@agssalud.com",
            "password"=> bcrypt("agssalud2024")
        ]);
        $user->assignRole('superAdmin');
    }
}
