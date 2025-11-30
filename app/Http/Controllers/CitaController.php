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
     * MOSTRAR FORMULARIO PARA SOLICITAR CITA
     */
    public function create($id_evento)
    {
        $evento = Evento::findOrFail($id_evento);

        // Evitar que un evento tenga más de una cita
        if ($evento->cita) {
            return redirect()
                ->route('eventos.index')
                ->with('warning', 'Este evento ya tiene una cita registrada.');
        }

        return view('user.create_cita', compact('evento'));
    }

    /**
     * GUARDAR CITA
     */
    public function store(Request $request)
    {
        // VALIDACIÓN
        $request->validate([
            'nombre'        => 'required|string|max:60',
            'telefono'      => 'required|string|max:20',
            'correo'        => 'required|email|max:100',
            'fecha_cita'    => 'required|date|after_or_equal:today',
            'hora_cita'     => 'required',
            'tipo_evento'   => 'required|string|max:100',
            'id_evento'     => 'required|exists:eventos,id_evento',
        ]);

        // Verificar que el evento no tenga ya una cita
        $evento = Evento::findOrFail($request->id_evento);

        if ($evento->cita) {
            return redirect()
                ->route('eventos.index')
                ->with('warning', 'Este evento ya tiene una cita registrada.');
        }

        // 🔒 VALIDACIÓN CLAVE (NUEVA)
        $fechaEvento = Carbon::parse($evento->fecha_evento)->startOfDay();
        $fechaCita   = Carbon::parse($request->fecha_cita)->startOfDay();

        // Bloquear día del evento y cualquier día posterior
        if ($fechaCita->greaterThanOrEqualTo($fechaEvento)) {
            return back()->withErrors([
                'fecha_cita' => 'No se puede solicitar una cita el día del evento ni en fechas posteriores.'
            ])->withInput();
        }

        // CREAR CITA
        Cita::create([
            'nombre'          => $request->nombre,
            'telefono'        => $request->telefono,
            'correo'          => $request->correo,
            'fecha_cita'      => $request->fecha_cita,
            'hora_cita'       => $request->hora_cita,
            'tipo_evento'     => $request->tipo_evento,
            'fecha_registro'  => Carbon::now(),
            'id_usuario'      => Auth::id(),
            'id_evento'       => $request->id_evento,
            'id_estadoserva'  => 1, // PENDIENTE
        ]);

        return redirect()
            ->route('eventos.index')
            ->with('success', 'Tu cita fue enviada y está pendiente de aprobación.');
    }

    /**
     * MOSTRAR ESTADO DE LA CITA (USUARIO)
     */
    public function estado($id)
    {
        $cita = Cita::with(['evento', 'estado'])
            ->where('id_cita', $id)
            ->where('id_usuario', Auth::id())
            ->firstOrFail();

        return view('user.estado_cita', compact('cita'));
    }
}
