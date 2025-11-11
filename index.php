<?php
// ============================================================
// SISTEMA DE FALLBACK A HTML
// ============================================================
// Si PHP no puede ejecutarse correctamente, redirigir a index.html
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (error_reporting() & $errno) {
        if (!headers_sent()) {
            header("Location: /index.html");
            exit;
        } else {
            echo '<script>window.location.href="/index.html";</script>';
            exit;
        }
    }
    return false;
});

try {
    // ============================================================
    // 1. INCLUIR CONEXIÓN A BD
    // ============================================================
    if (!file_exists('config/conexion.php')) {
        throw new Exception("Archivo de conexión no encontrado");
    }

    require_once 'config/conexion.php';

    // Verificar que la conexión se estableció
    if (!isset($conn) || $conn->connect_error) {
        throw new Exception("Error de conexión a base de datos");
    }

    // ============================================================
    // 2. VARIABLES PARA HEADER
    // ============================================================
    $titulo_pagina = "Inicio - Tienda de Plantas";
    $css_adicional = '<link rel="stylesheet" href="/css/index.css">';
    $js_adicional = '<script src="/js/index.js"></script>';

    // ============================================================
    // 3. INCLUIR HEADER
    // ============================================================
    if (!file_exists('includes/header.php')) {
        throw new Exception("Header no encontrado");
    }

    include 'includes/header.php';
} catch (Exception $e) {
    // Si hay cualquier error, redirigir a la versión HTML
    if (!headers_sent()) {
        header("Location: /index.html");
        exit;
    } else {
        echo '<script>window.location.href="/index.html";</script>';
        exit;
    }
}
?>

<!-- ============================================================
     4. CONTENIDO DE LA PÁGINA
     ============================================================ -->

<!-- TU SECCIÓN DE BUSCADOR ACTUAL (mantén tu HTML) -->
<section class="seccion-buscador">
    <div class="buscador-contenido">
        <form action="buscar.php" method="GET" class="formulario-busqueda">
            <div class="search-wrapper">
                <input type="text" name="q" placeholder="Busca tu planta ideal..." required>
                <button type="submit" class="search-btn" aria-label="Buscar">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- ============================================================
     5. NUEVA SECCIÓN: TARJETAS DE TEMPORADAS
     ============================================================ -->
<section class="seccion-temporadas">
    <div class="container-temporadas">
        <h2 class="titulo-temporadas">Buscar por Temporada</h2>
        <div class="grid-temporadas">

            <!-- Tarjeta PRIMAVERA -->
            <a href="/catalogo.php?temporada=primavera" class="tarjeta-temporada">
                <img src="/img/temporadas/primavera.png" alt="Primavera">
                <div class="overlay-temporada">
                    <h3>Primavera</h3>
                    <p>Nuevos brotes y flores</p>
                </div>
            </a>

            <!-- Tarjeta VERANO -->
            <a href="/catalogo.php?temporada=verano" class="tarjeta-temporada">
                <img src="/img/temporadas/verano.png" alt="Verano">
                <div class="overlay-temporada">
                    <h3>Verano</h3>
                    <p>Plantas resistentes al calor</p>
                </div>
            </a>

            <!-- Tarjeta OTOÑO -->
            <a href="/catalogo.php?temporada=otoño" class="tarjeta-temporada">
                <img src="/img/temporadas/otono.png" alt="Otoño">
                <div class="overlay-temporada">
                    <h3>Otoño</h3>
                    <p>Tonos cálidos y acogedores</p>
                </div>
            </a>

            <!-- Tarjeta INVIERNO -->
            <a href="/catalogo.php?temporada=invierno" class="tarjeta-temporada">
                <img src="/img/temporadas/invierno.png" alt="Invierno">
                <div class="overlay-temporada">
                    <h3>Invierno</h3>
                    <p>Plantas de interior resistentes</p>
                </div>
            </a>

        </div>
    </div>
</section>

<!-- TU SECCIÓN PERSONALIZADA ACTUAL (mantén tu HTML) -->
<section class="seccion-personalizada">
    <div class="contenedor">
        <div class="barra-verde"></div>
        <div class="contenido">
            <h1>DESCUBRE TU PLANTA IDEAL</h1>
            <p>Realiza un test breve y descubre con qué planta compartes tu personalidad.</p>
            <button class="boton-test">Realizar Test</button>
        </div>
    </div>
</section>

<section class="seccion-equipo" id="conocenos">
    <div class="equipo-container">
        <h2 class="equipo-titulo">¡Conoce a nuestro equipo!</h2>
        <p class="equipo-subtitulo">Somos una tienda de jardinería apasionada por las plantas y la vida vegetal. Nos encanta contribuir a nuestra comunidad y marcar la diferencia.</p>

        <div class="equipo-grid">
            <article class="miembro">
                <img src="/img/plantas/default.jpg" alt="Foto de Daniel Cebriano Buján" class="miembro-foto">
                <!-- no se para que era la imagen de default, pero asi por lo emnos se ve algo -->
                <h3 class="miembro-nombre">Daniel Cebriano Buján</h3>
                <p class="miembro-descripcion">Hola! Soy Daniel y me apasionan los musgos. Únete a mí para descubrir nuevas variedades.</p>
                <a class="btn-rrss" href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer" aria-label="Abrir redes sociales de Daniel">RRSS</a>
            </article>

            <article class="miembro">
                <img src="/img/plantas/default.jpg" alt="Foto de Pau Gazapo Solís" class="miembro-foto">
                <h3 class="miembro-nombre">Pau Gazapo Solís</h3>
                <p class="miembro-descripcion">Especialista en plantas de interior y diseño verde.</p>
                <a class="btn-rrss" href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer" aria-label="Abrir redes sociales de Pau">RRSS</a>
            </article>

            <article class="miembro">
                <img src="/img/plantas/default.jpg" alt="Foto de Marcos Narváez Suárez" class="miembro-foto">
                <h3 class="miembro-nombre">Marcos Narváez Suárez</h3>
                <p class="miembro-descripcion">Amante de los cactus y variedades pinchudas.</p>
                <a class="btn-rrss" href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer" aria-label="Abrir redes sociales de Marcos">RRSS</a>
            </article>
        </div>

        <div class="equipo-contacto">
            <a class="btn-contacto" href="mailto:contacto@jardindejazmines.com?subject=Consulta%20desde%20la%20web">Escríbenos</a>
        </div>
    </div>
</section>

<?php
try {
    // ============================================================
    // 6. INCLUIR FOOTER
    // ============================================================
    if (!file_exists('includes/footer.php')) {
        throw new Exception("Footer no encontrado");
    }

    include 'includes/footer.php';
} catch (Exception $e) {
    // Si falla el footer, redirigir a HTML
    if (!headers_sent()) {
        header("Location: /index.html");
        exit;
    } else {
        echo '<script>window.location.href="/index.html";</script>';
        exit;
    }
}

// Restaurar error handler original
restore_error_handler();
?>