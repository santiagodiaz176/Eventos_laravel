@extends('layouts.app')

@section('title', 'Agendar Cita')

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
    }
    .form-card .button-primary:hover {
        background-color: #0056b3;
    }
    @media (max-width: 600px) {
        .form-card { padding: 20px; }
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

    <form action="{{ route('reserva.cita') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <label>Nombre completo:</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej: Santiago Díaz" required>
            </div>
            <div class="col-md-6">
                <label>Teléfono:</label>
                <input type="text" name="telefono" class="form-control" placeholder="Ej: 3001234567" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Correo electrónico:</label>
                <input type="email" name="correo" class="form-control" placeholder="ejemplo@mail.com" required>
            </div>
            <div class="col-md-6">
                <label>Fecha de la cita:</label>
                <input type="date" name="fecha_cita" class="form-control" 
                       min="{{ now()->toDateString() }}" 
                       max="{{ \Carbon\Carbon::parse($evento->fecha_evento)->subDay()->toDateString() }}" 
                       required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Hora de la cita:</label>
                <select name="hora_cita" id="hora_cita" class="form-control" required>
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
            </div>
            <div class="col-md-6">
                <label>Tipo de evento:</label>
                <input type="text" name="tipo_evento" class="form-control" placeholder="Ej: Cumpleaños, Boda" required>
            </div>
        </div>

        <input type="hidden" name="id_evento" value="{{ $evento->id_evento ?? '' }}">

        <div style="text-align:center; margin-top:25px;">
            <button type="submit" class="button-primary">Agendar Cita</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fechaInput = document.querySelector('input[name="fecha_cita"]');
    const horaSelect = document.getElementById('hora_cita');

    if (!fechaInput || !horaSelect) return;

    fechaInput.addEventListener('change', function () {
        const fecha = this.value;

        // Resetear el valor del select ANTES de cambiar las opciones
        horaSelect.value = '';

        // Validar que haya fecha
        if (!fecha) {
            horaSelect.innerHTML = '<option value="">Seleccione una fecha primero</option>';
            return;
        }

        horaSelect.innerHTML = '<option value="">Cargando horas...</option>';

        // Construir URL dinámicamente
        const url = '{{ route("citas.horas") }}' + '?fecha=' + encodeURIComponent(fecha);

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en la respuesta del servidor');
            return response.json();
        })
        .then(data => {
            // Primero crear el HTML nuevo
            let opciones = '<option value="">Seleccione una hora</option>';
            
            if (!data || data.length === 0) {
                opciones = '<option value="">No hay horas disponibles</option>';
            } else {
                data.forEach(hora => {
                    opciones += `<option value="${hora}">${hora}</option>`;
                });
            }
            
            // Luego actualizar el innerHTML
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
