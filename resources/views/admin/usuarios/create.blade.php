@extends('layouts.app')

@section('title', 'Crear Usuario')

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

.form-group { 
    margin-bottom: 15px;
    position: relative;
}

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
    box-sizing: border-box;
}

input.error-border {
    border-color: #e74c3c;
}

.error-message {
    color: #e74c3c;
    font-size: 13px;
    margin-top: 5px;
    display: none;
}

.password-toggle-icon {
    position: absolute;
    right: 15px;
    top: 38px;
    cursor: pointer;
    color: #999;
    font-size: 18px;
    transition: color 0.3s;
}

.password-toggle-icon:hover {
    color: #333;
}

.password-strength {
    height: 4px;
    margin-top: 5px;
    border-radius: 2px;
    transition: all 0.3s;
}

.strength-weak { background: #e74c3c; width: 33%; }
.strength-medium { background: #f39c12; width: 66%; }
.strength-strong { background: #27ae60; width: 100%; }

.password-requirements {
    font-size: 12px;
    margin-top: 8px;
    color: #7f8c8d;
}

.requirement {
    display: flex;
    align-items: center;
    margin-bottom: 3px;
}

.requirement.met {
    color: #27ae60;
}

.requirement::before {
    content: '✗';
    margin-right: 5px;
    font-weight: bold;
}

.requirement.met::before {
    content: '✓';
}

.btn {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    font-weight: bold;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #3498db;
    color: #fff;
}

.btn-primary:hover { 
    background: #2980b9; 
}

.btn-primary:disabled {
    background: #95a5a6;
    cursor: not-allowed;
}

.btn-back {
    display: block;
    margin-top: 15px;
    text-align: center;
    color: #3498db;
    font-weight: bold;
    text-decoration: none;
}
</style>

<div class="container">
    <h2>Nuevo Usuario</h2>

    <form method="POST" action="{{ route('usuarios.store') }}" id="createUserForm">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
            <span class="error-message" id="errorNombre"></span>
            @error('nombre')
                <span class="error-message" style="display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos') }}" required>
            <span class="error-message" id="errorApellidos"></span>
            @error('apellidos')
                <span class="error-message" style="display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            <span class="error-message" id="errorEmail"></span>
            @error('email')
                <span class="error-message" style="display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="clave" id="clave" required>
            <span class="password-toggle-icon" id="toggleClave" onclick="togglePassword('clave', 'toggleClave')">👁️</span>
            <div class="password-strength" id="passwordStrength"></div>
            <span class="error-message" id="errorClave"></span>
            
            <div class="password-requirements">
                <div class="requirement" id="req-length">Mínimo 8 caracteres</div>
                <div class="requirement" id="req-uppercase">Una mayúscula</div>
                <div class="requirement" id="req-lowercase">Una minúscula</div>
                <div class="requirement" id="req-number">Un número</div>
                <div class="requirement" id="req-special">Un carácter especial (!@#$%^&*)</div>
            </div>
            @error('clave')
                <span class="error-message" style="display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Confirmar Contraseña</label>
            <input type="password" name="clave_confirmation" id="clave_confirmation" required>
            <span class="password-toggle-icon" id="toggleClaveConfirmation" onclick="togglePassword('clave_confirmation', 'toggleClaveConfirmation')">👁️</span>
            <span class="error-message" id="errorClaveConfirmation"></span>
            @error('clave_confirmation')
                <span class="error-message" style="display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Perfil</label>
            <select name="perfil" id="perfil" required>
                <option value="">Seleccione un perfil</option>
                <option value="admin" {{ old('perfil') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('perfil') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            <span class="error-message" id="errorPerfil"></span>
            @error('perfil')
                <span class="error-message" style="display: block;">{{ $message }}</span>
            @enderror
        </div>

        <input type="hidden" name="estado" value="1">

        <button class="btn btn-primary" type="submit" id="submitBtn">
            Guardar Usuario
        </button>
    </form>

    <a href="{{ route('admin.index') }}" class="btn-back">
        ← Volver al Panel
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createUserForm');
    const fields = {
        nombre: { el: document.getElementById('nombre'), err: document.getElementById('errorNombre') },
        apellidos: { el: document.getElementById('apellidos'), err: document.getElementById('errorApellidos') },
        email: { el: document.getElementById('email'), err: document.getElementById('errorEmail') },
        clave: { el: document.getElementById('clave'), err: document.getElementById('errorClave') },
        claveConfirmation: { el: document.getElementById('clave_confirmation'), err: document.getElementById('errorClaveConfirmation') },
        perfil: { el: document.getElementById('perfil'), err: document.getElementById('errorPerfil') }
    };

    const passwordStrength = document.getElementById('passwordStrength');

    // ============================================
    // VALIDACIONES EN TIEMPO REAL
    // ============================================
    
    // NOMBRE: Permite espacios entre palabras pero NO al inicio
    fields.nombre.el.addEventListener('input', function() {
        let valor = this.value;
        
        // Eliminar números y caracteres especiales
        valor = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
        
        // Eliminar espacios al inicio
        valor = valor.replace(/^\s+/, '');
        
        // Reemplazar múltiples espacios consecutivos por uno solo
        valor = valor.replace(/\s{2,}/g, ' ');
        
        this.value = valor;
    });
    
    // APELLIDOS: Permite espacios entre palabras pero NO al inicio
    fields.apellidos.el.addEventListener('input', function() {
        let valor = this.value;
        
        // Eliminar números
        valor = valor.replace(/[0-9]/g, '');
        
        // Eliminar espacios al inicio
        valor = valor.replace(/^\s+/, '');
        
        // Reemplazar múltiples espacios consecutivos por uno solo
        valor = valor.replace(/\s{2,}/g, ' ');
        
        this.value = valor;
    });

    // EMAIL: No permite espacios y debe terminar en .com
    fields.email.el.addEventListener('input', function() {
        // Elimina todos los espacios
        this.value = this.value.replace(/\s+/g, '');
    });

    // Validar al pegar texto
    fields.nombre.el.addEventListener('paste', function(e) {
        setTimeout(() => {
            let valor = this.value;
            valor = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
            valor = valor.replace(/^\s+/, '');
            valor = valor.replace(/\s{2,}/g, ' ');
            this.value = valor;
        }, 10);
    });

    fields.apellidos.el.addEventListener('paste', function(e) {
        setTimeout(() => {
            let valor = this.value;
            valor = valor.replace(/[0-9]/g, '');
            valor = valor.replace(/^\s+/, '');
            valor = valor.replace(/\s{2,}/g, ' ');
            this.value = valor;
        }, 10);
    });

    fields.email.el.addEventListener('paste', function(e) {
        setTimeout(() => {
            this.value = this.value.replace(/\s+/g, '');
        }, 10);
    });

    function limpiarErrores() {
        Object.values(fields).forEach(f => {
            f.err.textContent = '';
            f.err.style.display = 'none';
            f.el.classList.remove('error-border');
        });
    }

    function validarNombre(nombre) {
        nombre = nombre.trim();
        
        if (!nombre) {
            return { valido: false, mensaje: 'El nombre es obligatorio.' };
        }
        if (nombre.length < 2) {
            return { valido: false, mensaje: 'El nombre debe tener al menos 2 caracteres.' };
        }
        if (/^\s/.test(nombre)) {
            return { valido: false, mensaje: 'El nombre no puede comenzar con espacio.' };
        }
        if (/\s{2,}/.test(nombre)) {
            return { valido: false, mensaje: 'El nombre no puede tener espacios consecutivos.' };
        }
        if (nombre.endsWith(' ')) {
            return { valido: false, mensaje: 'El nombre no puede terminar con espacio.' };
        }
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+(\s[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+)*$/.test(nombre)) {
            return { valido: false, mensaje: 'El nombre solo puede contener letras y espacios simples.' };
        }
        return { valido: true };
    }

    function validarApellidos(apellidos) {
        apellidos = apellidos.trim();
        
        if (!apellidos) {
            return { valido: false, mensaje: 'Los apellidos son obligatorios.' };
        }
        if (apellidos.length < 2) {
            return { valido: false, mensaje: 'Los apellidos deben tener al menos 2 caracteres.' };
        }
        if (/^\s/.test(apellidos)) {
            return { valido: false, mensaje: 'Los apellidos no pueden comenzar con espacio.' };
        }
        if (/\s{2,}/.test(apellidos)) {
            return { valido: false, mensaje: 'Los apellidos no pueden tener espacios consecutivos.' };
        }
        if (apellidos.endsWith(' ')) {
            return { valido: false, mensaje: 'Los apellidos no pueden terminar con espacio.' };
        }
        if (/[0-9]/.test(apellidos)) {
            return { valido: false, mensaje: 'Los apellidos no pueden contener números.' };
        }
        return { valido: true };
    }

    function validarEmail(email) {
        email = email.trim();
        
        if (!email) {
            return { valido: false, mensaje: 'El email es obligatorio.' };
        }
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            return { valido: false, mensaje: 'Formato de email inválido.' };
        }

        // Validar que no contenga espacios
        if (/\s/.test(email)) {
            return { valido: false, mensaje: 'El email no puede contener espacios.' };
        }

        // Validar que termine EXACTAMENTE en .com (sin caracteres adicionales)
        if (!email.endsWith('.com')) {
            return { valido: false, mensaje: 'El email debe terminar en .com' };
        }

        // Validar que no haya nada después de .com
        const regexComExacto = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/;
        if (!regexComExacto.test(email)) {
            return { valido: false, mensaje: 'El email solo puede terminar en .com (sin caracteres adicionales).' };
        }

        return { valido: true };
    }

    function validarPasswordRequisitos(password) {
        const requisitos = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            lowercase: /[a-z]/.test(password),
            number: /[0-9]/.test(password),
            special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
        };

        // Actualizar visualización de requisitos
        document.getElementById('req-length').classList.toggle('met', requisitos.length);
        document.getElementById('req-uppercase').classList.toggle('met', requisitos.uppercase);
        document.getElementById('req-lowercase').classList.toggle('met', requisitos.lowercase);
        document.getElementById('req-number').classList.toggle('met', requisitos.number);
        document.getElementById('req-special').classList.toggle('met', requisitos.special);

        return requisitos;
    }

    function calcularFuerzaPassword(password) {
        const requisitos = validarPasswordRequisitos(password);
        const cumplidos = Object.values(requisitos).filter(Boolean).length;

        passwordStrength.className = 'password-strength';
        
        if (cumplidos <= 2) {
            passwordStrength.classList.add('strength-weak');
        } else if (cumplidos <= 4) {
            passwordStrength.classList.add('strength-medium');
        } else {
            passwordStrength.classList.add('strength-strong');
        }
    }

    function validarPassword(password) {
        if (!password) {
            return { valido: false, mensaje: 'La contraseña es obligatoria.' };
        }

        const requisitos = validarPasswordRequisitos(password);
        
        if (!requisitos.length) {
            return { valido: false, mensaje: 'La contraseña debe tener al menos 8 caracteres.' };
        }
        if (!requisitos.uppercase) {
            return { valido: false, mensaje: 'La contraseña debe contener al menos una mayúscula.' };
        }
        if (!requisitos.lowercase) {
            return { valido: false, mensaje: 'La contraseña debe contener al menos una minúscula.' };
        }
        if (!requisitos.number) {
            return { valido: false, mensaje: 'La contraseña debe contener al menos un número.' };
        }
        if (!requisitos.special) {
            return { valido: false, mensaje: 'La contraseña debe contener al menos un carácter especial.' };
        }

        return { valido: true };
    }

    function validarFormulario() {
        let valido = true;
        limpiarErrores();

        // Validar nombre
        const resultadoNombre = validarNombre(fields.nombre.el.value);
        if (!resultadoNombre.valido) {
            fields.nombre.err.textContent = resultadoNombre.mensaje;
            fields.nombre.err.style.display = 'block';
            fields.nombre.el.classList.add('error-border');
            valido = false;
        }

        // Validar apellidos
        const resultadoApellidos = validarApellidos(fields.apellidos.el.value);
        if (!resultadoApellidos.valido) {
            fields.apellidos.err.textContent = resultadoApellidos.mensaje;
            fields.apellidos.err.style.display = 'block';
            fields.apellidos.el.classList.add('error-border');
            valido = false;
        }

        // Validar email
        const resultadoEmail = validarEmail(fields.email.el.value);
        if (!resultadoEmail.valido) {
            fields.email.err.textContent = resultadoEmail.mensaje;
            fields.email.err.style.display = 'block';
            fields.email.el.classList.add('error-border');
            valido = false;
        }

        // Validar contraseña
        const resultadoPassword = validarPassword(fields.clave.el.value);
        if (!resultadoPassword.valido) {
            fields.clave.err.textContent = resultadoPassword.mensaje;
            fields.clave.err.style.display = 'block';
            fields.clave.el.classList.add('error-border');
            valido = false;
        }

        // Validar confirmación de contraseña
        const password = fields.clave.el.value;
        const passwordConfirm = fields.claveConfirmation.el.value;

        if (!passwordConfirm) {
            fields.claveConfirmation.err.textContent = 'Debe confirmar la contraseña.';
            fields.claveConfirmation.err.style.display = 'block';
            fields.claveConfirmation.el.classList.add('error-border');
            valido = false;
        } else if (password !== passwordConfirm) {
            fields.claveConfirmation.err.textContent = 'Las contraseñas no coinciden.';
            fields.claveConfirmation.err.style.display = 'block';
            fields.claveConfirmation.el.classList.add('error-border');
            valido = false;
        }

        // Validar perfil
        if (!fields.perfil.el.value) {
            fields.perfil.err.textContent = 'Debe seleccionar un perfil.';
            fields.perfil.err.style.display = 'block';
            fields.perfil.el.classList.add('error-border');
            valido = false;
        }

        return valido;
    }

    // Validación en tiempo real para contraseña
    fields.clave.el.addEventListener('input', function() {
        calcularFuerzaPassword(this.value);
    });

    // Validación al salir de cada campo
    fields.nombre.el.addEventListener('blur', function() {
        const resultado = validarNombre(this.value);
        if (!resultado.valido) {
            fields.nombre.err.textContent = resultado.mensaje;
            fields.nombre.err.style.display = 'block';
            this.classList.add('error-border');
        } else {
            fields.nombre.err.style.display = 'none';
            this.classList.remove('error-border');
        }
    });

    fields.apellidos.el.addEventListener('blur', function() {
        const resultado = validarApellidos(this.value);
        if (!resultado.valido) {
            fields.apellidos.err.textContent = resultado.mensaje;
            fields.apellidos.err.style.display = 'block';
            this.classList.add('error-border');
        } else {
            fields.apellidos.err.style.display = 'none';
            this.classList.remove('error-border');
        }
    });

    fields.email.el.addEventListener('blur', function() {
        const resultado = validarEmail(this.value);
        if (!resultado.valido) {
            fields.email.err.textContent = resultado.mensaje;
            fields.email.err.style.display = 'block';
            this.classList.add('error-border');
        } else {
            fields.email.err.style.display = 'none';
            this.classList.remove('error-border');
        }
    });

    fields.claveConfirmation.el.addEventListener('blur', function() {
        const password = fields.clave.el.value;
        const passwordConfirm = this.value;

        if (passwordConfirm && password !== passwordConfirm) {
            fields.claveConfirmation.err.textContent = 'Las contraseñas no coinciden.';
            fields.claveConfirmation.err.style.display = 'block';
            this.classList.add('error-border');
        } else {
            fields.claveConfirmation.err.style.display = 'none';
            this.classList.remove('error-border');
        }
    });

    // Envío del formulario
    form.addEventListener('submit', function(e) {
        if (!validarFormulario()) {
            e.preventDefault();
            console.log('Formulario no válido');
        }
    });
});

// Función para mostrar/ocultar contraseña
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = '👁️‍🗨️';
    } else {
        input.type = 'password';
        icon.textContent = '👁️';
    }
}
</script>
@endsection