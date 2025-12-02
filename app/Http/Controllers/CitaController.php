<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Evento;
use App\Models\HorarioAtencion;
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

        // Evitar más de una cita por evento
        if ($evento->cita) {
            return redirect()
                ->route('eventos.index')
                ->with('warning', 'Este evento ya tiene una cita registrada.');
        }

        // Traer el horario definido por el admin
        $horario = HorarioAtencion::first();

        return view('user.create_cita', compact('evento', 'horario'));
    }

    /**
     * GUARDAR CITA
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:60',
            'telefono'      => 'required|string|max:20',
            'correo'        => 'required|email|max:100',
            'fecha_cita'    => 'required|date|after_or_equal:today',
            'hora_cita'     => 'required',
            'tipo_evento'   => 'required|string|max:100',
            'id_evento'     => 'required|exists:eventos,id_evento',
        ]);

        $evento = Evento::findOrFail($request->id_evento);

        // Validar que el evento no tenga cita
        if ($evento->cita) {
            return redirect()
                ->route('eventos.index')
                ->with('warning', 'Este evento ya tiene una cita registrada.');
        }

        // Validar fecha vs fecha del evento
        $fechaCita = Carbon::parse($request->fecha_cita)->startOfDay();
        $fechaEvento = Carbon::parse($evento->fecha_evento)->startOfDay();
        if ($fechaCita->greaterThanOrEqualTo($fechaEvento)) {
            return back()->withErrors([
                'fecha_cita' => 'No se puede solicitar una cita el día del evento ni después.'
            ])->withInput();
        }

        // Validar horario de atención
        $horario = HorarioAtencion::first();
        if (!$horario) {
            return back()->withErrors([
                'hora_cita' => 'No hay horario de atención configurado.'
            ])->withInput();
        }

        $horaCita = Carbon::createFromFormat('H:i', $request->hora_cita);
        $horaInicio = Carbon::createFromFormat('H:i:s', $horario->hora_inicio);
        $horaFin = Carbon::createFromFormat('H:i:s', $horario->hora_fin);

        if ($horaCita->lt($horaInicio) || $horaCita->gte($horaFin)) {
            return back()->withErrors([
                'hora_cita' => 'La hora seleccionada no está dentro del horario de atención.'
            ])->withInput();
        }

        // Validar que la hora no esté ocupada
        $ocupada = Cita::whereDate('fecha_cita', $request->fecha_cita)
            ->pluck('hora_cita')
            ->map(fn($h) => Carbon::parse($h)->format('H:i'))
            ->contains($horaCita->format('H:i'));

        if ($ocupada) {
            return back()->withErrors([
                'hora_cita' => 'Esta hora ya está ocupada.'
            ])->withInput();
        }

        // Crear cita
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
            'id_estadoserva' => 1 // PENDIENTE
        ]);

        return redirect()
            ->route('eventos.index')
            ->with('success', 'Tu cita fue enviada correctamente.');
    }

    /**
     * HORAS DISPONIBLES (AJAX)
     */
     public function horasDisponibles(Request $request)
{
    $fecha = $request->query('fecha');

    // Validar formato YYYY-MM-DD
    if (!$fecha || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
        return response()->json([], 400);
    }

    $horario = HorarioAtencion::first();
    if (!$horario) {
        return response()->json([]);
    }

    $inicio = Carbon::createFromFormat('H:i:s', $horario->hora_inicio);
    $fin    = Carbon::createFromFormat('H:i:s', $horario->hora_fin);

    $horas = [];
    while ($inicio < $fin) {
        $horas[] = $inicio->format('H:i');
        $inicio->addHour();
    }

    $ocupadas = Cita::where('fecha_cita', $fecha)
        ->pluck('hora_cita')
        ->map(fn($h) => Carbon::parse($h)->format('H:i'))
        ->toArray();

    $disponibles = array_values(array_diff($horas, $ocupadas));

    return response()->json($disponibles);
}


    /**
     * ESTADO DE LA CITA (USUARIO)
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
