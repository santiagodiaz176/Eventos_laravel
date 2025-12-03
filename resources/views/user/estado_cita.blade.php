@extends('layouts.app')

@section('title', 'Estado de tu cita')


@section('content')
<div class="estado-container">

    <div class="estado-cita-box">

        <h4 class="text-center mb-4">Estado de tu cita</h4>

        <div class="estado-item">
            <span>Evento</span>
            <strong>{{ $cita->evento->nombre_evento }}</strong>
        </div>

        <div class="estado-item">
            <span>Fecha</span>
            <strong>{{ $cita->fecha_cita }}</strong>
        </div>

        <div class="estado-item">
            <span>Hora</span>
            <strong>{{ $cita->hora_cita }}</strong>
        </div>

        <hr>

        <div class="estado-final">
            <span>Estado</span>
            <strong style="display:block; margin-top:8px;">
                {{ $cita->estado->nombre_estado }}
            </strong>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('eventos.index') }}"
               class="button button-sm button-primary-outline button-ujarak">
                ← Volver a mis eventos
            </a>
        </div>

    </div>

</div>
@endsection

@section('styles')
<style>
.estado-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.estado-cita-box {
    width: 100%;
    max-width: 480px;
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.estado-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 14px;
}

.estado-item span {
    color: #777;
}

.estado-final {
    text-align: center;
    margin-top: 20px;
}
</style>
@endsection
