<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $table = 'salones';
    protected $primaryKey = 'id_salon';
    
    protected $fillable = [
        'nombre_salon',
        'direccion',
        'zona',
        'capacidad',
        'precio',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];
}