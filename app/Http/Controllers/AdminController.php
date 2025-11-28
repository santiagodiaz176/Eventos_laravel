<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cita;
use App\Models\Suscripcion;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        $citas = Cita::all();
        $suscripciones = Suscripcion::all();

        return view('admin.admin', [
            'usuarios' => $usuarios,
            'citas' => $citas,
            'suscripciones' => $suscripciones,
            'usuariosCount' => $usuarios->count(),
            'citasCount' => $citas->count(),
            'suscripcionesCount' => $suscripciones->count(),
        ]);
    }
}
