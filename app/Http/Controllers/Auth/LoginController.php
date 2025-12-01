<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Maneja el inicio de sesión del usuario.
     */
    public function login(Request $request)
    {
        // Validar campos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'clave' => 'required',
        ]);

        // Intentar autenticación solo si el usuario está activo
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['clave'], 
            'estado' => 1                         
        ])) {
            // Regenerar sesión
            $request->session()->regenerate();

            // Redirección según perfil
            if (Auth::user()->perfil === 'admin') {
                return redirect()->route('admin.index');
            }

            return redirect()->route('usuario');
        }

        // Si falla la autenticación
        return back()->withErrors([
            'email' => 'Credenciales incorrectas o usuario inactivo.',
        ])->withInput();
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }
}
