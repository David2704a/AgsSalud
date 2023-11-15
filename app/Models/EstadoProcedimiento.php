<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoProcedimiento extends Model
{
    use HasFactory;

    protected $table = 'estadoProcedimiento';
    protected $primaryKey = 'idEstadoP';

    protected $fillable = [
        'estado',
        'descripcion',
    ] ;

    public function procedimiento() {

        return $this->hasMany(Procedimiento::class,'idEstadoProcedimiento');

    }
}
