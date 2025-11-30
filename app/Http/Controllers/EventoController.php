<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Tipoevento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USUARIO
    |--------------------------------------------------------------------------
    */

    // Mostrar eventos del usuario
    public function index()
    {
        $eventos = Evento::where('id_usuario', Auth::id())
            ->with(['cita', 'tipoevento', 'estado'])
            ->get();

        return view('user.eventos', compact('eventos'));
    }

    // Formulario crear evento
    public function create()
    {
        return view('user.create_evento');
    }

    // Guardar evento (USUARIO)
    public function store(Request $request)
    {
        $request->validate([
            'nombre_evento'       => 'required|string|max:100',
            'descripcion_evento'  => 'nullable|string',
            'fecha_evento'        => 'required|date|after:today',
            'hora_evento'         => 'required',
            'lugar_evento'        => 'required|string|max:200',
            'cantidad_personas'   => 'required|integer|min:1',
            'tipo_evento_usuario' => 'required|string|max:100',
        ], [
            'fecha_evento.after' => 'El evento no puede ser hoy ni en fechas anteriores.'
        ]);

        // Crear o recuperar tipo de evento
        $tipo = Tipoevento::firstOrCreate([
            'descripcion_tipoevento' => $request->tipo_evento_usuario
        ]);

        // Crear evento
        Evento::create([
            'nombre_evento'      => $request->nombre_evento,
            'descripcion_evento' => $request->descripcion_evento,
            'fecha_evento'       => $request->fecha_evento,
            'hora_evento'        => $request->hora_evento,
            'lugar_evento'       => $request->lugar_evento,
            'cantidad_personas'  => $request->cantidad_personas,
            'id_usuario'         => Auth::id(),
            'id_tipoevento'      => $tipo->id_tipoevento,
            'id_estado'          => 1, // ✅ Pendiente
        ]);

        return redirect()
            ->route('eventos.index')
            ->with('success', 'Evento creado correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    // Editar evento por admin
    public function editarPorAdmin($id_evento)
    {
        $evento = Evento::with('cita')->findOrFail($id_evento);

        return view('admin.eventos.editar', compact('evento'));
    }

    // Actualizar evento por admin
    public function updatePorAdmin(Request $request, $id_evento)
    {
        $evento = Evento::findOrFail($id_evento);

        $request->validate([
            'nombre_evento'      => 'required|string|max:100',
            'descripcion_evento' => 'nullable|string',
            'fecha_evento'       => 'required|date',
            'hora_evento'        => 'required',
            'lugar_evento'       => 'required|string|max:200',
            'cantidad_personas'  => 'required|integer|min:1',
            'accion'             => 'required|in:aceptar,cancelar',
        ]);

        // Actualizar datos del evento
        $evento->nombre_evento      = $request->nombre_evento;
        $evento->descripcion_evento = $request->descripcion_evento;
        $evento->fecha_evento       = $request->fecha_evento;
        $evento->hora_evento        = $request->hora_evento;
        $evento->lugar_evento       = $request->lugar_evento;
        $evento->cantidad_personas  = $request->cantidad_personas;

        // Acción del admin
        if ($request->accion === 'aceptar') {
            $evento->id_estado = 2; // ✅ Aceptado
        } else {
            $evento->id_estado = 3; // ❌ Cancelado
        }

        $evento->save();

        return redirect()
            ->route('admin.index', ['tab' => 'citas'])
            ->with(
                'success',
                $request->accion === 'aceptar'
                    ? 'Evento aceptado correctamente.'
                    : 'Evento cancelado correctamente.'
            );
    }
}
