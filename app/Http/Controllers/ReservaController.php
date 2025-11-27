<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'celular' => 'required',
            'correo' => 'required|email',
            'fecha' => 'required|date',
            'tipo_evento' => 'required',
        ]);

        Reserva::create([
            'usuario_id' => Auth::id(),
            'nombre' => $request->nombre,
            'celular' => $request->celular,
            'correo' => $request->correo,
            'fecha' => $request->fecha,
            'tipo_evento' => $request->tipo_evento,
        ]);

        return back()->with('success', 'Reserva enviada correctamente');
    }
}