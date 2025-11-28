<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CitaController extends Controller
{
    /**
     * MOSTRAR FORMULARIO DE CITA
     */
    public function create($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);

        return view('user.create_cita', compact('evento'));
    }

    /**
     * GUARDAR CITA
     */
    public function store(Request $request)
    {
        //Validación
        $request->validate([
            'nombre'      => 'required|string|max:60',
            'telefono'    => 'required|string|max:20',
            'correo'      => 'required|email|max:100',
            'fecha_cita'  => 'required|date|after_or_equal:today',
            'hora_cita'   => 'required',
            'tipo_evento' => 'required|string|max:100',
            'id_evento'   => 'required|exists:eventos,id_evento',
        ]);

        // Guardar cita
        Cita::create([
            'nombre'         => $request->nombre,
            'telefono'       => $request->telefono,
            'correo'         => $request->correo,
            'fecha_cita'     => $request->fecha_cita,
            'hora_cita'      => $request->hora_cita,
            'tipo_evento'    => $request->tipo_evento,
            'fecha_registro' => Carbon::now(),
            'id_usuario'     => Auth::id(),
            'id_evento'      => $request->id_evento,
            'id_estadoserva' => 1, // PENDIENTE
        ]);

        return redirect()
            ->route('eventos.index')
            ->with('success', 'Tu cita fue enviada y está pendiente de aprobación');
    }
}
