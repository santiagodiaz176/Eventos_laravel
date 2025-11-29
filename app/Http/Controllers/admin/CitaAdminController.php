<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaAdminController extends Controller
{
    /**
     * Mostrar todas las citas
     */
    public function index()
    {
        // Cargar relaciones para evitar consultas adicionales
        $citas = Cita::with(['estado', 'usuario', 'evento'])->get();

        return view('admin.citas.index', compact('citas'));
    }

    /**
     * Vista para gestionar cita (posponer)
     */
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);

        return view('admin.citas.posponer', compact('cita'));
    }

    /**
     * Actualizar cita según acción del administrador
     */
    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

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

                $cita->fecha_cita    = $request->fecha_cita;
                $cita->hora_cita     = $request->hora_cita;
                $cita->id_estadoserva = 4; // ✅ Pospuesta
                break;

            case 'cancelar':
                $cita->id_estadoserva = 3; // ✅ Cancelada/Rechazada
                break;
        }

        $cita->save();

        // Redirigir a la vista de panel de administración con citas
        return redirect()
            ->route('admin.citas.index')
            ->with('success', 'Estado de la cita actualizado correctamente');
    }

    /**
     * Cancelar cita (solo se marca como cancelada)
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->id_estadoserva = 3; // Cancelada
        $cita->save();

        return redirect()
            ->route('admin.citas.index')
            ->with('success', 'Cita cancelada correctamente');
    }

    /**
     * Crear evento a partir de una cita aprobada
     */
    public function crearEvento($id_cita)
    {
        $cita = Cita::findOrFail($id_cita);

        if ($cita->id_estadoserva !== 2) {
            // Si la cita no está aprobada, redirigir a panel de citas
            return redirect()
               ->route('admin.citas.index')
               ->with('success', 'Estado de la cita actualizado correctamente');
        }

        return view('admin.eventos.create', compact('cita'));
    }
}
