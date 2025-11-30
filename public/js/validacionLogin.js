(function () {
    const form = document.getElementById('loginForm');

    const fields = {
        email: { el: document.getElementById('email'), err: document.getElementById('errorEmail') },
        password: { el: document.getElementById('password'), err: document.getElementById('errorPassword') }
    };

    function limpiarErrores() {
        Object.values(fields).forEach(f => {
            f.err.textContent = '';
            f.err.style.display = "none";
            f.err.style.color = "red";
            f.err.style.fontSize = "14px";
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
        }

        return valido;
    }

    form.addEventListener('submit', function (e) {
        if (!validarCampos()) {
            e.preventDefault();
        }
    });

})();
