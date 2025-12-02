@extends('layouts.app')

@section('title', 'Horario de Atención')

@section('styles')
<style>
    .horario-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .horario-container h3 {
        margin-bottom: 25px;
        color: #333;
        font-weight: 600;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #555;
    }

    .form-select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        color: #333;
        background-color: #f9f9f9;
        cursor: pointer;
        transition: all 0.3s;
    }

    .form-select:focus {
        outline: none;
        border-color: #007bff;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .btn-guardar {
        width: 100%;
        padding: 14px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 10px;
    }

    .btn-guardar:hover {
        background-color: #0056b3;
    }

    .alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    @media (max-width: 600px) {
        .horario-container {
            margin: 20px;
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="horario-container">
    <h3>Horario de Atención</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.horarios.store') }}">
        @csrf

        <div class="form-group">
            <label>Hora de inicio</label>
            <select name="hora_inicio" class="form-select" required>
                <option value="">Seleccione una hora</option>
                @php
                    $currentInicio = isset($horario->hora_inicio) ? substr($horario->hora_inicio, 0, 5) : '';
                @endphp
                @for($h = 6; $h <= 20; $h++)
                    @foreach([0, 30] as $m)
                        @php
                            $time = sprintf('%02d:%02d', $h, $m);
                            $display = sprintf('%02d:%02d %s', 
                                $h > 12 ? $h - 12 : $h, 
                                $m, 
                                $h < 12 ? 'AM' : 'PM'
                            );
                        @endphp
                        <option value="{{ $time }}" {{ $currentInicio == $time ? 'selected' : '' }}>
                            {{ $display }}
                        </option>
                    @endforeach
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label>Hora de fin</label>
            <select name="hora_fin" class="form-select" required>
                <option value="">Seleccione una hora</option>
                @php
                    $currentFin = isset($horario->hora_fin) ? substr($horario->hora_fin, 0, 5) : '';
                @endphp
                @for($h = 6; $h <= 21; $h++)
                    @foreach([0, 30] as $m)
                        @php
                            $time = sprintf('%02d:%02d', $h, $m);
                            $display = sprintf('%02d:%02d %s', 
                                $h > 12 ? $h - 12 : $h, 
                                $m, 
                                $h < 12 ? 'AM' : 'PM'
                            );
                        @endphp
                        <option value="{{ $time }}" {{ $currentFin == $time ? 'selected' : '' }}>
                            {{ $display }}
                        </option>
                    @endforeach
                @endfor
            </select>
        </div>

        <button type="submit" class="btn-guardar">Guardar horario</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const inicio = document.querySelector('select[name="hora_inicio"]').value;
    const fin = document.querySelector('select[name="hora_fin"]').value;

    if (inicio && fin && inicio >= fin) {
        e.preventDefault();
        alert('La hora de inicio debe ser menor que la hora de fin');
    }
});
</script>
@endsection