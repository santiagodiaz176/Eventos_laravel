<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

class Usuario extends Authenticatable
{
    use Notifiable;  // ← IMPORTANTE: Agregar este trait

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true;

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
        'remember_token',
    ];

    /**
     * Laravel usará este campo como contraseña
     */
    public function getAuthPassword()
    {
        return $this->clave;
    }

    /**
     * Enviar notificación de reseteo de contraseña
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Laravel usará 'email' para buscar el usuario en password reset
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Convierte automáticamente 'estado' a booleano
     */
    protected $casts = [
        'estado' => 'boolean',
    ];
}