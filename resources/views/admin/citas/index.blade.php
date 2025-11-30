@extends('layouts.app')

@section('title', 'Gestión de Citas')

@section('content')

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="panel-volver">
    <a href="{{ route('admin.index') }}" class="btn-volver">
        ← Volver al Panel
    </a>
</div>


<table class="tabla-admin">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse($citas as $c)
        <tr>
            <td>{{ $c->id_cita }}</td>
            <td>{{ $c->usuario->nombre ?? $c->nombre }}</td>
            <td>{{ $c->telefono }}</td>
            <td>{{ $c->fecha_cita }}</td>
            <td>{{ $c->estado->nombre_estado ?? 'Pendiente' }}</td>

            <td class="acciones">

                @php
                    $estadoCita = $c->estado->nombre_estado ?? 'Pendiente';
                    $evento = $c->evento ?? null;
                @endphp

                {{-- Pendiente --}}
                @if($estadoCita === 'Pendiente' || $estadoCita === 'Pospuesta')
                    <form action="{{ route('admin.citas.update', $c->id_cita) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="accion" value="aceptar">
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    </form>

                    <form action="{{ route('admin.citas.update', $c->id_cita) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="accion" value="cancelar">
                        <button type="submit" class="btn btn-danger">Cancelar</button>
                    </form>

                    @if($estadoCita === 'Pendiente')
                        <a href="{{ route('admin.citas.edit', $c->id_cita) }}" class="btn btn-warning">Posponer</a>
                    @endif

                {{-- Aprobada con evento --}}
                @elseif($estadoCita === 'Aprobada' && $evento)
                    @if($evento->id_estado == 1)
                        <a href="{{ route('admin.eventos.editar', $evento->id_evento) }}" class="btn btn-warning">Actualizar Evento</a>
                    @elseif($evento->id_estado == 2)
                        <span class="badge badge-success">Se aceptó el evento</span>
                    @elseif($evento->id_estado == 3)
                        <span class="badge badge-danger">Se canceló el evento</span>
                    @endif

                {{-- Cancelada / Rechazada --}}
                @else
                   <span class="badge badge-danger">
                   Se canceló la cita
                   </span>
                @endif

            </td>
        </tr>

        @empty
        <tr>
            <td colspan="6" class="sin-registros">
                No hay citas registradas
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
