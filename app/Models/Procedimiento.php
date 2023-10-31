<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{

    use HasFactory;
    protected $table = 'procedimiento';
    protected $primaryKey = 'idProcedimiento';

    protected $fillable = [
        'fechaInicio',
        'fechaFin',
        'hora',
        'fechaReprogramada',
        'observacion',
        'idResponsableEntrega',
        'idResponsableRecibe',
        'idElemento',
        'idEstadoProcedimiento',
        'idTipoProcedimiento',
    ];

    public function responsableEntrega()
    {
        return $this->belongsTo(User::class, 'idResponsableEntrega');
    }

    public function responsableRecibe()
    {
        return $this->belongsTo(User::class, 'idResponsableRecibe');
    }

    public function elemento()
    {
        return $this->belongsTo(Elemento::class, 'idElemento');
    }

    public function estadoProcedimiento()
    {
        return $this->belongsTo(EstadoProcedimiento::class, 'idEstadoProcedimiento');
    }

    public function tipoProcedimiento()
    {
        return $this->belongsTo(TipoProcedimiento::class, 'idTipoProcedimiento');
    }
}
