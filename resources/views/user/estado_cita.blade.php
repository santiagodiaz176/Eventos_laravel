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
            <strong>{{ $cita->evento->fecha_evento }}</strong>
        </div>

        <div class="estado-item">
            <span>Hora</span>
            <strong>{{ $cita->evento->hora_evento }}</strong>
        </div>

        <div class="estado-item">
            <span>Zona</span>
            <strong>{{ $cita->evento->zona->nombre_zona ?? 'No especificada' }}</strong>
        </div>

        <hr>

        <div class="estado-final">
            <span>Estado de la Cita</span>
            <strong style="display:block; margin-top:8px;">
                {{ $cita->estado->nombre_estado }}
            </strong>
        </div>

        {{-- FACTURA DE SERVICIOS --}}
        @if($cita->serviciosContratados && $cita->serviciosContratados->estado === 'enviado')
            <div class="factura-servicios">
                <h4 class="factura-titulo">
                    <i class="fas fa-file-invoice"></i> Factura de Servicios
                </h4>

                @php
                    $servicios = $cita->serviciosContratados;
                @endphp

                <div class="factura-contenido">
                    
                    {{-- Servicios Básicos --}}
                    @if($servicios->incluye_dj || $servicios->incluye_sonido || $servicios->incluye_animador)
                        <div class="factura-seccion">
                            <h5>Servicios Básicos</h5>
                            <ul class="servicios-lista">
                                @if($servicios->incluye_dj)
                                    <li>
                                        <span>DJ Profesional</span>
                                        <span class="precio">$200,000</span>
                                    </li>
                                @endif
                                @if($servicios->incluye_sonido)
                                    <li>
                                        <span>Sistema de Sonido</span>
                                        <span class="precio">$150,000</span>
                                    </li>
                                @endif
                                @if($servicios->incluye_animador)
                                    <li>
                                        <span>Animador</span>
                                        <span class="precio">$180,000</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif

                    {{-- Salón --}}
                    @if($servicios->salon)
                        <div class="factura-seccion">
                            <h5>Salón</h5>
                            <ul class="servicios-lista">
                                <li>
                                    <span>
                                        {{ $servicios->salon->nombre_salon }}<br>
                                        <small>{{ $servicios->salon->zona }}</small>
                                    </span>
                                    <span class="precio">${{ number_format($servicios->salon->precio, 0, ',', '.') }}</span>
                                </li>
                            </ul>
                        </div>
                    @endif

                    {{-- Decoración --}}
                    @if($servicios->decoracion)
                        <div class="factura-seccion">
                            <h5>Decoración</h5>
                            <ul class="servicios-lista">
                                <li>
                                    <span>{{ $servicios->decoracion->tipo_decoracion }}</span>
                                    <span class="precio">${{ number_format($servicios->decoracion->precio, 0, ',', '.') }}</span>
                                </li>
                            </ul>
                        </div>
                    @endif

                    {{-- Comidas --}}
                    @if($servicios->comidas->count() > 0)
                        <div class="factura-seccion">
                            <h5>Catering</h5>
                            <ul class="servicios-lista">
                                @foreach($servicios->comidas as $comida)
                                    <li>
                                        <span>
                                            {{ $comida->nombre_comida }}<br>
                                            <small class="text-muted">{{ $comida->pivot->cantidad }} unidades × ${{ number_format($comida->pivot->precio_unitario, 0, ',', '.') }}</small>
                                        </span>
                                        <span class="precio">${{ number_format($comida->pivot->subtotal, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Bebidas --}}
                    @if($servicios->bebidas->count() > 0)
                        <div class="factura-seccion">
                            <h5>Bebidas</h5>
                            <ul class="servicios-lista">
                                @foreach($servicios->bebidas as $bebida)
                                    <li>
                                        <span>
                                            {{ $bebida->nombre_bebida }}<br>
                                            <small class="text-muted">{{ $bebida->pivot->cantidad }} unidades × ${{ number_format($bebida->pivot->precio_unitario, 0, ',', '.') }}</small>
                                        </span>
                                        <span class="precio">${{ number_format($bebida->pivot->subtotal, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Totales --}}
                    <div class="factura-totales">
                        <div class="total-linea">
                            <span>Subtotal:</span>
                            <span>${{ number_format($servicios->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-linea">
                            <span>IVA (19%):</span>
                            <span>${{ number_format($servicios->iva, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-linea total-final">
                            <span>TOTAL A PAGAR:</span>
                            <span>${{ number_format($servicios->total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                </div>
            </div>
        @endif

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
.estado-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.estado-cita-box {
    width: 100%;
    max-width: 600px;
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

.factura-servicios {
    margin-top: 30px;
    border: 2px solid #3498db;
    border-radius: 12px;
    padding: 20px;
    background: #f8f9fa;
}

.factura-titulo {
    color: #2c3e50;
    margin-bottom: 20px;
    text-align: center;
}

.factura-contenido {
    background: #fff;
    padding: 15px;
    border-radius: 8px;
}

.factura-seccion {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e0e0e0;
}

.factura-seccion:last-of-type {
    border-bottom: none;
}

.factura-seccion h5 {
    color: #34495e;
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: 600;
}

.servicios-lista {
    list-style: none;
    padding: 0;
    margin: 0;
}

.servicios-lista li {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    color: #555;
}

.servicios-lista li span.precio {
    font-weight: 700;
    color: #27ae60;
}

.factura-totales {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 2px solid #34495e;
}

.total-linea {
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
    font-size: 16px;
}

.total-linea.total-final {
    font-size: 20px;
    font-weight: 700;
    color: #2c3e50;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 2px solid #34495e;
}
</style>
@endsection