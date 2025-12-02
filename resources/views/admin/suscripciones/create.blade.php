@extends('layouts.app')

@section('title', 'Agregar Suscripción')

@section('content')
<style>
body {
    font-family: Arial, sans-serif;
    background: #d9ecf5;
}

.container {
    max-width: 480px;
    margin: 50px auto;
    background: #ffffff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

h2 {
    text-align: center;
    color: #2c3e50;
}

.form-group { margin-bottom: 15px; }

label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px;
}

input, select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    background: #f8f9fa;
    border: 1px solid #bbb;
}

.btn {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    font-weight: bold;
    border: none;
    cursor: pointer;
}

.btn-success {
    background: #2ecc71;
    color: #fff;
}

.btn-success:hover {
    background: #27ae60;
}

.btn-back {
    display: block;
    margin-top: 15px;
    text-align: center;
    color: #3498db;
    font-weight: bold;
    text-decoration: none;
}

.btn-secondary {
    background: #6c757d;
    color: #fff;
    margin-top: 15px;
}

.btn-secondary:hover {
    background: #5a6268;
}

.error-message {
    color: #e74c3c;
    font-size: 14px;
    margin-top: 5px;
    display: none;
}
</style>

<div class="container">
    <h2>Agregar Suscripción</h2>

    <form action="{{ route('admin.suscripciones.store') }}" method="POST" id="suscripcionForm">
        @csrf

        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="correo" id="correo" value="{{ old('correo') }}" required>
            <span class="error-message" id="errorCorreo"></span>
            @error('correo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Estado</label>
            <select name="estado" id="estado" required>
                <option value="">Seleccione un estado</option>
                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            <span class="error-message" id="errorEstado"></span>
            @error('estado')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            Guardar Suscripción
        </button>

    </form>

    <a href="{{ route('admin.index', ['tab' => 'suscripciones']) }}" class="btn btn-secondary">  
        ← Volver al Panel de Suscripciones
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('suscripcionForm');
    const correoInput = document.getElementById('correo');
    const estadoSelect = document.getElementById('estado');
    const errorCorreo = document.getElementById('errorCorreo');
    const errorEstado = document.getElementById('errorEstado');

    // Dominios permitidos
    const dominiosPermitidos = [
        'gmail.com',
        'hotmail.com',
        'outlook.com',
        'yahoo.com',
        'icloud.com',
        'live.com',
        'msn.com',
        'aol.com',
        'zoho.com',
        'protonmail.com'
    ];

    function limpiarErrores() {
        errorCorreo.textContent = '';
        errorCorreo.style.display = 'none';
        errorEstado.textContent = '';
        errorEstado.style.display = 'none';
    }

    function validarCorreo(email) {
        // Validar formato básico
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            return { valido: false, mensaje: 'Formato de correo inválido.' };
        }

        // Extraer dominio
        const dominio = email.split('@')[1].toLowerCase();

        // Validar dominio permitido
        if (!dominiosPermitidos.includes(dominio)) {
            return { 
                valido: false, 
                mensaje: `Solo se permiten correos de: ${dominiosPermitidos.join(', ')}.` 
            };
        }

        return { valido: true, mensaje: '' };
    }

    function validarFormulario() {
        let valido = true;
        limpiarErrores();

        const email = correoInput.value.trim();
        const estado = estadoSelect.value;

        // Validar correo
        if (!email) {
            errorCorreo.textContent = 'El correo es obligatorio.';
            errorCorreo.style.display = 'block';
            valido = false;
        } else {
            const resultadoValidacion = validarCorreo(email);
            if (!resultadoValidacion.valido) {
                errorCorreo.textContent = resultadoValidacion.mensaje;
                errorCorreo.style.display = 'block';
                valido = false;
            }
        }

        // Validar estado
        if (!estado) {
            errorEstado.textContent = 'Debe seleccionar un estado.';
            errorEstado.style.display = 'block';
            valido = false;
        }

        return valido;
    }

    // Validación en tiempo real para correo
    correoInput.addEventListener('blur', function() {
        const email = this.value.trim();
        errorCorreo.style.display = 'none';
        
        if (email) {
            const resultado = validarCorreo(email);
            if (!resultado.valido) {
                errorCorreo.textContent = resultado.mensaje;
                errorCorreo.style.display = 'block';
            }
        }
    });

    // Validación al enviar formulario
    form.addEventListener('submit', function(e) {
        if (!validarFormulario()) {
            e.preventDefault();
            console.log('Formulario no válido');
        }
    });
});
</script>
@endsection