<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camara extends Model
{
    protected $fillable = [
    'nombre',
    'ip',
    'nvr',
    'canal',
    'mac',
    'ubicacion',
    'estado',
    'ultima_conexion'
];
}


