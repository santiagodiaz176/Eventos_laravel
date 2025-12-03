<?php

// ==========================================
// app/Models/Comida.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comida extends Model
{
    protected $table = 'comidas';
    protected $primaryKey = 'id_comida';
    
    protected $fillable = [
        'nombre_comida',
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

