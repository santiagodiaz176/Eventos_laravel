<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HorarioAtencion;

class Cita extends Model
{
    protected $table = 'citas';
    protected $primaryKey = 'id_cita';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'fecha_cita',
        'hora_cita',
        'tipo_evento',
        'fecha_registro',
        'id_usuario',
        'id_evento',
        'id_estadoserva',
        'id_horario', 
    ];

    // RELACIONES
    public function estado()
    {
        return $this->belongsTo(EstadoReserva::class, 'id_estadoserva');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }

    public function horario()
    {
        return $this->belongsTo(HorarioAtencion::class, 'id_horario', 'id_horario');
    }

    public function serviciosContratados()
    {
    return $this->hasOne(ServicioContratado::class, 'id_cita', 'id_cita');
    }

}
