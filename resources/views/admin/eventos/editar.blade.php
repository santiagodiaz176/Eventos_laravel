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
@php
    // Intentar descomponer la dirección guardada para precargar los campos.
    // Asumimos que la dirección se guardó como: TIPO NUMERO PLACA_COMPLEMENTO
    $lugar_evento = $evento->lugar_evento ?? '';
    $direccion_partes = [
        'tipo_via' => 'Calle', // Valor por defecto
        'num_via_principal' => '',
        'placa_completa' => $lugar_evento
    ];

    $tipos_via = ['Calle', 'Carrera', 'Avenida', 'Transversal', 'Diagonal'];
    
    // Buscar si la dirección comienza con alguno de los tipos de vía conocidos
    foreach ($tipos_via as $tipo) {
        if (stripos($lugar_evento, $tipo) === 0) {
            $direccion_partes['tipo_via'] = $tipo;
            $resto_direccion = trim(substr($lugar_evento, strlen($tipo)));

            // Intentar separar el número de vía y el complemento
            // Esto es heurístico, ya que las direcciones guardadas son variables.
            if (preg_match('/^(\s*[a-zA-Z0-9\s]+?)(\s*#.*)$/', $resto_direccion, $matches)) {
                 // Si encontramos un patrón como "45 # 10-20"
                $direccion_partes['num_via_principal'] = trim($matches[1]);
                $direccion_partes['placa_completa'] = trim($matches[2]);
            } else {
                 // Si no, asumimos que el primer token es el número de vía.
                 $partes = explode(' ', $resto_direccion, 2);
                 if (count($partes) > 1) {
                    $direccion_partes['num_via_principal'] = trim($partes[0]);
                    $direccion_partes['placa_completa'] = trim($partes[1]);
                 } else {
                    $direccion_partes['num_via_principal'] = $resto_direccion;
                    $direccion_partes['placa_completa'] = '';
                 }
            }
            break;
        }
    }
@endphp

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

    <form action="{{ route('admin.eventos.update', $evento->id_evento) }}" method="POST" id="form-editar-evento">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <label>Nombre del evento:</label>
                <input type="text" 
                       name="nombre_evento" 
                       class="form-control" 
                       value="{{ old('nombre_evento', $evento->nombre_evento) }}"
                       data-validate="nombre-evento"
                       maxlength="30"
                       required>
            </div>

            <div class="col-md-6">
                <label>Cantidad de personas:</label>
                <input type="number" 
                       name="cantidad_personas" 
                       class="form-control" 
                       min="1" 
                       value="{{ old('cantidad_personas', $evento->cantidad_personas) }}"
                       data-validate="cantidad-personas"
                       required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Fecha:</label>
                <input type="date" 
                       name="fecha_evento" 
                       class="form-control"
                       value="{{ old('fecha_evento', $evento->fecha_evento) }}"
                       data-validate="fecha-futura"
                       required>
            </div>

            <div class="col-md-6">
                <label>Hora:</label>
                <select name="hora_evento" class="form-control" required>
                    <option value="">Seleccione una hora</option>
                    @for ($hour = 0; $hour < 24; $hour++)
                        @foreach ([0, 30] as $minute)
                            @php
                                $time24 = sprintf('%02d:%02d', $hour, $minute);
                                $hour12 = $hour == 0 ? 12 : ($hour > 12 ? $hour - 12 : $hour);
                                $ampm = $hour < 12 ? 'AM' : 'PM';
                                $timeDisplay = sprintf('%d:%02d %s', $hour12, $minute, $ampm);
                                $selected = old('hora_evento', $evento->hora_evento) == $time24 ? 'selected' : '';
                            @endphp
                            <option value="{{ $time24 }}" {{ $selected }}>{{ $timeDisplay }}</option>
                        @endforeach
                    @endfor
                </select>
            </div>
        </div>

        <!-- INICIO: CAMPOS DE DIRECCIÓN SEPARADOS (Reemplaza el campo Lugar anterior) -->
        <label>Lugar del Evento (Dirección):</label>
        <div class="row" id="direccion-inputs">
            <div class="col-md-4">
                <label for="tipo_via">Tipo de Vía:</label>
                <select id="tipo_via" class="form-control" required>
                    @foreach ($tipos_via as $tipo)
                        @php
                            $selected_tipo = ($direccion_partes['tipo_via'] == $tipo) ? 'selected' : '';
                        @endphp
                        <option value="{{ $tipo }}" {{ $selected_tipo }}>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="num_via_principal">Número Vía:</label>
                <input type="text" 
                       id="num_via_principal"
                       class="form-control" 
                       value="{{ old('num_via_principal', $direccion_partes['num_via_principal']) }}"
                       placeholder="Ej: 45"
                       data-validate="num-via"
                       maxlength="5"
                       required>
            </div>
            <div class="col-md-5">
                <label for="placa_completa">Placa y Complemento:</label>
                <input type="text" 
                       id="placa_completa"
                       class="form-control" 
                       value="{{ old('placa_completa', $direccion_partes['placa_completa']) }}"
                       placeholder="Ej: # 10-20, Piso 3"
                       data-validate="placa-complemento"
                       maxlength="50"
                       required>
            </div>
        </div>

        <!-- CAMPO OCULTO QUE RECIBE EL VALOR FINAL ESPERADO POR EL BACKEND (lugar_evento) -->
        <input type="hidden" 
               name="lugar_evento" 
               id="lugar_evento_hidden"
               required>
        <!-- FIN: CAMPOS DE DIRECCIÓN SEPARADOS -->

        <label>Descripción:</label>
        <textarea name="descripcion_evento"
                  class="form-control"
                  data-validate="descripcion"
                  data-max="500"
                  rows="3">{{ old('descripcion_evento', $evento->descripcion_evento) }}</textarea>

        <label>Tipo de evento:</label>
        <input type="text"
               name="tipo_evento_usuario"
               class="form-control"
               data-validate="tipo-evento"
               maxlength="50"
               value="{{ old('tipo_evento_usuario', $evento->tipoevento->descripcion_tipoevento ?? '') }}"
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