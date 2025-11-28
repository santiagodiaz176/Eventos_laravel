<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

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
    ];

    
    public function getAuthPassword()
    {
        return $this->clave;
    }
}
