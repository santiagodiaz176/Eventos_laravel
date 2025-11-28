<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Mostrar el formulario de contacto
    public function index()
    {
        return view('contacto'); 
    }

    // Manejar el envío del formulario
    public function submit(Request $request)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Aquí podrías guardar en DB o enviar correo
        // Por ahora, solo devolver un mensaje de éxito
        return back()->with('success', 'Formulario enviado correctamente!');
    }
}
