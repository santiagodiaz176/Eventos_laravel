@extends('layouts.app')

@section('title', 'Editar Servicios')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
}

.servicios-container {
    max-width: 1000px;
    margin: 30px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.servicios-header {
    text-align: center;
    margin-bottom: 30px;
}

.servicios-header h2 {
    color: #2c3e50;
    font-size: 28px;
    margin-bottom: 10px;
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

.servicio-section {
    margin-bottom: 30px;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 20px;
}

.servicio-section h3 {
    color: #2c3e50;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.servicio-checkbox {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
}

.servicio-checkbox input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
}

.servicio-checkbox label {
    font-weight: 600;
    cursor: pointer;
    margin: 0;
}

.servicio-detalle {
    display: none;
    margin-top: 15px;
    padding: 15px;
    background: #fff;
    border: 2px solid #3498db;
    border-radius: 8px;
}

.servicio-detalle.active {
    display: block;
}

.item-seleccion {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 6px;
    margin-bottom: 8px;
}

.item-seleccion input[type="checkbox"],
.item-seleccion input[type="radio"] {
    width: 18px;
    height: 18px;
}

.item-seleccion label {
    flex: 1;
    margin: 0;
}

.precio-item {
    font-weight: 700;
    color: #27ae60;
}

.alert-info {
    background: #e3f2fd;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.text-muted {
    color: #6c757d;
    font-size: 0.9em;
}

.badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.badge-warning {
    background: #ffc107;
    color: #000;
}

.badge-info {
    background: #17a2b8;
    color: #fff;
}

.badge-success {
    background: #28a745;
    color: #fff;
}

.resumen-total {
    background: #34495e;
    color: white;
    padding: 20px;
    border-radius: 10px;
    margin-top: 30px;
}

.resumen-total h3 {
    margin-top: 0;
    color: white;
}

.resumen-linea {
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
    font-size: 16px;
}

.resumen-total-final {
    font-size: 24px;
    font-weight: 700;
    border-top: 2px solid #fff;
    padding-top: 15px;
    margin-top: 15px;
}

.btn-group {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 25px;
}

.btn {
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s;
}

.btn-success {
    background: #27ae60;
    color: #fff;
}

.btn-success:hover {
    background: #229954;
}

.btn-secondary {
    background: #95a5a6;
    color: #fff;
}

.btn-secondary:hover {
    background: #7f8c8d;
}
</style>
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
                <div class="alert-info" style="background: #e3f2fd; padding: 12px; border-radius: 8px; margin-bottom: 15px;">
                    <strong><i class="fas fa-info-circle"></i> Información:</strong> 
                    Los platos seleccionados se multiplicarán automáticamente por {{ $cita->evento->cantidad_personas }} personas.
                </div>
                <p><strong>Seleccione hasta 3 platos:</strong></p>
                
                <h4 style="margin-top:15px;">Entradas</h4>
                @foreach($comidas->where('tipo', 'entrada') as $comida)
                    <div class="item-seleccion">
                        <input type="checkbox" name="comidas[]" value="{{ $comida->id_comida }}"
                               class="comida-check"
                               data-precio="{{ $comida->precio }}"
                               {{ $servicio->comidas->contains($comida->id_comida) ? 'checked' : '' }}>
                        <label>
                            <strong>{{ $comida->nombre_comida }}</strong><br>
                            <small>{{ $comida->descripcion }}</small><br>
                            <small class="text-muted">Precio unitario: ${{ number_format($comida->precio, 0, ',', '.') }}</small>
                        </label>
                        <span class="precio-item">${{ number_format($comida->precio * $cita->evento->cantidad_personas, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <h4 style="margin-top:15px;">Platos Fuertes</h4>
                @foreach($comidas->where('tipo', 'plato_fuerte') as $comida)
                    <div class="item-seleccion">
                        <input type="checkbox" name="comidas[]" value="{{ $comida->id_comida }}"
                               class="comida-check"
                               data-precio="{{ $comida->precio }}"
                               {{ $servicio->comidas->contains($comida->id_comida) ? 'checked' : '' }}>
                        <label>
                            <strong>{{ $comida->nombre_comida }}</strong><br>
                            <small>{{ $comida->descripcion }}</small><br>
                            <small class="text-muted">Precio unitario: ${{ number_format($comida->precio, 0, ',', '.') }}</small>
                        </label>
                        <span class="precio-item">${{ number_format($comida->precio * $cita->evento->cantidad_personas, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <h4 style="margin-top:15px;">Postres</h4>
                @foreach($comidas->where('tipo', 'postre') as $comida)
                    <div class="item-seleccion">
                        <input type="checkbox" name="comidas[]" value="{{ $comida->id_comida }}"
                               class="comida-check"
                               data-precio="{{ $comida->precio }}"
                               {{ $servicio->comidas->contains($comida->id_comida) ? 'checked' : '' }}>
                        <label>
                            <strong>{{ $comida->nombre_comida }}</strong><br>
                            <small>{{ $comida->descripcion }}</small><br>
                            <small class="text-muted">Precio unitario: ${{ number_format($comida->precio, 0, ',', '.') }}</small>
                        </label>
                        <span class="precio-item">${{ number_format($comida->precio * $cita->evento->cantidad_personas, 0, ',', '.') }}</span>
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
                <div class="alert-info" style="background: #fff3cd; padding: 12px; border-radius: 8px; margin-bottom: 15px;">
                    <strong><i class="fas fa-info-circle"></i> Información:</strong> 
                    Seleccione la cantidad de bebidas por persona ({{ $cita->evento->cantidad_personas }} invitados).
                </div>
                <p><strong>Seleccione las bebidas y cantidad por persona:</strong></p>
                
                @foreach($bebidas->groupBy('tipo') as $tipo => $bebidasTipo)
                    <h4 style="margin-top:15px;text-transform:capitalize;">{{ $tipo }}</h4>
                    @foreach($bebidasTipo as $bebida)
                        @php
                            $bebidaSeleccionada = $servicio->bebidas->find($bebida->id_bebida);
                            $cantidadPorPersona = $bebidaSeleccionada ? round($bebidaSeleccionada->pivot->cantidad / $cita->evento->cantidad_personas) : 1;
                        @endphp
                        <div class="item-seleccion bebida-item">
                            <input type="checkbox" 
                                   name="bebidas[{{ $bebida->id_bebida }}][selected]" 
                                   value="1"
                                   class="bebida-check"
                                   data-bebida-id="{{ $bebida->id_bebida }}"
                                   data-precio="{{ $bebida->precio }}"
                                   {{ $servicio->bebidas->contains($bebida->id_bebida) ? 'checked' : '' }}>
                            <label style="flex: 1;">
                                <strong>{{ $bebida->nombre_bebida }}</strong><br>
                                <small>{{ $bebida->descripcion }}</small><br>
                                <small class="text-muted">Precio unitario: ${{ number_format($bebida->precio, 0, ',', '.') }}</small>
                            </label>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <input type="number" 
                                       name="bebidas[{{ $bebida->id_bebida }}][cantidad_por_persona]" 
                                       class="cantidad-bebida"
                                       data-bebida-id="{{ $bebida->id_bebida }}"
                                       min="1" 
                                       max="10" 
                                       value="{{ $cantidadPorPersona }}"
                                       style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;"
                                       placeholder="Cant">
                                <span class="text-muted" style="font-size: 12px;">por persona</span>
                                <span class="precio-item bebida-precio-{{ $bebida->id_bebida }}">
                                    ${{ number_format($bebida->precio * $cantidadPorPersona * $cita->evento->cantidad_personas, 0, ',', '.') }}
                                </span>
                            </div>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cantidadPersonas = {{ $cita->evento->cantidad_personas }};
    
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

    // Manejar cambios en cantidad de bebidas
    document.querySelectorAll('.cantidad-bebida').forEach(input => {
        input.addEventListener('input', function() {
            const bebidaId = this.dataset.bebidaId;
            const checkbox = document.querySelector(`.bebida-check[data-bebida-id="${bebidaId}"]`);
            const cantidad = parseInt(this.value) || 1;
            const precioUnitario = parseFloat(checkbox.dataset.precio);
            
            // Actualizar precio total de esta bebida
            const precioTotal = precioUnitario * cantidad * cantidadPersonas;
            const precioSpan = document.querySelector(`.bebida-precio-${bebidaId}`);
            if (precioSpan) {
                precioSpan.textContent = '$' + precioTotal.toLocaleString('es-CO');
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

        // Comidas (multiplicadas por cantidad de personas)
        document.querySelectorAll('input[name="comidas[]"]:checked').forEach(check => {
            const precioUnitario = parseFloat(check.dataset.precio);
            subtotal += precioUnitario * cantidadPersonas;
        });

        // Bebidas (con cantidad por persona)
        document.querySelectorAll('.bebida-check:checked').forEach(check => {
            const bebidaId = check.dataset.bebidaId;
            const cantidadInput = document.querySelector(`.cantidad-bebida[data-bebida-id="${bebidaId}"]`);
            const cantidad = parseInt(cantidadInput.value) || 1;
            const precioUnitario = parseFloat(check.dataset.precio);
            subtotal += precioUnitario * cantidad * cantidadPersonas;
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