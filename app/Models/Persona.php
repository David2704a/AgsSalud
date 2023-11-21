<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'persona';

    protected $fillable = [
        "nombre1",
        "nombre2",
        "apellido1",
        "apellido2",
        "idTipoIdentificacion",
        "identificacion",
        "fechaNac",
        "sexo",
        
        "direccion",
        "email",
       
        "celular",
        
    ];
    
    public function usuario(){
        return $this->hasOne(User::class, 'idPersona');
    }

    public function tipoIdentificacion(){
        return $this->belongsTo(tipoIdentificacion::class, 'idTipoIdentificacion');
    }


}
