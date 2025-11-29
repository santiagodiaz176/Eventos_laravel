@extends('layouts.app')

@section('title', 'Gestión de Citas')

@section('content')

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

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
                    $estado = $c->estado->nombre_estado ?? 'Pendiente';
                @endphp

                {{-- Pendiente --}}
                @if($estado === 'Pendiente')
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

                    <a href="{{ route('admin.citas.edit', $c->id_cita) }}" class="btn btn-warning">Posponer</a>

                {{-- Pospuesta --}}
                @elseif($estado === 'Pospuesta')
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

                {{-- Aprobada --}}
                @elseif($estado === 'Aprobada')
                    <a href="{{ route('admin.eventos.editar', $c->id_cita) }}" class="btn btn-primary">Ver Evento</a>

                {{-- Cancelada / Rechazada --}}
                @else
                    <strong>{{ $estado }}</strong>
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
