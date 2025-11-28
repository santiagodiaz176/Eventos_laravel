<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'perfil' => 'required|in:admin,user', // usar 'user' en vez de 'usuario'
            'clave' => 'required|string|min:6|confirmed', // requiere input "clave_confirmation"
        ]);

        // Crear usuario, usando el email como "usuario" y estado booleano
        Usuario::create([
            'usuario' => $request->email, // login será el email
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'perfil' => $request->perfil,
            'estado' => true, // activo por defecto
            'clave' => Hash::make($request->clave),
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.editar', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id . ',id_usuario',
            'perfil' => 'required|in:admin,user', // asegurarse que coincide con DB
            'estado' => 'required', // recibimos 1 o 0 del select
        ]);

        // Asignar valores
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->email = $request->email;
        $usuario->perfil = $request->perfil;
        $usuario->estado = $request->estado == "1" ? 1 : 0; // convertir a entero/booleano

        // Guardar cambios
        $usuario->save();

        return redirect()->route('admin.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        Usuario::destroy($id);

        return redirect()->route('admin.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
