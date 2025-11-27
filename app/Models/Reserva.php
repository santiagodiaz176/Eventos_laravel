<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'usuario_id',
        'nombre',
        'celular',
        'correo',
        'fecha',
        'tipo_evento',
    ];
}

