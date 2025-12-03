<?php
// app/Models/ServicioContratado.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioContratado extends Model
{
    protected $table = 'servicios_contratados';
    protected $primaryKey = 'id_servicio_contratado';
    
    protected $fillable = [
        'id_cita',
        'id_evento',
        'incluye_dj',
        'incluye_sonido',
        'incluye_animador',
        'id_salon',
        'id_decoracion',
        'subtotal',
        'iva',
        'total',
        'estado',
        'fecha_envio',
        'fecha_aprobacion',
    ];

    protected $casts = [
        'incluye_dj' => 'boolean',
        'incluye_sonido' => 'boolean',
        'incluye_animador' => 'boolean',
        'subtotal' => 'decimal:2',
        'iva' => 'decimal:2',
        'total' => 'decimal:2',
        'fecha_envio' => 'datetime',
        'fecha_aprobacion' => 'datetime',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita', 'id_cita');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
    }

    public function salon()
    {
        return $this->belongsTo(Salon::class, 'id_salon', 'id_salon');
    }

    public function decoracion()
    {
        return $this->belongsTo(Decoracion::class, 'id_decoracion', 'id_decoracion');
    }

    public function comidas()
    {
        return $this->belongsToMany(Comida::class, 'servicio_comidas', 'id_servicio_contratado', 'id_comida')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal')
                    ->withTimestamps();
    }

    public function bebidas()
    {
        return $this->belongsToMany(Bebida::class, 'servicio_bebidas', 'id_servicio_contratado', 'id_bebida')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal')
                    ->withTimestamps();
    }
}










