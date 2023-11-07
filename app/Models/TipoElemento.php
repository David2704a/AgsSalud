<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoElemento extends Model
{
    use HasFactory;

    protected $table = 'tipoElemento';
    protected $primaryKey = 'idTipoElemento';

    protected $fillable = [
        'tipo',
        'descripcion'
    ];

    public $timestamps = true;
}
