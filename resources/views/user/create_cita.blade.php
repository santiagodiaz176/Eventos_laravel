@extends('layouts.app')

@section('title', 'Agendar Cita')

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
        margin-top: 10px;
        display: block;
    }
    .form-card .form-control {
        margin-bottom: 15px;
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
        width: 100%;
    }
    .form-card .form-control:disabled {
        background-color: #e9ecef;
        cursor: not-allowed;
    }
    .form-card .button-primary {
        display: inline-block;
        background-color: #007bff;
        border: none;
        padding: 12px 25px;
        color: #fff;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.3s;
        width: 100%;
        margin-top: 20px;
    }
    .form-card .button-primary:hover {
        background-color: #0056b3;
    }
    .info-evento {
        background: #e8f4fd;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
    }
    .info-evento p {
        margin: 5px 0;
        color: #34495e;
    }
</style>
@endsection

@section('content')
<div class="form-card">
    <h2>Agendar Cita</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- INFORMACIÓN DEL EVENTO --}}
    <div class="info-evento">
        <p><strong>Evento:</strong> {{ $evento->nombre_evento }}</p>
        <p><strong>Tipo:</strong> {{ $evento->tipoevento->descripcion_tipoevento }}</p>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y') }}</p>
        <p><strong>Personas:</strong> {{ $evento->cantidad_personas }}</p>
        <p><strong>Zona:</strong> {{ $evento->zona->nombre_zona ?? 'No especificada' }}</p>
    </div>

    <form action="{{ route('reserva.cita') }}" method="POST" id="formCita">
        @csrf

        {{-- DATOS AUTOCOMPLETADOS DEL USUARIO (NO EDITABLES) --}}
        <label>Nombre completo:</label>
        <input type="text" 
               name="nombre" 
               class="form-control" 
               value="{{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}" 
               readonly 
               disabled
               style="background-color: #e9ecef;">
        <input type="hidden" name="nombre" value="{{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}">

        <label>Correo electrónico:</label>
        <input type="email" 
               name="correo" 
               class="form-control" 
               value="{{ auth()->user()->email }}" 
               readonly 
               disabled
               style="background-color: #e9ecef;">
        <input type="hidden" name="correo" value="{{ auth()->user()->email }}">

        {{-- SOLO TELÉFONO ES EDITABLE --}}
        <label>Teléfono:</label>
        <input type="text" 
               name="telefono" 
               class="form-control" 
               placeholder="Ej: 3001234567"
               pattern="[0-9]{10}"
               title="Debe contener 10 dígitos"
               maxlength="10"
               required>

        <label>Fecha de la cita:</label>
        <input type="date" 
               name="fecha_cita" 
               id="fecha_cita"
               class="form-control" 
               min="{{ now()->toDateString() }}" 
               max="{{ \Carbon\Carbon::parse($evento->fecha_evento)->subDay()->toDateString() }}" 
               required>

        <label>Hora de la cita:</label>
        <select name="hora_cita" id="hora_cita" class="form-control" required>
            <option value="">Seleccione primero una fecha</option>
            @if($horario)
                @php
                    $inicio = \Carbon\Carbon::createFromFormat('H:i:s', $horario->hora_inicio);
                    $fin = \Carbon\Carbon::createFromFormat('H:i:s', $horario->hora_fin);
                    $horas = [];
                    while($inicio < $fin){
                        $horas[] = $inicio->format('H:i');
                        $inicio->addHour();
                    }
                @endphp
                @foreach($horas as $hora)
                    <option value="{{ $hora }}">{{ $hora }}</option>
                @endforeach
            @endif
        </select>

        <input type="hidden" name="id_evento" value="{{ $evento->id_evento }}">
        <input type="hidden" name="tipo_evento" value="{{ $evento->tipoevento->descripcion_tipoevento }}">

        <button type="submit" class="button-primary">Agendar Cita</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fechaInput = document.getElementById('fecha_cita');
    const horaSelect = document.getElementById('hora_cita');

    if (!fechaInput || !horaSelect) return;

    fechaInput.addEventListener('change', function () {
        const fecha = this.value;

        horaSelect.value = '';

        if (!fecha) {
            horaSelect.innerHTML = '<option value="">Seleccione una fecha primero</option>';
            return;
        }

        horaSelect.innerHTML = '<option value="">Cargando horas...</option>';

        const url = '{{ route("citas.horas") }}' + '?fecha=' + encodeURIComponent(fecha);

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en la respuesta del servidor');
            return response.json();
        })
        .then(data => {
            let opciones = '<option value="">Seleccione una hora</option>';
            
            if (!data || data.length === 0) {
                opciones = '<option value="">No hay horas disponibles</option>';
            } else {
                data.forEach(hora => {
                    opciones += `<option value="${hora}">${hora}</option>`;
                });
            }
            
            horaSelect.innerHTML = opciones;
        })
        .catch(err => {
            console.error(err);
            horaSelect.innerHTML = '<option value="">Error al cargar horas</option>';
        });
    });
});
</script>
@endsection