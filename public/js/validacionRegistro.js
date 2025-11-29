(function(){
    const form = document.getElementById('registroForm');

    const fields = {
      nombre: { el: document.getElementById('nombre'), err: document.getElementById('errorNombre') },
      apellidos: { el: document.getElementById('apellidos'), err: document.getElementById('errorApellidos') },
      email: { el: document.getElementById('email'), err: document.getElementById('errorEmail') },
      password: { el: document.getElementById('password'), err: document.getElementById('errorPassword') },
      password_confirmation: { el: document.getElementById('password_confirmation'), err: document.getElementById('errorConfirmacion') }
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

      const nombre = fields.nombre.el.value.trim();
      const apellidos = fields.apellidos.el.value.trim();
      const email = fields.email.el.value.trim();
      const password = fields.password.el.value;
      const confirmar = fields.password_confirmation.el.value;

      // NOMBRE
      if (!nombre) {
        fields.nombre.err.textContent = 'El nombre es obligatorio.';
        fields.nombre.err.style.display = "block";
        valido = false;
      }

      // APELLIDOS
      if (!apellidos) {
        fields.apellidos.err.textContent = 'Los apellidos son obligatorios.';
        fields.apellidos.err.style.display = "block";
        valido = false;
      }

      // EMAIL
      const emailRegex = /^[A-Za-z0-9._%+-]+@(gmail|hotmail)\.com$/;

      if (!email) {
        fields.email.err.textContent = 'El correo es obligatorio.';
        fields.email.err.style.display = "block";
        valido = false;
      } else if (!emailRegex.test(email)) {
        fields.email.err.textContent = 'Solo se permiten correos @gmail.com o @hotmail.com.';
        fields.email.err.style.display = "block";
        valido = false;
      }

      // CONTRASEÑA
      const passRegexMayus = /[A-Z]/;
      const passRegexMinus = /[a-z]/;
      const passRegexNum = /[0-9]/;

      if (!password) {
        fields.password.err.textContent = 'La contraseña es obligatoria.';
        fields.password.err.style.display = "block";
        valido = false;
      } else if (password.length < 8) {
        fields.password.err.textContent = 'La contraseña debe tener mínimo 8 caracteres.';
        fields.password.err.style.display = "block";
        valido = false;
      } else if (!passRegexMayus.test(password) ||
                 !passRegexMinus.test(password) ||
                 !passRegexNum.test(password)) {
        fields.password.err.textContent = 'La contraseña debe incluir mayúscula, minúscula y número.';
        fields.password.err.style.display = "block";
        valido = false;
      }

      // CONFIRMACION
      if (!confirmar) {
        fields.password_confirmation.err.textContent = 'Confirma la contraseña.';
        fields.password_confirmation.err.style.display = "block";
        valido = false;
      } else if (confirmar !== password) {
        fields.password_confirmation.err.textContent = 'Las contraseñas no coinciden.';
        fields.password_confirmation.err.style.display = "block";
        valido = false;
      }

      return valido;
    }

    form.addEventListener('submit', function(e){
      if (!validarCampos()) {
        e.preventDefault();
      }
    });

})();
