<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EstadoProcedimientoSeeder::class);
        $this->call(TipoProcedimientoSeeder::class);
        $this->call(EstadoElementoSeeder::class);
        $this->call(TipoElementoSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ElementoSeeder::class);
        $this->call(ProveedorSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
