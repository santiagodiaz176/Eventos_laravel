<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cita;
use App\Models\Suscripcion;
use Illuminate\Http\Request;

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

    /**
     * Eliminar usuario
     */
    public function destroy($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            
            return redirect()->route('admin.dashboard')
                ->with('success', 'Usuario eliminado exitosamente');
                
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'No se pudo eliminar el usuario. Puede que tenga registros asociados.');
        }
    }
}