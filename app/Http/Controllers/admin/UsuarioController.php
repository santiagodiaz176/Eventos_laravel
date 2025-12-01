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
            'perfil' => 'required|in:admin,user', 
            'clave' => 'required|string|min:6|confirmed', 
        ]);

        // Crear usuario
        Usuario::create([
            'usuario' => $request->email, 
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'perfil' => $request->perfil,
            'estado' => true, 
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
            'perfil' => 'required|in:admin,user', 
            'estado' => 'required', 
        ]);

        // Asignar valores
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->email = $request->email;
        $usuario->perfil = $request->perfil;
        $usuario->estado = $request->estado == "1" ? 1 : 0; 

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
