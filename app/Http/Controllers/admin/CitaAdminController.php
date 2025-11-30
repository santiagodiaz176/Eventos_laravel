<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CitaAdminController extends Controller
{
    /**
     * Mostrar todas las citas
     */
    public function index()
    {
        $citas = Cita::with(['estado', 'usuario', 'evento'])->get();
        return view('admin.citas.index', compact('citas'));
    }

    /**
     * Vista para gestionar cita (posponer)
     */
    public function edit($id)
    {
        $cita = Cita::with('evento')->findOrFail($id);
        return view('admin.citas.posponer', compact('cita'));
    }

    /**
     * Actualizar cita según acción del administrador
     */
    public function update(Request $request, $id)
    {
        $cita = Cita::with('evento')->findOrFail($id);

        $request->validate([
            'accion' => 'required|in:aceptar,posponer,cancelar'
        ]);

        switch ($request->accion) {

            case 'aceptar':
                $cita->id_estadoserva = 2; // ✅ Aprobada
                break;

            case 'posponer':

                $request->validate([
                    'fecha_cita' => 'required|date|after_or_equal:today',
                    'hora_cita'  => 'required'
                ]);

                // 🔒 VALIDACIÓN CLAVE
                $fechaEvento = Carbon::parse($cita->evento->fecha_evento)->startOfDay();
                $fechaCita   = Carbon::parse($request->fecha_cita)->startOfDay();

                if ($fechaCita->greaterThanOrEqualTo($fechaEvento)) {
                    return back()->withErrors([
                        'fecha_cita' => 'La cita debe programarse antes del día del evento.'
                    ])->withInput();
                }

                $cita->fecha_cita     = $request->fecha_cita;
                $cita->hora_cita      = $request->hora_cita;
                $cita->id_estadoserva = 4; // ✅ Pospuesta
                break;

            case 'cancelar':
                $cita->id_estadoserva = 3; // ✅ Cancelada
                break;
        }

        $cita->save();

        return redirect()
            ->route('admin.index', ['tab' => 'citas'])
            ->with('success', 'Estado de la cita actualizado correctamente');
    }

    /**
     * Cancelar cita
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->id_estadoserva = 3;
        $cita->save();

        return redirect()
            ->route('admin.index', ['tab' => 'citas'])
            ->with('success', 'Cita cancelada correctamente');
    }
}
