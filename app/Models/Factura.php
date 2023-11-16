<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'factura';
    protected $primaryKey = 'idFactura';

    protected $fillable = [
        'codigoFactura',
        'fechaCompra',
        'idProveedor',
        'metodoPago',
        'estadoPago',
        'valor',
        'descripcion'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }
}
