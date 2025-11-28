<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoReserva extends Model
{
    protected $table = 'estadoreserva';
    protected $primaryKey = 'id_estadoserva';
    public $timestamps = false;

    protected $fillable = [
        'nombre_estado', 
    ];

    // Relación con citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_estadoserva', 'id_estadoserva');
    }

    // Relación con eventos
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_estado', 'id_estadoserva');
    }
}
