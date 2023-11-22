<?php

namespace Database\Seeders;

use App\Models\Factura;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factura = new Factura();
        $factura->codigoFactura = '2503309';
        $factura->fechaCompra = '2023-01-01';
        $factura->idProveedor = 1;
        $factura->metodoPago = 'Efectivo';
        $factura->rutaFactura = '';
        $factura->valor = 1000000;
        $factura->descripcion = 'factura por compra de computadores ';
        $factura->save();

        $factura = new Factura();
        $factura->codigoFactura = '2503309';
        $factura->fechaCompra = '2023-01-01';
        $factura->idProveedor = 1;
        $factura->metodoPago = 'Efectivo';
        $factura->rutaFactura = '';
        $factura->valor = 1000000;
        $factura->descripcion = 'factura por compra de computadores ';
        $factura->save();

        $factura = new Factura();
        $factura->codigoFactura = '2503309';
        $factura->fechaCompra = '2023-01-01';
        $factura->idProveedor = 1;
        $factura->metodoPago = 'Efectivo';
        $factura->rutaFactura = '';
        $factura->valor = 1000000;
        $factura->descripcion = 'factura por compra de computadores ';
        $factura->save();
        
        $factura = new Factura();
        $factura->codigoFactura = '2503309';
        $factura->fechaCompra = '2023-01-01';
        $factura->idProveedor = 1;
        $factura->metodoPago = 'Efectivo';
        $factura->rutaFactura = '';
        $factura->valor = 1000000;
        $factura->descripcion = 'factura por compra de computadores ';
        $factura->save();

        $factura = new Factura();
        $factura->codigoFactura = '2503309';
        $factura->fechaCompra = '2023-01-01';
        $factura->idProveedor = 1;
        $factura->metodoPago = 'Efectivo';
        $factura->rutaFactura = '';
        $factura->valor = 1000000;
        $factura->descripcion = 'factura por compra de computadores ';
        $factura->save();
    }
}
