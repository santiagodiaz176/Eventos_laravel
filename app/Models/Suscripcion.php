<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    protected $table = 'suscripciones';
    protected $primaryKey = 'id_suscripcion';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'correo',
        'estado',
        'fecha_registro'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
