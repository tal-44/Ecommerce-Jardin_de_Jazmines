document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================================
    // 1. SELECTOR DE CANTIDAD (+/-)
    // ============================================================
    const btnMenos = document.getElementById('btnMenos');
    const btnMas = document.getElementById('btnMas');
    const inputCantidad = document.getElementById('inputCantidad');
    
    if (btnMenos && btnMas && inputCantidad) {
        btnMenos.addEventListener('click', function() {
            let cantidad = parseInt(inputCantidad.value);
            if (cantidad > 1) {
                inputCantidad.value = cantidad - 1;
            }
        });
        
        btnMas.addEventListener('click', function() {
            let cantidad = parseInt(inputCantidad.value);
            let max = parseInt(inputCantidad.getAttribute('max'));
            if (cantidad < max) {
                inputCantidad.value = cantidad + 1;
            }
        });
    }
    
    // ============================================================
    // 2. FORMULARIO AGREGAR AL CARRITO
    // ============================================================
    const formCarrito = document.getElementById('formAgregarCarrito');
    
    if (formCarrito) {
        formCarrito.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(formCarrito);
            const mensajeExito = document.getElementById('mensaje-exito');
            
            // Simular agregado al carrito (por ahora sin AJAX)
            // Cuando implementes agregar_al_carrito.php, descomenta el código AJAX
            
            /* OPCIÓN 1: Sin AJAX (mostrar mensaje) */
            if(mensajeExito) {
                mensajeExito.classList.remove('oculto');
                setTimeout(function() {
                    mensajeExito.classList.add('oculto');
                }, 3000);
            }
            
            console.log('Producto agregado:', {
                producto_id: formData.get('producto_id'),
                cantidad: formData.get('cantidad')
            });
            
            /* OPCIÓN 2: Con AJAX (cuando crees agregar_al_carrito.php)
            fetch('agregar_al_carrito.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar mensaje de éxito
                    if(mensajeExito) {
                        mensajeExito.classList.remove('oculto');
                        setTimeout(function() {
                            mensajeExito.classList.add('oculto');
                        }, 3000);
                    }
                    
                    // Actualizar contador del carrito en header
                    actualizarContadorCarrito(data.total_items);
                } else {
                    alert('Error: ' + data.mensaje);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al agregar el producto');
            });
            */
        });
    }
    
    // ============================================================
    // 3. ACTUALIZAR CONTADOR DEL CARRITO (para AJAX)
    // ============================================================
    function actualizarContadorCarrito(total) {
        const badge = document.querySelector('.cart-badge');
        if(badge) {
            badge.textContent = total;
        } else if(total > 0) {
            // Crear badge si no existe
            const btnCarrito = document.querySelector('[title="Carrito de compras"]');
            if(btnCarrito) {
                const nuevoBadge = document.createElement('span');
                nuevoBadge.className = 'cart-badge';
                nuevoBadge.textContent = total;
                btnCarrito.appendChild(nuevoBadge);
            }
        }
    }
    
    // ============================================================
    // 4. ANIMACIÓN SUAVE AL SCROLL (opcional)
    // ============================================================
    const productosRelacionados = document.querySelector('.productos-relacionados');
    
    if(productosRelacionados) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });
        
        productosRelacionados.style.opacity = '0';
        productosRelacionados.style.transform = 'translateY(30px)';
        productosRelacionados.style.transition = 'all 0.6s ease';
        
        observer.observe(productosRelacionados);
    }
    
    // ============================================================
    // 5. ZOOM EN IMAGEN (opcional - mejora UX)
    // ============================================================
    const imagenPrincipal = document.getElementById('imagenPrincipal');
    
    if(imagenPrincipal) {
        imagenPrincipal.addEventListener('click', function() {
            // Crear modal para zoom
            const modal = document.createElement('div');
            modal.className = 'modal-zoom';
            modal.innerHTML = `
                <div class="modal-zoom-contenido">
                    <span class="cerrar-modal">&times;</span>
                    <img src="${this.src}" alt="Zoom">
                </div>
            `;
            
            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';
            
            // Cerrar modal
            const cerrar = modal.querySelector('.cerrar-modal');
            cerrar.addEventListener('click', function() {
                modal.remove();
                document.body.style.overflow = 'auto';
            });
            
            // Cerrar al hacer clic fuera
            modal.addEventListener('click', function(e) {
                if(e.target === modal) {
                    modal.remove();
                    document.body.style.overflow = 'auto';
                }
            });
        });
        
        // Cambiar cursor para indicar que es clickeable
        imagenPrincipal.style.cursor = 'pointer';
    }
    
    console.log('✅ JavaScript de producto.php cargado correctamente');
});

// ============================================================
// ESTILOS INLINE PARA MODAL DE ZOOM (agregar a CSS si quieres)
// ============================================================
const estilosModal = document.createElement('style');
estilosModal.innerHTML = `
    .modal-zoom {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        animation: fadeIn 0.3s ease;
    }
    
    .modal-zoom-contenido {
        position: relative;
        max-width: 90%;
        max-height: 90%;
    }
    
    .modal-zoom-contenido img {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 10px;
    }
    
    .cerrar-modal {
        position: absolute;
        top: -40px;
        right: 0;
        font-size: 3rem;
        color: white;
        cursor: pointer;
        transition: color 0.3s;
    }
    
    .cerrar-modal:hover {
        color: #ccc;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
`;

document.head.appendChild(estilosModal);
