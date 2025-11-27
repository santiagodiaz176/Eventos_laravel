<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|max:255|unique:usuarios,email',
            'nombre'    => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'password'  => 'required|min:6|confirmed',
        ]);

        DB::table('usuarios')->insert([
            'usuario'   => $request->email,
            'email'     => $request->email,
            'clave'     => Hash::make($request->password),
            'nombre'    => $request->nombre,
            'apellidos' => $request->apellidos,
            'perfil'    => 'user',
            'estado'    => true,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        
        return redirect()->route('login')
            ->with('success', 'Registro exitoso, ahora inicia sesión');
    }
}
