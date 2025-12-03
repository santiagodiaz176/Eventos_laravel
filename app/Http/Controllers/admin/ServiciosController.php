<?php
// app/Http/Controllers/Admin/ServiciosController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\ServicioContratado;
use App\Models\Comida;
use App\Models\Bebida;
use App\Models\Salon;
use App\Models\Decoracion;

class ServiciosController extends Controller
{
    /**
     * Mostrar formulario para crear servicios
     */
    public function crear($id_cita)
    {
        $cita = Cita::with(['evento.tipoevento', 'usuario'])->findOrFail($id_cita);
        
        // Verificar que la cita esté aprobada
        if ($cita->estado->nombre_estado !== 'Aprobada') {
            return redirect()->route('admin.index', ['tab' => 'servicios'])
                ->with('error', 'Solo se pueden agregar servicios a citas aprobadas');
        }

        $comidas = Comida::where('activo', true)->get();
        $bebidas = Bebida::where('activo', true)->get();
        $salones = Salon::where('activo', true)->get();
        $decoraciones = Decoracion::where('activo', true)->get();

        return view('admin.servicios.crear', compact('cita', 'comidas', 'bebidas', 'salones', 'decoraciones'));
    }

    /**
     * Guardar servicios
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cita' => 'required|exists:citas,id_cita',
            'id_evento' => 'required|exists:eventos,id_evento',
            'incluye_dj' => 'nullable|boolean',
            'incluye_sonido' => 'nullable|boolean',
            'incluye_animador' => 'nullable|boolean',
            'id_salon' => 'nullable|exists:salones,id_salon',
            'id_decoracion' => 'nullable|exists:decoraciones,id_decoracion',
            'comidas' => 'nullable|array|max:3',
            'comidas.*' => 'exists:comidas,id_comida',
            'bebidas' => 'nullable|array',
            'bebidas.*' => 'exists:bebidas,id_bebida',
        ]);

        // Calcular totales
        $subtotal = 0;

        // Servicios básicos
        if ($request->incluye_dj) $subtotal += 200000;
        if ($request->incluye_sonido) $subtotal += 150000;
        if ($request->incluye_animador) $subtotal += 180000;

        // Salón
        if ($request->id_salon) {
            $salon = Salon::find($request->id_salon);
            $subtotal += $salon->precio;
        }

        // Decoración
        if ($request->id_decoracion) {
            $decoracion = Decoracion::find($request->id_decoracion);
            $subtotal += $decoracion->precio;
        }

        // Comidas
        if ($request->comidas) {
            $comidas = Comida::whereIn('id_comida', $request->comidas)->get();
            foreach ($comidas as $comida) {
                $subtotal += $comida->precio;
            }
        }

        // Bebidas
        if ($request->bebidas) {
            $bebidas = Bebida::whereIn('id_bebida', $request->bebidas)->get();
            foreach ($bebidas as $bebida) {
                $subtotal += $bebida->precio;
            }
        }

        $iva = $subtotal * 0.19;
        $total = $subtotal + $iva;

        // Crear servicio contratado
        $servicio = ServicioContratado::create([
            'id_cita' => $request->id_cita,
            'id_evento' => $request->id_evento,
            'incluye_dj' => $request->incluye_dj ?? false,
            'incluye_sonido' => $request->incluye_sonido ?? false,
            'incluye_animador' => $request->incluye_animador ?? false,
            'id_salon' => $request->id_salon,
            'id_decoracion' => $request->id_decoracion,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'estado' => 'borrador',
        ]);

        // Asociar comidas
        if ($request->comidas) {
            foreach ($request->comidas as $id_comida) {
                $comida = Comida::find($id_comida);
                $servicio->comidas()->attach($id_comida, [
                    'cantidad' => 1,
                    'precio_unitario' => $comida->precio,
                    'subtotal' => $comida->precio,
                ]);
            }
        }

        // Asociar bebidas
        if ($request->bebidas) {
            foreach ($request->bebidas as $id_bebida) {
                $bebida = Bebida::find($id_bebida);
                $servicio->bebidas()->attach($id_bebida, [
                    'cantidad' => 1,
                    'precio_unitario' => $bebida->precio,
                    'subtotal' => $bebida->precio,
                ]);
            }
        }

        return redirect()->route('admin.index', ['tab' => 'servicios'])
            ->with('success', 'Servicios agregados correctamente');
    }

    /**
     * Mostrar formulario para editar servicios
     */
    public function editar($id_servicio_contratado)
    {
        $servicio = ServicioContratado::with([
            'cita.evento.tipoevento',
            'cita.usuario',
            'comidas',
            'bebidas',
            'salon',
            'decoracion'
        ])->findOrFail($id_servicio_contratado);

        $cita = $servicio->cita;
        $comidas = Comida::where('activo', true)->get();
        $bebidas = Bebida::where('activo', true)->get();
        $salones = Salon::where('activo', true)->get();
        $decoraciones = Decoracion::where('activo', true)->get();

        return view('admin.servicios.editar', compact('servicio', 'cita', 'comidas', 'bebidas', 'salones', 'decoraciones'));
    }

    /**
     * Actualizar servicios
     */
    public function update(Request $request, $id_servicio_contratado)
    {
        $servicio = ServicioContratado::findOrFail($id_servicio_contratado);

        $validated = $request->validate([
            'incluye_dj' => 'nullable|boolean',
            'incluye_sonido' => 'nullable|boolean',
            'incluye_animador' => 'nullable|boolean',
            'id_salon' => 'nullable|exists:salones,id_salon',
            'id_decoracion' => 'nullable|exists:decoraciones,id_decoracion',
            'comidas' => 'nullable|array|max:3',
            'comidas.*' => 'exists:comidas,id_comida',
            'bebidas' => 'nullable|array',
            'bebidas.*' => 'exists:bebidas,id_bebida',
        ]);

        // Recalcular totales
        $subtotal = 0;

        if ($request->incluye_dj) $subtotal += 200000;
        if ($request->incluye_sonido) $subtotal += 150000;
        if ($request->incluye_animador) $subtotal += 180000;

        if ($request->id_salon) {
            $salon = Salon::find($request->id_salon);
            $subtotal += $salon->precio;
        }

        if ($request->id_decoracion) {
            $decoracion = Decoracion::find($request->id_decoracion);
            $subtotal += $decoracion->precio;
        }

        // Actualizar comidas
        $servicio->comidas()->detach();
        if ($request->comidas) {
            foreach ($request->comidas as $id_comida) {
                $comida = Comida::find($id_comida);
                $subtotal += $comida->precio;
                $servicio->comidas()->attach($id_comida, [
                    'cantidad' => 1,
                    'precio_unitario' => $comida->precio,
                    'subtotal' => $comida->precio,
                ]);
            }
        }

        // Actualizar bebidas
        $servicio->bebidas()->detach();
        if ($request->bebidas) {
            foreach ($request->bebidas as $id_bebida) {
                $bebida = Bebida::find($id_bebida);
                $subtotal += $bebida->precio;
                $servicio->bebidas()->attach($id_bebida, [
                    'cantidad' => 1,
                    'precio_unitario' => $bebida->precio,
                    'subtotal' => $bebida->precio,
                ]);
            }
        }

        $iva = $subtotal * 0.19;
        $total = $subtotal + $iva;

        $servicio->update([
            'incluye_dj' => $request->incluye_dj ?? false,
            'incluye_sonido' => $request->incluye_sonido ?? false,
            'incluye_animador' => $request->incluye_animador ?? false,
            'id_salon' => $request->id_salon,
            'id_decoracion' => $request->id_decoracion,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
        ]);

        return redirect()->route('admin.index', ['tab' => 'servicios'])
            ->with('success', 'Servicios actualizados correctamente');
    }

    /**
     * Enviar factura al usuario
     */
    public function enviar($id_servicio_contratado)
    {
        $servicio = ServicioContratado::findOrFail($id_servicio_contratado);

        $servicio->update([
            'estado' => 'enviado',
            'fecha_envio' => now(),
        ]);

        // Aquí podrías enviar un correo al usuario notificándole

        return redirect()->route('admin.index', ['tab' => 'servicios'])
            ->with('success', 'Factura enviada al usuario correctamente');
    }
}



// ==========================================
// ACTUALIZAR: app/Http/Controllers/EventoController.php

// En el método create():
