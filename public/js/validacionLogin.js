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

    function validarCampos() {
        let valido = true;
        limpiarErrores();

        const email = fields.email.el.value.trim();
        const password = fields.password.el.value;

        // Validar email
        if (!email) {
            fields.email.err.textContent = 'El correo es obligatorio.';
            fields.email.err.style.display = 'block';
            valido = false;
        } else {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                fields.email.err.textContent = 'Correo inválido.';
                fields.email.err.style.display = 'block';
                valido = false;
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

    // Validación en tiempo real (opcional pero recomendado)
    fields.email.el.addEventListener('blur', function() {
        const email = this.value.trim();
        fields.email.err.style.display = 'none';
        
        if (email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                fields.email.err.textContent = 'Correo inválido.';
                fields.email.err.style.display = 'block';
            }
        }
    });

    fields.password.el.addEventListener('blur', function() {
        const password = this.value;
        fields.password.err.style.display = 'none';
        
        if (password && password.length < 6) {
            fields.password.err.textContent = 'La contraseña debe tener al menos 6 caracteres.';
            fields.password.err.style.display = 'block';
        }
    });

    // Validación al enviar el formulario
    form.addEventListener('submit', function(e) {
        if (!validarCampos()) {
            e.preventDefault();
            console.log('Formulario no válido');
        }
    });
});