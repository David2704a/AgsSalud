<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementosFis extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'elememtosfis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_dispo', 
        'idCategoria', 
        'marca', 
        'idUser', 
        'estado_oficina', 
        'idEstado', 
        'observacion', 
        'sede', 
        'ubicacion_interna', 
        'ubicacion_especifica',
        'codigo'
    ];
}