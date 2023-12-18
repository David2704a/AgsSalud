<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class elementonoid extends Model
{
    protected $table = 'elemento';
    protected $primaryKey = 'idElemento';
    protected $fillable = [
        'cantidad',
        'idCategoria',
        'marca',
        'referencia',
        'descripcion',
  
        
    ];
    public $timestamps = true;


    public function categoria() {
        return $this->belongsTo(Categoria::class, 'idCategoria');
    }
}
