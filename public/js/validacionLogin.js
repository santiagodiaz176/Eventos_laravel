document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');

    // Verificar que el formulario existe
    if (!form) {
        console.error('Formulario no encontrado');
        return;
    }

    const fields = {
        email: { 
            el: document.getElementById('email'), 
            err: document.getElementById('errorEmail') 
        },
        password: { 
            el: document.getElementById('password'), 
            err: document.getElementById('errorPassword') 
        }
    };

    // Verificar que todos los elementos existen
    if (!fields.email.el || !fields.email.err || !fields.password.el || !fields.password.err) {
        console.error('No se encontraron todos los elementos del formulario');
        return;
    }

    function limpiarErrores() {
        Object.values(fields).forEach(f => {
            f.err.textContent = '';
            f.err.style.display = "none";
            f.err.style.color = "red";
            f.err.style.fontSize = "14px";
            f.err.style.marginTop = "5px";
        });
    }

    // Función para validar que el correo termine en .com sin caracteres adicionales
    function validarCorreoCom(email) {
        // Eliminar espacios
        email = email.replace(/\s+/g, '');
        
        // Validar que termine exactamente en .com
        if (!email.endsWith('.com')) {
            return {
                valido: false,
                mensaje: 'El correo debe terminar en .com'
            };
        }
        
        // Validar que no haya nada después de .com usando regex
        const regexComExacto = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.com$/;
        if (!regexComExacto.test(email)) {
            return {
                valido: false,
                mensaje: 'El correo solo puede terminar en .com (sin caracteres adicionales)'
            };
        }
        
        return { valido: true, mensaje: '' };
    }

    function validarCampos() {
        let valido = true;
        limpiarErrores();

        let email = fields.email.el.value.trim();
        const password = fields.password.el.value;

        // Eliminar espacios del email
        email = email.replace(/\s+/g, '');
        fields.email.el.value = email;

        // Validar email
        if (!email) {
            fields.email.err.textContent = 'El correo es obligatorio.';
            fields.email.err.style.display = 'block';
            valido = false;
        } else {
            // Validar formato básico
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                fields.email.err.textContent = 'Correo inválido.';
                fields.email.err.style.display = 'block';
                valido = false;
            } else {
                // Validar que termine en .com
                const resultadoValidacion = validarCorreoCom(email);
                if (!resultadoValidacion.valido) {
                    fields.email.err.textContent = resultadoValidacion.mensaje;
                    fields.email.err.style.display = 'block';
                    valido = false;
                }
            }
        }

        // Validar password
        if (!password) {
            fields.password.err.textContent = 'La contraseña es obligatoria.';
            fields.password.err.style.display = 'block';
            valido = false;
        } else if (password.length < 6) {
            fields.password.err.textContent = 'La contraseña debe tener al menos 6 caracteres.';
            fields.password.err.style.display = 'block';
            valido = false;
        }

        return valido;
    }

    // Eliminar espacios en tiempo real del email
    fields.email.el.addEventListener('input', function() {
        this.value = this.value.replace(/\s+/g, '');
    });

    // Validación en tiempo real para email
    fields.email.el.addEventListener('blur', function() {
        let email = this.value.trim();
        email = email.replace(/\s+/g, '');
        this.value = email;
        
        fields.email.err.style.display = 'none';
        
        if (email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                fields.email.err.textContent = 'Correo inválido.';
                fields.email.err.style.display = 'block';
            } else {
                // Validar que termine en .com
                const resultadoValidacion = validarCorreoCom(email);
                if (!resultadoValidacion.valido) {
                    fields.email.err.textContent = resultadoValidacion.mensaje;
                    fields.email.err.style.display = 'block';
                }
            }
        }
    });

    // Validación en tiempo real para password
    fields.password.el.addEventListener('blur', function() {
        const password = this.value;
        fields.password.err.style.display = 'none';
        
        if (password && password.length < 6) {
            fields.password.err.textContent = 'La contraseña debe tener al menos 6 caracteres.';
            fields.password.err.style.display = 'block';
        }
    });

    // Validación al enviar el formulario con SweetAlert2
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevenir envío por defecto
        
        if (!validarCampos()) {
            // Determinar qué campo falló
            let mensajeError = '';
            let email = fields.email.el.value.trim().replace(/\s+/g, '');
            
            if (!email) {
                mensajeError = 'Por favor, ingresa tu correo electrónico.';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                mensajeError = 'El formato del correo es inválido.';
            } else {
                const resultadoValidacion = validarCorreoCom(email);
                if (!resultadoValidacion.valido) {
                    mensajeError = resultadoValidacion.mensaje;
                } else if (!fields.password.el.value) {
                    mensajeError = 'Por favor, ingresa tu contraseña.';
                } else if (fields.password.el.value.length < 6) {
                    mensajeError = 'La contraseña debe tener al menos 6 caracteres.';
                }
            }
            
            // Mostrar SweetAlert2 con el error
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                text: mensajeError,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Entendido'
            });
            
            console.log('Formulario no válido');
        } else {
            // Si todo es válido, enviar el formulario
            form.submit();
        }
    });
});