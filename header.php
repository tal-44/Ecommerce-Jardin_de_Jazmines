<?php
/**
 * =================================================================
 * ARCHIVO: includes/header.php - VERSIÓN FINAL CORREGIDA
 * =================================================================
 * 
 * CAMBIOS PRINCIPALES:
 * 1. Logo SOLO con círculo P (sin texto adicional)
 * 2. Botón de Dyslexia (accesibilidad) - NUEVO
 * 3. Navegación con clases .nav-button correctas
 * 4. Mantiene estructura del amigo
 * 5. Barra promocional animada
 * 
 * =================================================================
 */

$titulo_pagina = isset($titulo_pagina) ? $titulo_pagina : "El Rincón Verde";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?></title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="stylesheet" href="css/producto.css">
</head>
<body>

<!-- =================================================================
     HEADER CONTAINER STICKY
     ================================================================= -->
<div class="header-container">
    
    <!-- BARRA PROMOCIONAL -->
    <div class="promo-bar">
        <div class="promo-text">
            🌿 ¡Envío gratis en compras superiores a 50€! 
            🌿 Descubre nuestras plantas de temporada 
            🌿 ¡Envío gratis en compras superiores a 50€! 
            🌿 Descubre nuestras plantas de temporada
        </div>
    </div>

    <!-- HEADER PRINCIPAL -->
    <header class="main-header">
        
        <!-- SECCIÓN IZQUIERDA: Logo -->
        <div class="header-left">
            <a href="index.php" class="logo">
                <div class="logo-icon">
                    <!-- Nuevo logotipo como imagen. La clase logo-icon garantiza que
                         la imagen sea circular y ajuste su contenido. -->
                    <!-- Actualizado: referencia al nuevo logotipo generado (logo_updated.png).  
                         Mantenemos la clase logo-icon para que se muestre en forma de
                         círculo y mantenga su proporción independientemente del tamaño. -->
                    <img src="img/logo_updated.png" alt="Logotipo El Rincón Verde" style="width:100%; height:100%; object-fit: cover;">
                </div>
            </a>
        </div>

        <!-- SECCIÓN CENTRO: Navegación -->
        <nav class="header-center">
            <a href="index.php" class="nav-button">Inicio</a>
            <a href="catalogo.php" class="nav-button">Plantas</a>
            <a href="herramientas.php" class="nav-button">Herramientas</a>
            <a href="ramos.php" class="nav-button">Ramos</a>
        </nav>

        <!-- SECCIÓN DERECHA: Iconos y botones -->
        <div class="header-right">
            
            <!-- BOTÓN: Dyslexia (fuentes para dislexia) - ACCESIBILIDAD -->
            <button 
                id="dyslexiaBtn" 
                class="icon-button dyslexia-btn" 
                title="Cambiar a fuente sin serifa (para dislexia)"
                onclick="toggleDyslexiaFont()"
            >
                Aa
            </button>

            <!-- ICONO: Carrito de compras -->
            <a href="carrito.php" class="icon-button" title="Carrito de compras">
                🛒
            </a>

            <!-- ICONO: Usuario -->
            <div class="user-menu">
                <button class="icon-button" id="userMenuBtn" title="Menú de usuario">
                    👤
                </button>
                <div class="user-dropdown" id="userDropdown">
                    <a href="#" class="dropdown-item">Mi cuenta</a>
                    <a href="#" class="dropdown-item">Mis pedidos</a>
                    <hr>
                    <a href="#" class="dropdown-item">Cerrar sesión</a>
                </div>
            </div>

        </div>

    </header>

</div>

<!-- =================================================================
     SCRIPTS DEL HEADER
     ================================================================= -->
<script>
// Menú usuario
const userMenuBtn = document.getElementById('userMenuBtn');
const userDropdown = document.getElementById('userDropdown');

userMenuBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    userDropdown.classList.toggle('show');
});

document.addEventListener('click', function(e) {
    if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
        userDropdown.classList.remove('show');
    }
});

// Dyslexia Font Toggle
function toggleDyslexiaFont() {
    const body = document.body;
    const btn = document.getElementById('dyslexiaBtn');
    
    // Alternar clase dyslexia-mode
    body.classList.toggle('dyslexia-mode');
    btn.classList.toggle('active');
    
    // Guardar preferencia en localStorage
    if (body.classList.contains('dyslexia-mode')) {
        localStorage.setItem('dyslexia-mode', 'true');
        btn.textContent = 'Aa✓';
    } else {
        localStorage.setItem('dyslexia-mode', 'false');
        btn.textContent = 'Aa';
    }
}

// Cargar preferencia de dyslexia al iniciar
window.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('dyslexia-mode') === 'true') {
        document.body.classList.add('dyslexia-mode');
        document.getElementById('dyslexiaBtn').classList.add('active');
        document.getElementById('dyslexiaBtn').textContent = 'Aa✓';
    }
});
</script>
