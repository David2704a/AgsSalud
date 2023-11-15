<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedor = new Proveedor();
        $proveedor->nombre = 'proveedor1';
        $proveedor->nit = 123456789;
        $proveedor->telefono = '323554574';
        $proveedor->correoElectronico = 'proveedor1@gmail.com';
        $proveedor->direccion = 'calle 4 # 55-55';
        $proveedor->save();

        $proveedor = new Proveedor();
        $proveedor->nombre = 'proveedor2';
        $proveedor->nit = 123456789;
        $proveedor->telefono = '323554574';
        $proveedor->correoElectronico = 'proveedor2@gmail.com';
        $proveedor->direccion = 'calle 4 # 55-55';
        $proveedor->save();

        $proveedor = new Proveedor();
        $proveedor->nombre = 'proveedor3';
        $proveedor->nit = 123456789;
        $proveedor->telefono = '323554574';
        $proveedor->correoElectronico = 'proveedor3@gmail.com';
        $proveedor->direccion = 'calle 4 # 55-55';
        $proveedor->save();

        $proveedor = new Proveedor();
        $proveedor->nombre = 'proveedor4';
        $proveedor->nit = 123456789;
        $proveedor->telefono = '323554574';
        $proveedor->correoElectronico = 'proveedor4@gmail.com';
        $proveedor->direccion = 'calle 4 # 55-55';
        $proveedor->save();
    }
}
