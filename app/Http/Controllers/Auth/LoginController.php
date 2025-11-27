<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'clave' => 'required',
        ]);

        // Intentamos autenticar usando Auth
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['clave']  // tu columna personalizada
        ])) {
            $request->session()->regenerate(); // protege la sesión
            return redirect()->intended(route('usuario'));
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio');
    }
}
