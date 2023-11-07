<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoElemento extends Model
{
    use HasFactory;
    protected $table = 'estadoElemento';
    protected $fillable = [
        'estado',
        'descripcion'
    ];
    protected $primaryKey = 'idEstadoE';
}
