<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true; // asegúrate que las columnas created_at y updated_at existen

    protected $fillable = [
        'usuario',
        'email',
        'clave',
        'nombre',
        'apellidos',
        'perfil',
        'estado'
    ];

    protected $hidden = [
        'clave',
        'remember_token', // si usas remember me
    ];

    /**
     * Laravel usará este campo como contraseña
     */
    public function getAuthPassword()
    {
        return $this->clave;
    }

    /**
     * Convierte automáticamente 'estado' a booleano
     */
    protected $casts = [
        'estado' => 'boolean',
    ];
}
