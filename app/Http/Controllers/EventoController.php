<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Tipoevento;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /*
    |------------------------------------------|
    |                USUARIO                   |
    |------------------------------------------|
    */

    // Mostrar eventos del usuario
    public function index()
    {
        $eventos = Evento::where('id_usuario', Auth::id())
            ->with(['cita', 'tipoevento', 'estado'])
            ->get();

        return view('user.eventos', compact('eventos'));
    }

    // Formulario crear evento (incluye tipos y zonas)
    public function create()
    {
        $tiposEvento = Tipoevento::all();
        $zonas = Zona::where('activo', true)->get();

        return view('user.create_evento', compact('tiposEvento', 'zonas'));
    }

    // Guardar evento (USUARIO)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_evento'      => 'required|string|max:30',
            'id_tipoevento'      => 'required|exists:tipoevento,id_tipoevento',
            'cantidad_personas'  => 'required|integer|min:1',
            'id_zona'            => 'required|exists:zonas,id_zona',
            'fecha_evento'       => 'required|date|after:today',
            'hora_evento'        => 'required',
            'descripcion_evento' => 'nullable|string|max:500',
        ]);

        $evento = Evento::create([
            'nombre_evento'      => $request->nombre_evento,
            'id_tipoevento'      => $request->id_tipoevento,
            'cantidad_personas'  => $request->cantidad_personas,
            'id_zona'            => $request->id_zona,
            'fecha_evento'       => $request->fecha_evento,
            'hora_evento'        => $request->hora_evento,
            'descripcion_evento' => $request->descripcion_evento,
            'id_usuario'         => auth()->id(),
            'id_estado'          => 1, // Pendiente
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado exitosamente');
    }

    /*
    |------------------------------------------|
    |                 ADMIN                    |
    |------------------------------------------|
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
        $evento->id_estado = $request->accion === 'aceptar' ? 2 : 3;

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
