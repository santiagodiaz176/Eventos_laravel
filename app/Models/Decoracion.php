<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decoracion extends Model
{
    protected $table = 'decoraciones';
    protected $primaryKey = 'id_decoracion';
    
    protected $fillable = [
        'tipo_decoracion',
        'descripcion',
        'precio',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];
}
