<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suscripcion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class SuscripcionController extends Controller
{
    /**
     * ✅ Guardar suscripción desde el footer
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:suscripciones,correo'
        ]);

        Suscripcion::create([
            'correo' => $request->email,
            'id_usuario' => Auth::check() ? Auth::user()->id_usuario : null,
            'estado' => 'activo'
        ]);

        // ✅ Cookie por 1 año
        Cookie::queue('suscrito_email', $request->email, 525600);

        return redirect()
            ->to(route('admin.index') . '?tab=suscripciones')
            ->with('success', 'Gracias por suscribirte');
    }

    /**
     * ✅ Listar suscripciones (admin)
     */
    public function index()
    {
        $suscripciones = Suscripcion::orderBy('fecha_registro', 'desc')->get();
        return view('admin.suscripciones.index', compact('suscripciones'));
    }

    /**
     * ✅ Mostrar formulario para crear suscripción (admin)
     */
    public function createAdmin()
    {
        return view('admin.suscripciones.create');
    }

    /**
     * ✅ Mostrar formulario para editar suscripción (admin)
     */
    public function editAdmin($id)
    {
        $suscripcion = Suscripcion::findOrFail($id);
        return view('admin.suscripciones.editar', compact('suscripcion'));
    }

    /**
     * ✅ Guardar suscripción desde el admin
     */
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|unique:suscripciones,correo',
            'estado' => 'required'
        ]);

        Suscripcion::create([
            'correo' => $request->correo,
            'estado' => $request->estado
        ]);

        return redirect()
            ->to(route('admin.index') . '?tab=suscripciones')
            ->with('success', 'Suscripción creada correctamente');
    }

    /**
     * ✅ Actualizar suscripción (admin)
     */
    public function update(Request $request, $id)
    {
        $suscripcion = Suscripcion::findOrFail($id);

        $request->validate([
            'correo' => 'required|email|unique:suscripciones,correo,' .
                        $suscripcion->id_suscripcion . ',id_suscripcion',
            'estado' => 'required'
        ]);

        $suscripcion->update([
            'correo' => $request->correo,
            'estado' => $request->estado
        ]);

        return redirect()
            ->to(route('admin.index') . '?tab=suscripciones')
            ->with('success', 'Suscripción actualizada correctamente');
    }

    /**
     * ✅ Eliminar suscripción (admin)
     */
    public function destroy($id)
    {
        Suscripcion::findOrFail($id)->delete();

        return redirect()
            ->to(route('admin.index') . '?tab=suscripciones')
            ->with('success', 'Suscripción eliminada correctamente');
    }

    /**
     * ✅ Activar / Desactivar suscripción (admin)
     */
    public function toggle($id)
    {
        $sus = Suscripcion::findOrFail($id);
        $sus->estado = $sus->estado === 'activo' ? 'inactivo' : 'activo';
        $sus->save();

        return redirect()
            ->to(route('admin.index') . '?tab=suscripciones')
            ->with('success', 'Estado de la suscripción actualizado');
    }
}
