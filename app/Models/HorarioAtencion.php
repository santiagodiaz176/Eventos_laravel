<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioAtencion extends Model
{
    protected $table = 'horarios_atencion';
    protected $primaryKey = 'id_horario';
    public $timestamps = false;

    protected $fillable = [
        'hora_inicio',
        'hora_fin',
    ];

    // 🔗 Relación con citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_horario', 'id_horario');
    }
}
