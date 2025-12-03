<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cita;
use App\Models\Suscripcion;
use Illuminate\Http\Request;
use App\Models\ServicioContratado; 

class AdminController extends Controller
{
    public function index(Request $request)
{
    $usuarios = Usuario::all();
    $citas = Cita::with(['usuario', 'estado', 'evento'])->get();
    $suscripciones = Suscripcion::all();
    
    // Nueva query para servicios - SOLO citas aprobadas
    $citasConServicios = Cita::with([
        'usuario',
        'evento.tipoevento',
        'serviciosContratados.salon',
        'serviciosContratados.decoracion',
    ])
    ->whereHas('estado', function($query) {
        $query->where('nombre_estado', 'Aprobada');
    })
    ->get();

    $usuariosCount = $usuarios->count();
    $citasCount = $citas->count();
    $suscripcionesCount = $citasConServicios->count();

    return view('admin.admin', compact(
        'usuarios',
        'citas',
        'suscripciones',
        'citasConServicios',  // ← Agregamos esta variable
        'usuariosCount',
        'citasCount',
        'suscripcionesCount'
    ));
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