<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';              
    protected $primaryKey = 'id_evento';       

    public $timestamps = false;                

    protected $fillable = [
        'nombre_evento',
        'descripcion_evento',
        'fecha_evento',
        'hora_evento',
        'lugar_evento',
        'cantidad_personas',
        'id_usuario',
        'id_tipoevento',
        'id_metodo_pago',
        'id_estado'
    ];

    
     // Relación con el estado de la reserva
     
    public function estado()
    {
        return $this->belongsTo(EstadoReserva::class, 'id_estado', 'id_estadoserva');
    }

    
     //Relación con las citas asociadas al evento
     
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_evento', 'id_evento');
    }

    
     //Relación con el tipo de evento

    public function tipo()
    {
        return $this->belongsTo(TipoEvento::class, 'id_tipoevento', 'id_tipoevento');
    }

    //Relación con el usuario que creó el evento
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
