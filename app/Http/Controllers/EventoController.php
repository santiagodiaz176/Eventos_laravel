<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\TipoEvento;
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
        $tiposEvento = TipoEvento::all();
        $zonas = Zona::where('activo', true)->get();
        
        return view('user.create_evento', compact('tiposEvento', 'zonas'));
    }

    // Guardar evento (USUARIO)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:30',
            'id_tipoevento' => 'required|exists:tipoevento,id_tipoevento',
            'cantidad_personas' => 'required|integer|min:1',
            'id_zona' => 'required|exists:zonas,id_zona',
            'fecha_evento' => 'required|date|after:today',
            'hora_evento' => 'required',
            'descripcion_evento' => 'nullable|string|max:500',
        ]);

        $evento = Evento::create([
            'nombre_evento' => $request->nombre_evento,
            'id_tipoevento' => $request->id_tipoevento,
            'cantidad_personas' => $request->cantidad_personas,
            'id_zona' => $request->id_zona,
            'fecha_evento' => $request->fecha_evento,
            'hora_evento' => $request->hora_evento,
            'descripcion_evento' => $request->descripcion_evento,
            'id_usuario' => auth()->id(),
            'id_estado' => 1, // Pendiente
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado exitosamente');
    }

    /*
    |------------------------------------------|
    |                 ADMIN                    |
    |------------------------------------------|
    */

    /**
     * Mostrar formulario para editar evento (ADMIN)
     */
    public function editarPorAdmin($id_evento)
    {
        $evento = Evento::with(['usuario', 'tipoevento', 'zona'])->findOrFail($id_evento);
        $tiposEvento = TipoEvento::all();
        $zonas = Zona::where('activo', true)->get();
        
        return view('admin.eventos.editar', compact('evento', 'tiposEvento', 'zonas'));
    }

    /**
     * Actualizar evento (ADMIN)
     */
    public function updatePorAdmin(Request $request, $id_evento)
    {
        $evento = Evento::findOrFail($id_evento);
        
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:30',
            'id_tipoevento' => 'required|exists:tipoevento,id_tipoevento',
            'id_zona' => 'required|exists:zonas,id_zona',
            'descripcion_evento' => 'nullable|string|max:500',
            'accion' => 'required|in:aceptar,cancelar',
        ]);

        // Determinar el estado según la acción
        $id_estado = $request->accion === 'aceptar' ? 2 : 3;

        $evento->update([
            'nombre_evento' => $request->nombre_evento,
            'id_tipoevento' => $request->id_tipoevento,
            'id_zona' => $request->id_zona,
            'descripcion_evento' => $request->descripcion_evento,
            'id_estado' => $id_estado,
        ]);

        return redirect()->route('admin.index', ['tab' => 'citas'])
            ->with('success', $request->accion === 'aceptar' 
                ? 'Evento aceptado correctamente.' 
                : 'Evento cancelado correctamente.');
    }
}