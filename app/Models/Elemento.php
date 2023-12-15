<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    use HasFactory;

    protected $table = 'elemento';
    protected $primaryKey = 'idElemento';
    protected $fillable = [
        'idElemento',
        'marca',
        'referencia',
        'serial',
        'modelo',
        'garantia',
        'valor',
        'descripcion',
        'idEstadoEquipo',
        'idTipoElemento',
        'idCategoria',
        'idFactura',
        'idUsuario',
    ];
    public $timestamps = true;


    public function tipoElemento()  {
        return $this->belongsTo(TipoElemento::class, 'idTipoElemento');
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'idCategoria');
    }

    public function estado() {
        return $this->belongsTo(EstadoElemento::class, 'idEstadoEquipo');
    }

    public function factura() {
        return $this->belongsTo(Factura::class, 'idFactura');
    }

    public function user() {
        return $this->belongsTo(user::class, 'idUsuario');
    }

    public function procedimiento() {
        return $this->hasOne(Procedimiento::class, 'idElemento');
    }
}
