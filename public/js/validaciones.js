document.addEventListener('DOMContentLoaded', function() {
    
    // -----------------------------------------------------------
    // A. LÓGICA DE CONCATENACIÓN DE DIRECCIÓN
    // -----------------------------------------------------------

    // Intentar seleccionar el formulario de CREACIÓN, si no existe, intentar el de EDICIÓN.
    let formulario = document.getElementById('form-crear-evento'); 
    if (!formulario) {
        formulario = document.getElementById('form-editar-evento'); 
    }
    
    const lugarEventoHidden = document.getElementById('lugar_evento_hidden');

    if (formulario && lugarEventoHidden) {
        // 1. Adjuntar el listener al evento submit del formulario
        formulario.addEventListener('submit', function(e) {
            
            // 2. Obtener los valores de los 3 campos separados de dirección
            const tipoVia = document.getElementById('tipo_via').value.trim();
            const numViaPrincipal = document.getElementById('num_via_principal').value.trim();
            const placaCompleta = document.getElementById('placa_completa').value.trim();

            // 3. Construir la cadena de dirección final que el backend espera
            const direccionFinal = `${tipoVia} ${numViaPrincipal} ${placaCompleta}`;

            // 4. Asignar el valor concatenado al campo oculto 'lugar_evento'
            lugarEventoHidden.value = direccionFinal.trim();
            
            // Opcional: Validación simple en el frontend
            if (lugarEventoHidden.value.length < 5) {
                // Si el campo está marcado como 'required' en el HTML, esto es redundante,
                // pero sirve como un chequeo extra y log en consola.
                console.error('ERROR de Frontend: El campo lugar_evento está vacío.');
                // No usamos alert(), si necesitas notificar al usuario, usa un modal.
            }
        });
    }

    // -----------------------------------------------------------
    // B. VALIDACIONES ESPECÍFICAS DE ENTRADA
    // -----------------------------------------------------------

    // 1. Nombre del Evento (Solo letras/acentos, espacios y guiones/puntos. Max 30)
    const nombreEventoInput = document.querySelector('input[data-validate="nombre-evento"]');
    if (nombreEventoInput) {
        nombreEventoInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\.,]/g, '');
        });
    }

    // 2. Tipo de Evento (Solo letras y espacios. Max 50)
    const tipoEventoInput = document.querySelector('input[data-validate="tipo-evento"]');
    if (tipoEventoInput) {
        tipoEventoInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
        });
    }

    // 3. Número Vía (Dirección - solo números y letras A/B/Bis. Max 5)
    const numViaInput = document.querySelector('input[data-validate="num-via"]');
    if (numViaInput) {
        numViaInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '');
        });
    }

    // 4. Placa y Complemento (Dirección - flexible. Max 50)
    const placaCompInput = document.querySelector('input[data-validate="placa-complemento"]');
    if (placaCompInput) {
        placaCompInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^a-zA-Z0-9\s#\-,.]/g, '');
        });
    }
    
    // -----------------------------------------------------------
    // C. VALIDACIONES GENERALES
    // -----------------------------------------------------------
    
    // Validación para cantidad de personas (máximo 100,000, mínimo 1)
    const camposCantidad = document.querySelectorAll('[data-validate="cantidad-personas"]');
    camposCantidad.forEach(campo => {
        campo.addEventListener('input', function(e) {
            let val = parseInt(this.value);
            
            if (isNaN(val) || val < 1) {
                this.value = 1; 
                return;
            }

            if (val > 100000) {
                this.value = 100000;
            }
        });
    });

    // Validación para descripción (máximo 500 caracteres y contador)
    const camposDescripcion = document.querySelectorAll('[data-validate="descripcion"]');
    camposDescripcion.forEach(campo => {
        let contador = campo.nextElementSibling;
        if (!contador || !contador.classList.contains('char-counter')) {
            contador = document.createElement('div');
            contador.className = 'char-counter';
            campo.parentNode.insertBefore(contador, campo.nextSibling);
        }

        function actualizarContador() {
            const maxLength = campo.getAttribute('data-max') || 500;
            const currentLength = campo.value.length;
            
            if (currentLength > maxLength) {
                campo.value = campo.value.substring(0, maxLength);
            }
            const finalLength = campo.value.length;
            contador.textContent = `${finalLength}/${maxLength} caracteres`;
        }
        campo.addEventListener('input', actualizarContador);
        actualizarContador(); 
    });

    // Validación para fechas (no fechas pasadas)
    const camposFechaFutura = document.querySelectorAll('[data-validate="fecha-futura"]');
    camposFechaFutura.forEach(campo => {
        const hoy = new Date().toISOString().split('T')[0];
        if (!campo.getAttribute('min')) {
            campo.setAttribute('min', hoy);
        }
    });

});