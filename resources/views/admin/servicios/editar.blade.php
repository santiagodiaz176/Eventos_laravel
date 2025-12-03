
@extends('layouts.app')

@section('title', 'Editar Servicios')

{{-- Incluir los mismos estilos que crear.blade.php --}}
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@include('admin.servicios.partials.estilos')
@endsection

@section('content')
<div class="servicios-container">
    
    <div class="servicios-header">
        <h2><i class="fas fa-edit"></i> Editar Servicios del Evento</h2>
    </div>

    <div class="info-evento">
        <p><strong>Cliente:</strong> {{ $cita->usuario->nombre ?? $cita->nombre }}</p>
        <p><strong>Evento:</strong> {{ $cita->evento->nombre_evento }}</p>
        <p><strong>Fecha:</strong> {{ $cita->evento->fecha_evento }}</p>
        <p><strong>Tipo:</strong> {{ $cita->evento->tipoevento->descripcion_tipoevento }}</p>
        <p><strong>Personas:</strong> {{ $cita->evento->cantidad_personas }}</p>
        <p><strong>Estado:</strong> 
            <span class="badge 
                {{ $servicio->estado === 'borrador' ? 'badge-warning' : '' }}
                {{ $servicio->estado === 'enviado' ? 'badge-info' : '' }}
                {{ $servicio->estado === 'aprobado' ? 'badge-success' : '' }}">
                {{ ucfirst($servicio->estado) }}
            </span>
        </p>
    </div>

    <form action="{{ route('admin.servicios.update', $servicio->id_servicio_contratado) }}" 
          method="POST" 
          id="form-servicios">
        @csrf
        @method('PUT')

        {{-- SERVICIOS BÁSICOS --}}
        <div class="servicio-section">
            <h3><i class="fas fa-music"></i> Servicios Básicos</h3>
            
            <div class="servicio-checkbox">
                <input type="checkbox" name="incluye_dj" id="dj" value="1" 
                       {{ $servicio->incluye_dj ? 'checked' : '' }}>
                <label for="dj">DJ Profesional - $200,000</label>
            </div>

            <div class="servicio-checkbox">
                <input type="checkbox" name="incluye_sonido" id="sonido" value="1"
                       {{ $servicio->incluye_sonido ? 'checked' : '' }}>
                <label for="sonido">Sistema de Sonido - $150,000</label>
            </div>

            <div class="servicio-checkbox">
                <input type="checkbox" name="incluye_animador" id="animador" value="1"
                       {{ $servicio->incluye_animador ? 'checked' : '' }}>
                <label for="animador">Animador - $180,000</label>
            </div>
        </div>

        {{-- SALONES --}}
        <div class="servicio-section">
            <h3><i class="fas fa-building"></i> Salones</h3>
            
            <div class="servicio-checkbox">
                <input type="checkbox" id="check-salones" {{ $servicio->id_salon ? 'checked' : '' }}>
                <label for="check-salones">Incluir Salón</label>
            </div>

            <div class="servicio-detalle {{ $servicio->id_salon ? 'active' : '' }}" id="detalle-salones">
                @foreach($salones as $salon)
                    <div class="item-seleccion">
                        <input type="radio" name="id_salon" id="salon_{{ $salon->id_salon }}" 
                               value="{{ $salon->id_salon }}"
                               {{ $servicio->id_salon == $salon->id_salon ? 'checked' : '' }}>
                        <label for="salon_{{ $salon->id_salon }}">
                            <strong>{{ $salon->nombre_salon }}</strong> - {{ $salon->zona }}<br>
                            <small>{{ $salon->descripcion }} (Cap: {{ $salon->capacidad }} personas)</small>
                        </label>
                        <span class="precio-item">${{ number_format($salon->precio, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- DECORACIÓN --}}
        <div class="servicio-section">
            <h3><i class="fas fa-palette"></i> Decoración</h3>
            
            <div class="servicio-checkbox">
                <input type="checkbox" id="check-decoracion" {{ $servicio->id_decoracion ? 'checked' : '' }}>
                <label for="check-decoracion">Incluir Decoración</label>
            </div>

            <div class="servicio-detalle {{ $servicio->id_decoracion ? 'active' : '' }}" id="detalle-decoracion">
                @foreach($decoraciones as $decoracion)
                    <div class="item-seleccion">
                        <input type="radio" name="id_decoracion" id="deco_{{ $decoracion->id_decoracion }}" 
                               value="{{ $decoracion->id_decoracion }}"
                               {{ $servicio->id_decoracion == $decoracion->id_decoracion ? 'checked' : '' }}>
                        <label for="deco_{{ $decoracion->id_decoracion }}">
                            <strong>{{ $decoracion->tipo_decoracion }}</strong><br>
                            <small>{{ $decoracion->descripcion }}</small>
                        </label>
                        <span class="precio-item">${{ number_format($decoracion->precio, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- COMIDA --}}
        <div class="servicio-section">
            <h3><i class="fas fa-utensils"></i> Catering</h3>
            
            <div class="servicio-checkbox">
                <input type="checkbox" id="check-comida" {{ $servicio->comidas->count() > 0 ? 'checked' : '' }}>
                <label for="check-comida">Incluir Comida</label>
            </div>

            <div class="servicio-detalle {{ $servicio->comidas->count() > 0 ? 'active' : '' }}" id="detalle-comida">
                <p><strong>Seleccione hasta 3 platos:</strong></p>
                
                <h4 style="margin-top:15px;">Entradas</h4>
                @foreach($comidas->where('tipo', 'entrada') as $comida)
                    <div class="item-seleccion">
                        <input type="checkbox" name="comidas[]" value="{{ $comida->id_comida }}"
                               class="comida-check"
                               {{ $servicio->comidas->contains($comida->id_comida) ? 'checked' : '' }}>
                        <label>
                            <strong>{{ $comida->nombre_comida }}</strong><br>
                            <small>{{ $comida->descripcion }}</small>
                        </label>
                        <span class="precio-item">${{ number_format($comida->precio, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <h4 style="margin-top:15px;">Platos Fuertes</h4>
                @foreach($comidas->where('tipo', 'plato_fuerte') as $comida)
                    <div class="item-seleccion">
                        <input type="checkbox" name="comidas[]" value="{{ $comida->id_comida }}"
                               class="comida-check"
                               {{ $servicio->comidas->contains($comida->id_comida) ? 'checked' : '' }}>
                        <label>
                            <strong>{{ $comida->nombre_comida }}</strong><br>
                            <small>{{ $comida->descripcion }}</small>
                        </label>
                        <span class="precio-item">${{ number_format($comida->precio, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <h4 style="margin-top:15px;">Postres</h4>
                @foreach($comidas->where('tipo', 'postre') as $comida)
                    <div class="item-seleccion">
                        <input type="checkbox" name="comidas[]" value="{{ $comida->id_comida }}"
                               class="comida-check"
                               {{ $servicio->comidas->contains($comida->id_comida) ? 'checked' : '' }}>
                        <label>
                            <strong>{{ $comida->nombre_comida }}</strong><br>
                            <small>{{ $comida->descripcion }}</small>
                        </label>
                        <span class="precio-item">${{ number_format($comida->precio, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- BEBIDAS --}}
        <div class="servicio-section">
            <h3><i class="fas fa-cocktail"></i> Bebidas Alcohólicas</h3>
            
            <div class="servicio-checkbox">
                <input type="checkbox" id="check-bebidas" {{ $servicio->bebidas->count() > 0 ? 'checked' : '' }}>
                <label for="check-bebidas">Incluir Bebidas</label>
            </div>

            <div class="servicio-detalle {{ $servicio->bebidas->count() > 0 ? 'active' : '' }}" id="detalle-bebidas">
                <p><strong>Seleccione las bebidas deseadas:</strong></p>
                
                @foreach($bebidas->groupBy('tipo') as $tipo => $bebidasTipo)
                    <h4 style="margin-top:15px;text-transform:capitalize;">{{ $tipo }}</h4>
                    @foreach($bebidasTipo as $bebida)
                        <div class="item-seleccion">
                            <input type="checkbox" name="bebidas[]" value="{{ $bebida->id_bebida }}"
                                   {{ $servicio->bebidas->contains($bebida->id_bebida) ? 'checked' : '' }}>
                            <label>
                                <strong>{{ $bebida->nombre_bebida }}</strong><br>
                                <small>{{ $bebida->descripcion }}</small>
                            </label>
                            <span class="precio-item">${{ number_format($bebida->precio, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        {{-- RESUMEN --}}
        <div class="resumen-total">
            <h3>Resumen</h3>
            <div class="resumen-linea">
                <span>Subtotal:</span>
                <span id="subtotal">${{ number_format($servicio->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="resumen-linea">
                <span>IVA (19%):</span>
                <span id="iva">${{ number_format($servicio->iva, 0, ',', '.') }}</span>
            </div>
            <div class="resumen-linea resumen-total-final">
                <span>TOTAL:</span>
                <span id="total">${{ number_format($servicio->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Actualizar Servicios
            </button>
            <a href="{{ route('admin.index', ['tab' => 'servicios']) }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>

</div>
@endsection

@section('scripts')
{{-- Incluir el mismo script de crear.blade.php --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Toggle detalles de servicios
    const checkboxes = [
        { check: 'check-salones', detalle: 'detalle-salones' },
        { check: 'check-decoracion', detalle: 'detalle-decoracion' },
        { check: 'check-comida', detalle: 'detalle-comida' },
        { check: 'check-bebidas', detalle: 'detalle-bebidas' }
    ];

    checkboxes.forEach(item => {
        const checkbox = document.getElementById(item.check);
        const detalle = document.getElementById(item.detalle);
        
        if (checkbox && detalle) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    detalle.classList.add('active');
                } else {
                    detalle.classList.remove('active');
                    detalle.querySelectorAll('input').forEach(inp => inp.checked = false);
                }
                calcularTotal();
            });
        }
    });

    // Limitar comidas a 3
    const comidasChecks = document.querySelectorAll('.comida-check');
    comidasChecks.forEach(check => {
        check.addEventListener('change', function() {
            const checked = document.querySelectorAll('.comida-check:checked');
            if (checked.length > 3) {
                this.checked = false;
                alert('Solo puedes seleccionar hasta 3 platos');
            }
            calcularTotal();
        });
    });

    // Calcular total
    function calcularTotal() {
        let subtotal = 0;

        if (document.getElementById('dj').checked) subtotal += 200000;
        if (document.getElementById('sonido').checked) subtotal += 150000;
        if (document.getElementById('animador').checked) subtotal += 180000;

        const salonSelected = document.querySelector('input[name="id_salon"]:checked');
        if (salonSelected) {
            const precio = salonSelected.closest('.item-seleccion').querySelector('.precio-item').textContent;
            subtotal += parseInt(precio.replace(/\D/g, ''));
        }

        const decoSelected = document.querySelector('input[name="id_decoracion"]:checked');
        if (decoSelected) {
            const precio = decoSelected.closest('.item-seleccion').querySelector('.precio-item').textContent;
            subtotal += parseInt(precio.replace(/\D/g, ''));
        }

        document.querySelectorAll('input[name="comidas[]"]:checked').forEach(check => {
            const precio = check.closest('.item-seleccion').querySelector('.precio-item').textContent;
            subtotal += parseInt(precio.replace(/\D/g, ''));
        });

        document.querySelectorAll('input[name="bebidas[]"]:checked').forEach(check => {
            const precio = check.closest('.item-seleccion').querySelector('.precio-item').textContent;
            subtotal += parseInt(precio.replace(/\D/g, ''));
        });

        const iva = subtotal * 0.19;
        const total = subtotal + iva;

        document.getElementById('subtotal').textContent = '$' + subtotal.toLocaleString('es-CO');
        document.getElementById('iva').textContent = '$' + Math.round(iva).toLocaleString('es-CO');
        document.getElementById('total').textContent = '$' + Math.round(total).toLocaleString('es-CO');
    }

    // Inicializar cálculo
    calcularTotal();

    // Actualizar al cambiar cualquier input
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('change', calcularTotal);
    });
});
</script>
@endsection