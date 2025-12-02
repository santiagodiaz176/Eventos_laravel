<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HorarioAtencion;
use Illuminate\Http\Request;

class HorarioAtencionController extends Controller
{
    // Mostrar formulario (ver / editar)
    public function index()
    {
        $horario = HorarioAtencion::first(); // SOLO UNO
        return view('admin.horarios.form', compact('horario'));
    }

    // Guardar o actualizar
    public function store(Request $request)
    {
        $request->validate([
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        HorarioAtencion::updateOrCreate(
            ['id_horario' => 1], // siempre el mismo registro
            [
                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin,
            ]
        );

        return redirect()
        ->route('admin.index', ['tab' => 'citas'])
        ->with('success', 'Horario de atención guardado correctamente.');
    }
}
