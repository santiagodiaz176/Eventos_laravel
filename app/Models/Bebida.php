<?php
// ==========================================
// app/Models/Bebida.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    protected $table = 'bebidas';
    protected $primaryKey = 'id_bebida';
    
    protected $fillable = [
        'nombre_bebida',
        'descripcion',
        'precio',
        'tipo',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];
}


