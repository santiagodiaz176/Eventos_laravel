<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\ServicioContratado;
use App\Models\Comida;
use App\Models\Bebida;
use App\Models\Salon;
use App\Models\Decoracion;

class AController extends Controller
{
public function index(Request $request)
{
    $usuarios = Usuario::all();
    $citas = Cita::with(['usuario', 'estado', 'evento'])->get();
    
    // Nueva query para servicios
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
    $suscripcionesCount = $citasConServicios->count(); // Cambiado para reflejar citas con servicios

    return view('admin.admin', compact(
        'usuarios',
        'citas',
        'citasConServicios',
        'usuariosCount',
        'citasCount',
        'suscripcionesCount'
    ));
}


}