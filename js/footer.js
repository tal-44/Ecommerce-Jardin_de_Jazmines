/**
 * ========================================
 * FOOTER.JS - FUNCIONALIDAD SUBSCRIPCIÓN
 * ========================================
 * Archivo: js/footer.js
 * Asegúrate que en footer.php tengas:
 * <script src="js/footer.js"></script>
 * ANTES DEL CIERRE DE </body>
 */

// ESPERAR A QUE EL DOM ESTÉ CARGADO COMPLETAMENTE
document.addEventListener('DOMContentLoaded', function() {
  console.log('✅ Footer.js cargado correctamente');
  
  // BUSCAR EL BOTÓN CON LA CLASE .register-btn
  const registerBtn = document.querySelector('.register-btn');
  console.log('🔍 Botón encontrado:', registerBtn);
  
  if (registerBtn) {
    console.log('✅ Event listener añadido al botón');
    registerBtn.addEventListener('click', function(e) {
      e.preventDefault();
      console.log('🎯 Click en botón detectado');
      abrirModalSuscripcion();
    });
  } else {
    console.warn('⚠️ Botón .register-btn NO encontrado en el HTML');
  }
});

/**
 * Función principal para abrir el modal
 */
function abrirModalSuscripcion() {
  console.log('📦 Abriendo modal...');
  
  // CREAR OVERLAY (fondo oscuro)
  const overlay = document.createElement('div');
  overlay.id = 'modal-overlay-suscripcion';
  overlay.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
    animation: fadeIn 0.3s ease;
  `;

  // CREAR MODAL
  const modal = document.createElement('div');
  modal.id = 'modal-suscripcion-contenido';
  modal.style.cssText = `
    background: white;
    border-radius: 12px;
    padding: 2rem;
    max-width: 400px;
    width: 90%;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    animation: slideIn 0.3s ease;
    font-family: 'Poppins', sans-serif;
  `;

  // CONTENIDO INICIAL DEL MODAL
  modal.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h2 style="margin: 0; color: #1f2d27; font-size: 1.5rem; font-family: 'Poppins', sans-serif;">Suscribirse</h2>
      <button id="btn-cerrar-modal" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #999;">✕</button>
    </div>

    <form id="form-suscripcion" style="display: flex; flex-direction: column; gap: 1rem;">
      <div>
        <label for="nombre-suscripcion" style="display: block; margin-bottom: 0.5rem; color: #1f2d27; font-weight: 500; font-family: 'Poppins', sans-serif;">Nombre *</label>
        <input 
          type="text" 
          id="nombre-suscripcion" 
          name="nombre"
          placeholder="Tu nombre"
          required
          style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-family: 'Poppins', sans-serif; box-sizing: border-box; font-size: 14px;"
        >
      </div>

      <div>
        <label for="email-suscripcion" style="display: block; margin-bottom: 0.5rem; color: #1f2d27; font-weight: 500; font-family: 'Poppins', sans-serif;">Email *</label>
        <input 
          type="email" 
          id="email-suscripcion" 
          name="email"
          placeholder="tu@email.com"
          required
          style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-family: 'Poppins', sans-serif; box-sizing: border-box; font-size: 14px;"
        >
      </div>

      <div>
        <label for="telefono-suscripcion" style="display: block; margin-bottom: 0.5rem; color: #1f2d27; font-weight: 500; font-family: 'Poppins', sans-serif;">Teléfono</label>
        <input 
          type="tel" 
          id="telefono-suscripcion" 
          name="telefono"
          placeholder="+34 612 345 678"
          style="width: 100%; padding: 0.75rem; border: 2px solid #e0e0e0; border-radius: 8px; font-family: 'Poppins', sans-serif; box-sizing: border-box; font-size: 14px;"
        >
      </div>

      <button 
        type="submit"
        style="background: #4a7c59; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; cursor: pointer; font-family: 'Poppins', sans-serif; font-size: 14px; transition: background 0.3s ease;"
      >
        Enviar Suscripción
      </button>
    </form>
  `;

  overlay.appendChild(modal);
  document.body.appendChild(overlay);

  // AGREGAR ESTILOS DE ANIMACIÓN
  const style = document.createElement('style');
  style.textContent = `
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideIn {
      from {
        transform: translateY(-50px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    #modal-suscripcion-contenido input:focus {
      border-color: #4a7c59 !important;
      outline: none;
      box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.1);
    }
  `;
  document.head.appendChild(style);

  console.log('✅ Modal creado');

  // CERRAR AL HACER CLICK EN LA X
  document.getElementById('btn-cerrar-modal').addEventListener('click', function() {
    console.log('🔴 Cerrando modal (botón X)');
    overlay.remove();
    style.remove();
  });

  // CERRAR AL HACER CLICK FUERA DEL MODAL
  overlay.addEventListener('click', function(e) {
    if (e.target === overlay) {
      console.log('🔴 Cerrando modal (click fuera)');
      overlay.remove();
      style.remove();
    }
  });

  // MANEJAR ENVÍO DEL FORMULARIO
  const form = document.getElementById('form-suscripcion');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('📤 Formulario enviado');

    const nombre = document.getElementById('nombre-suscripcion').value;
    const email = document.getElementById('email-suscripcion').value;
    const telefono = document.getElementById('telefono-suscripcion').value;

    // VALIDAR EMAIL
    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    if (!emailValido) {
      alert('❌ Por favor ingresa un email válido');
      console.warn('⚠️ Email inválido:', email);
      return;
    }

    console.log('✅ Datos válidos:', { nombre, email, telefono });

    // MOSTRAR MENSAJE DE ÉXITO
    const modalContent = document.getElementById('modal-suscripcion-contenido');
    modalContent.innerHTML = `
      <div style="text-align: center; padding: 2rem 0;">
        <div style="font-size: 4rem; margin-bottom: 1rem; animation: bounce 0.5s ease;">🎉</div>
        <h3 style="color: #1f2d27; margin-bottom: 1rem; font-size: 1.3rem; font-family: 'Poppins', sans-serif;">¡Te llegará una sorpresa al correo!</h3>
        <p style="color: #5c6b64; margin-bottom: 2rem; font-family: 'Poppins', sans-serif;">
          Hola <strong>${nombre}</strong>, hemos recibido tu suscripción
        </p>
        <p style="color: #4a7c59; font-size: 0.95rem; line-height: 1.6; font-family: 'Poppins', sans-serif;">
          Pronto recibirás ofertas exclusivas y sorpresas especiales 🌿
        </p>
        <button 
          onclick="document.getElementById('modal-overlay-suscripcion').remove()" 
          style="background: #4a7c59; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; cursor: pointer; font-family: 'Poppins', sans-serif; margin-top: 2rem; font-size: 14px; transition: background 0.3s ease;" 
          onmouseover="this.style.background='#3d6649'" 
          onmouseout="this.style.background='#4a7c59'"
        >
          Cerrar
        </button>
      </div>
    `;

    // ANIMACIÓN DE REBOTE
    const bounceStyle = document.createElement('style');
    bounceStyle.textContent = `
      @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
      }
    `;
    document.head.appendChild(bounceStyle);

    console.log('✅ Mensaje de éxito mostrado');
  });
}