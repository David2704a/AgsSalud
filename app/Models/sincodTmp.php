<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sincodTmp extends Model
{
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sincodTmp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_dispo',
        'dispositivo',
        'marca',
        'referencia',
        'serial',
        'procesador',
        'ram',
        'disco_duro',
        'tarjeta_grafica',
        'documento',
        'nombres_apellidos',
        'fecha_compra',
        'garantia',
        'numero_factura',
        'proveedor',
        'estado',
        'observacion',
        'cantidad',
    ];
}
