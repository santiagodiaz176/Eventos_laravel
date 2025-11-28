<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    protected $table = 'suscripciones';

    protected $primaryKey = 'id_suscripcion';

    public $timestamps = false; 
    // NO usamos created_at / updated_at
    // porque tu migración usa fecha_registro

    protected $fillable = [
        'id_usuario',
        'correo',
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'fecha_registro'
    ];

    // RELACIÓN: una suscripción pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
