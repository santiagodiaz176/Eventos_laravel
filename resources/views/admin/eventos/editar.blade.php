@extends('layouts.app')

@section('title', 'Editar Evento')

@section('styles')
<style>
    .form-card {
        max-width: 600px;
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
        margin-top: 15px;
        display: block;
    }
    .form-card .form-control, 
    .form-card select {
        margin-bottom: 15px;
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
        width: 100%;
    }
    .info-item {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .info-item strong {
        color: #495057;
    }
    .info-item span {
        color: #212529;
        font-weight: 500;
    }
    .button-primary {
        background-color: #007bff;
        border: none;
        padding: 12px 30px;
        color: #fff;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        width: 100%;
        margin-top: 20px;
    }
    .button-primary:hover {
        background-color: #0056b3;
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

  {{-- INFORMACIÓN DEL USUARIO (NO EDITABLE) --}}
<div style="margin-bottom: 25px;">
    <h5 style="color: #6c757d; margin-bottom: 15px;">Información del Cliente:</h5>
    
    <div class="info-item">
        <strong>Cliente:</strong>
        <span>{{ $evento->usuario->nombre ?? 'N/A' }} {{ $evento->usuario->apellidos ?? '' }}</span>
    </div>
    
    <div class="info-item">
        <strong>Correo:</strong>
        <span>{{ $evento->usuario->email ?? 'N/A' }}</span>
    </div>
    
    @if($evento->created_at)
    <div class="info-item">
        <strong>Fecha creación:</strong>
        <span>{{ $evento->created_at->format('d/m/Y') }}</span>
    </div>
    @endif

    <div class="info-item">
        <strong>Personas:</strong>
        <span>{{ $evento->cantidad_personas ?? 0 }}</span>
    </div>

    <div class="info-item">
        <strong>Fecha evento:</strong>
        <span>{{ $evento->fecha_evento ? \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y') : 'No especificada' }}</span>
    </div>

    <div class="info-item">
        <strong>Hora evento:</strong>
        <span>{{ $evento->hora_evento ? \Carbon\Carbon::parse($evento->hora_evento)->format('h:i A') : 'No especificada' }}</span>
    </div>
</div>

    <form action="{{ route('admin.eventos.update', $evento->id_evento) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- SOLO ESTOS CAMPOS SON EDITABLES --}}
        
        <label>Nombre del evento:</label>
        <input type="text" 
               name="nombre_evento" 
               class="form-control" 
               value="{{ old('nombre_evento', $evento->nombre_evento) }}"
               maxlength="30"
               required>

        <label>Tipo de evento:</label>
        <select name="id_tipoevento" class="form-control" required>
            <option value="">Seleccione un tipo</option>
            @foreach($tiposEvento as $tipo)
                <option value="{{ $tipo->id_tipoevento }}" 
                        {{ old('id_tipoevento', $evento->id_tipoevento) == $tipo->id_tipoevento ? 'selected' : '' }}>
                    {{ $tipo->descripcion_tipoevento }}
                </option>
            @endforeach
        </select>

        <label>Zona del evento:</label>
        <select name="id_zona" class="form-control" required>
            <option value="">Seleccione una zona</option>
            @foreach($zonas as $zona)
                <option value="{{ $zona->id_zona }}" 
                        {{ old('id_zona', $evento->id_zona) == $zona->id_zona ? 'selected' : '' }}>
                    {{ $zona->nombre_zona }} - {{ $zona->descripcion }}
                </option>
            @endforeach
        </select>

        <label>Descripción (opcional):</label>
        <textarea name="descripcion_evento"
                  class="form-control"
                  maxlength="500"
                  rows="3"
                  placeholder="Agregue detalles adicionales del evento...">{{ old('descripcion_evento', $evento->descripcion_evento) }}</textarea>

        <label>Estado del evento:</label>
        <select name="accion" class="form-control" required>
           <option value="aceptar" {{ $evento->id_estado == 2 ? 'selected' : '' }}>Aceptado</option>
           <option value="cancelar" {{ $evento->id_estado == 3 ? 'selected' : '' }}>Cancelado</option>
        </select>

        <button type="submit" class="button-primary">
            Actualizar Evento
        </button>
    </form>
</div>
@endsection