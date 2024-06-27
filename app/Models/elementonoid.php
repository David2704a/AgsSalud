<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class elementonoid extends Model
{
    protected $table = 'elementonoid';
    protected $fillable = [
        'cantidad',
        'dispositivo',
        'marca',
        'referencia',
        'descripcion',
        
    ];
    public $timestamps = true;



}
