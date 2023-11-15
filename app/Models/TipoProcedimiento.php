<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProcedimiento extends Model
{
    use HasFactory;

    protected $table = 'tipoProcedimiento';
    protected $primaryKey = 'idTipoProcedimiento';
    protected $fillable = [
        'tipo',
        'descripcion',
    ] ;

    public function procedimiento() {

        return $this->hasMany(Procedimiento::class,'idTipoProcedimiento');
        
    }
}
