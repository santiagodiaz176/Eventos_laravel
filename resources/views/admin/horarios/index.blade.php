@extends('layouts.app')

@section('content')

<h3>Horario de atención</h3>

<a href="{{ route('admin.horarios.create') }}"
   class="btn btn-success mb-3">
   + Nuevo horario
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Hora inicio</th>
            <th>Hora fin</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
    @foreach($horarios as $horario)
        <tr>
            <td>{{ $horario->hora_inicio }}</td>
            <td>{{ $horario->hora_fin }}</td>
            <td>
                @if($horario->activo)
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-danger">Inactivo</span>
                @endif
            </td>
            <td>
                <form method="POST"
                      action="{{ route('admin.horarios.toggle', $horario->id_horario) }}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-warning btn-sm">
                        Activar / Desactivar
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
