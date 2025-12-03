@extends('layouts.app')

@section('title', 'Crear Evento')

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

    <h2>Crear Nuevo Evento</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('eventos.store') }}" method="POST" id="form-crear-evento">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <label>Nombre del evento:</label>
                <input type="text" 
                       name="nombre_evento" 
                       class="form-control" 
                       data-validate="nombre-evento"
                       maxlength="30"
                       required>
            </div>

            <div class="col-md-6">
                <label>Tipo de evento:</label>
                <select name="id_tipoevento" class="form-control" required>
                    <option value="">Seleccione un tipo</option>
                    @foreach($tiposEvento as $tipo)
                        <option value="{{ $tipo->id_tipoevento }}">
                            {{ $tipo->descripcion_tipoevento }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Cantidad de personas:</label>
                <input type="number" 
                       name="cantidad_personas" 
                       class="form-control" 
                       data-validate="cantidad-personas"
                       min="1"
                       required>
            </div>

            <div class="col-md-6">
                <label>Zona del evento:</label>
                <select name="id_zona" class="form-control" required>
                    <option value="">Seleccione una zona</option>
                    @foreach($zonas as $zona)
                        <option value="{{ $zona->id_zona }}">
                            {{ $zona->nombre_zona }} - {{ $zona->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Fecha:</label>
                <input type="date" 
                       name="fecha_evento" 
                       class="form-control" 
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
                            @endphp
                            <option value="{{ $time24 }}">{{ $timeDisplay }}</option>
                        @endforeach
                    @endfor
                </select>
            </div>
        </div>
        
        <label>Descripción:</label>
        <textarea name="descripcion_evento"
                  class="form-control"
                  data-validate="descripcion"
                  data-max="500"
                  rows="3"></textarea>

        <div style="text-align:center; margin-top:25px;">
            <button type="submit" class="button-primary">
                Crear Evento
            </button>
        </div>
    </form>
</div>
@endsection