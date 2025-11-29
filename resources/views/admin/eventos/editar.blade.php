@extends('layouts.app')

@section('title', 'Editar Evento')

@section('styles')
<style>
    .form-card {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .form-card h2 {
        margin-bottom: 25px;
        text-align: center;
        color: #333;
        font-weight: 700;
    }
    .form-card label {
        font-weight: 600;
        margin-top: 10px;
    }
    .form-card .form-control {
        margin-bottom: 15px;
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
    }
    .button-primary {
        background-color: #007bff;
        border: none;
        padding: 12px 25px;
        color: #fff;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="form-card">

    <h2>Editar Evento</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.eventos.update', $evento->id_evento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <label>Nombre del evento:</label>
                <input type="text" name="nombre_evento" class="form-control" value="{{ $evento->nombre_evento }}" required>
            </div>

            <div class="col-md-6">
                <label>Cantidad de personas:</label>
                <input type="number" name="cantidad_personas" class="form-control" min="1" value="{{ $evento->cantidad_personas }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Fecha:</label>
                <input type="date" name="fecha_evento" class="form-control" value="{{ $evento->fecha_evento }}" required>
            </div>

            <div class="col-md-6">
                <label>Hora:</label>
                <input type="time" name="hora_evento" class="form-control" value="{{ $evento->hora_evento }}" required>
            </div>
        </div>

        <label>Lugar:</label>
        <input type="text" name="lugar_evento" class="form-control" value="{{ $evento->lugar_evento }}" required>

        <label>Descripción:</label>
        <textarea name="descripcion_evento"
                  class="form-control"
                  rows="3">{{ $evento->descripcion_evento }}</textarea>

        <label>Tipo de evento:</label>
        <input type="text"
               name="tipo_evento_usuario"
               class="form-control"
               value="{{ $evento->tipoevento->descripcion_tipoevento ?? '' }}"
               placeholder="Ej: Cumpleaños, Boda, Conferencia">

        <label>Estado del evento:</label>
        <select name="accion" class="form-control" required>
           <option value="aceptar" {{ $evento->id_estado == 2 ? 'selected' : '' }}>Aceptado</option>
           <option value="cancelar" {{ $evento->id_estado == 3 ? 'selected' : '' }}>Cancelado</option>
        </select>

        <div style="text-align:center; margin-top:25px;">
            <button type="submit" class="button-primary">
                Actualizar Evento
            </button>
        </div>
    </form>
</div>
@endsection
