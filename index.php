<?php
// ============================================================
// 1. INCLUIR CONEXIÓN A BD
// ============================================================
require_once 'config/conexion.php';

// ============================================================
// 2. VARIABLES PARA HEADER
// ============================================================
$titulo_pagina = "Inicio - Tienda de Plantas";
$css_adicional = '<link rel="stylesheet" href="css/index.css">';
$js_adicional = '<script src="js/index.js"></script>';

// ============================================================
// 3. INCLUIR HEADER
// ============================================================
include 'includes/header.php';
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
                <button type="submit" class="search-btn">
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
            <a href="catalogo.php?temporada=primavera" class="tarjeta-temporada">
                <img src="img/temporadas/primavera.png" alt="Primavera">
                <div class="overlay-temporada">
                    <h3>Primavera</h3>
                    <p>Nuevos brotes y flores</p>
                </div>
            </a>

            <!-- Tarjeta VERANO -->
            <a href="catalogo.php?temporada=verano" class="tarjeta-temporada">
                <img src="img/temporadas/verano.png" alt="Verano">
                <div class="overlay-temporada">
                    <h3>Verano</h3>
                    <p>Plantas resistentes al calor</p>
                </div>
            </a>

            <!-- Tarjeta OTOÑO -->
            <a href="catalogo.php?temporada=otoño" class="tarjeta-temporada">
                <img src="img/temporadas/otono.png" alt="Otoño">
                <div class="overlay-temporada">
                    <h3>Otoño</h3>
                    <p>Tonos cálidos y acogedores</p>
                </div>
            </a>

            <!-- Tarjeta INVIERNO -->
            <a href="catalogo.php?temporada=invierno" class="tarjeta-temporada">
                <img src="img/temporadas/invierno.png" alt="Invierno">
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
            <h1>Test De Plantas</h1>
            <p>Descubre tu planta ideal</p>
            <button class="boton-test">Realizar Test</button>
        </div>
    </div>
</section>

<?php
// ============================================================
// 6. INCLUIR FOOTER
// ============================================================
include 'includes/footer.php';

?>

