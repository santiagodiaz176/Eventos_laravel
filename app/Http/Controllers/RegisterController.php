<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'apellidos' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'email',
                    'unique:usuarios,email',
                    'regex:/^[a-zA-Z0-9._%+-]+@(gmail|hotmail)\.com$/'
                ],
                'password' => [
                    'required',
                    'confirmed',
                    'min:8',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/'
                ],
            ], [
                'nombre.required' => 'El nombre es obligatorio.',
                'apellidos.required' => 'Los apellidos son obligatorios.',
                'email.required' => 'El correo es obligatorio.',
                'email.email' => 'El correo no es válido.',
                'email.unique' => 'Este correo ya está registrado.',
                'email.regex' => 'Solo se permiten correos @gmail.com o @hotmail.com.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'password.min' => 'La contraseña debe tener mínimo 8 caracteres.',
                'password.regex' => 'La contraseña debe incluir mayúsculas, minúsculas y números.',
            ]);

            // Generar nombre de usuario único basado en el email
            $usuario = explode('@', $validated['email'])[0];

            $usuarioCreado = Usuario::create([
                'nombre' => $validated['nombre'],
                'apellidos' => $validated['apellidos'],
                'usuario' => $usuario,  // ← AGREGADO
                'email' => $validated['email'],
                'clave' => Hash::make($validated['password']),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado correctamente',
                'redirect' => route('login')
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Error en registro: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el usuario'
            ], 500);
        }
    }
}