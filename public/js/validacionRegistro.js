(function(){
    const form = document.getElementById('registroForm');
    const fields = {
      nombre: { el: document.getElementById('nombre'), err: document.getElementById('errorNombre') },
      apellidos: { el: document.getElementById('apellidos'), err: document.getElementById('errorApellidos') },
      email: { el: document.getElementById('email'), err: document.getElementById('errorEmail') },
      password: { el: document.getElementById('password'), err: document.getElementById('errorPassword') },
      password_confirmation: { el: document.getElementById('password_confirmation'), err: document.getElementById('errorConfirmacion') }
    };

    // ============================================
    // VALIDACIONES EN TIEMPO REAL
    // ============================================
    
    // NOMBRE: No permite números, puntos, guiones bajos ni caracteres especiales
    // Permite UN solo espacio entre palabras
    fields.nombre.el.addEventListener('input', function() {
        let valor = this.value;
        
        // Eliminar números y caracteres especiales (excepto espacios temporalmente)
        valor = valor.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
        
        // Eliminar espacios al inicio
        valor = valor.replace(/^\s+/, '');
        
        // Reemplazar múltiples espacios consecutivos por uno solo
        valor = valor.replace(/\s{2,}/g, ' ');
        
        this.value = valor;
    });
    
    // APELLIDOS: No permite números
    // Permite UN solo espacio entre palabras
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

    // EMAIL: No permite espacios
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
      } else if (/[0-9]/.test(nombre)) {
        fields.nombre.err.textContent = 'El nombre no puede contener números.';
        fields.nombre.err.style.display = "block";
        valido = false;
      } else if (/[._\-]/.test(nombre)) {
        fields.nombre.err.textContent = 'El nombre no puede contener puntos, guiones ni guiones bajos.';
        fields.nombre.err.style.display = "block";
        valido = false;
      } else if (/\s{2,}/.test(nombre)) {
        fields.nombre.err.textContent = 'El nombre no puede tener espacios consecutivos.';
        fields.nombre.err.style.display = "block";
        valido = false;
      } else if (nombre.endsWith(' ')) {
        fields.nombre.err.textContent = 'El nombre no puede terminar con espacio.';
        fields.nombre.err.style.display = "block";
        valido = false;
      } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+(\s[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+)*$/.test(nombre)) {
        fields.nombre.err.textContent = 'El nombre solo puede contener letras y espacios simples.';
        fields.nombre.err.style.display = "block";
        valido = false;
      } else if (nombre.length < 2) {
        fields.nombre.err.textContent = 'El nombre debe tener al menos 2 caracteres.';
        fields.nombre.err.style.display = "block";
        valido = false;
      }

      // APELLIDOS
      if (!apellidos) {
        fields.apellidos.err.textContent = 'Los apellidos son obligatorios.';
        fields.apellidos.err.style.display = "block";
        valido = false;
      } else if (/[0-9]/.test(apellidos)) {
        fields.apellidos.err.textContent = 'Los apellidos no pueden contener números.';
        fields.apellidos.err.style.display = "block";
        valido = false;
      } else if (/\s{2,}/.test(apellidos)) {
        fields.apellidos.err.textContent = 'Los apellidos no pueden tener espacios consecutivos.';
        fields.apellidos.err.style.display = "block";
        valido = false;
      } else if (apellidos.endsWith(' ')) {
        fields.apellidos.err.textContent = 'Los apellidos no pueden terminar con espacio.';
        fields.apellidos.err.style.display = "block";
        valido = false;
      } else if (apellidos.length < 2) {
        fields.apellidos.err.textContent = 'Los apellidos deben tener al menos 2 caracteres.';
        fields.apellidos.err.style.display = "block";
        valido = false;
      }

      // EMAIL
      if (!email) {
        fields.email.err.textContent = 'El correo es obligatorio.';
        fields.email.err.style.display = "block";
        valido = false;
      } else if (/\s/.test(email)) {
        fields.email.err.textContent = 'El correo no puede contener espacios.';
        fields.email.err.style.display = "block";
        valido = false;
      } else if (!email.endsWith('.com')) {
        fields.email.err.textContent = 'El correo debe terminar en .com';
        fields.email.err.style.display = "block";
        valido = false;
      } else {
        // Validar que termine EXACTAMENTE en .com (sin caracteres adicionales)
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/;
        if (!emailRegex.test(email)) {
          fields.email.err.textContent = 'El correo solo puede terminar en .com (sin caracteres adicionales).';
          fields.email.err.style.display = "block";
          valido = false;
        }
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
      e.preventDefault();
      if (!validarCampos()) {
        return;
      }

      // Mostrar alerta de "Procesando..."
      Swal.fire({
        title: 'Procesando...',
        text: 'Registrando su información',
        icon: 'info',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      // Preparar datos del formulario
      const formData = new FormData(form);
      console.log('Enviando petición a:', form.action);

      // Enviar formulario con AJAX
      fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        }
      })
      .then(async response => {
        console.log('Status:', response.status);
        console.log('Content-Type:', response.headers.get('content-type'));
        
        const text = await response.text();
        console.log('Respuesta recibida:', text);
        
        try {
          const data = JSON.parse(text);
          
          if (data.success) {
            // Éxito
            Swal.fire({
              icon: 'success',
              title: '¡Registro exitoso!',
              text: 'Su cuenta ha sido creada correctamente',
              confirmButtonText: 'Iniciar sesión',
              confirmButtonColor: '#28a745',
              allowOutsideClick: false
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = data.redirect;
              }
            });
          } else if (data.errors) {
            // Errores de validación
            let errorMessages = '';
            Object.values(data.errors).forEach(msgs => {
              msgs.forEach(msg => {
                errorMessages += msg + '<br>';
              });
            });
            Swal.fire({
              icon: 'error',
              title: 'Error de validación',
              html: errorMessages,
              confirmButtonText: 'Corregir',
              confirmButtonColor: '#dc3545'
            });
          } else {
            throw new Error(data.message || 'Error desconocido');
          }
        } catch (parseError) {
          console.error('Error al parsear JSON:', parseError);
          console.error('Texto recibido:', text);
          throw new Error('La respuesta del servidor no es JSON válido');
        }
      })
      .catch(error => {
        console.error('Error completo:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Ocurrió un error al procesar el registro. Revise la consola para más detalles.',
          confirmButtonText: 'Intentar de nuevo',
          confirmButtonColor: '#dc3545'
        });
      });
    });
})();