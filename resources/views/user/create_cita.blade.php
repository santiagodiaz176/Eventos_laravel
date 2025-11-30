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
                <input type="date" name="fecha_cita" class="form-control" min="{{ now()->toDateString() }}" 
                max="{{ \Carbon\Carbon::parse($evento->fecha_evento)->subDay()->toDateString() }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Hora de la cita:</label>
                <input type="time" name="hora_cita" class="form-control" required>
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
