<?php
// (mantén tu conexión a la base de datos aquí si tienes)

$css_adicional = 'css/index.css';
$js_adicional = '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardín de Jazmines</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="<?php echo $css_adicional; ?>">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- SECCIÓN BUSCADOR -->
    <section class="seccion-buscador">
        <div class="buscador-contenido">
            <form class="search-wrapper" method="GET" action="catalogo.php">
                <input type="text" placeholder="Buscar plantas..." name="q" required>
                <button type="submit" class="search-btn">🔍</button>
            </form>
        </div>
    </section>

    <!-- SECCIÓN TEMPORADAS -->
    <section class="seccion-temporadas">
        <div class="container-temporadas">
            <h2 class="titulo-temporadas">Buscar por Temporada</h2>
            <div class="grid-temporadas">
                <a href="catalogo.php?temporada=primavera" class="tarjeta-temporada">
                    <img src="img/temporadas/primavera.png" alt="Primavera" onerror="this.src='img/placeholder.jpg'">
                    <div class="overlay-temporada">
                        <h3>Primavera</h3>
                        <p>Nuevos brotes y flores</p>
                    </div>
                </a>
                <a href="catalogo.php?temporada=verano" class="tarjeta-temporada">
                    <img src="img/temporadas/verano.png" alt="Verano" onerror="this.src='img/placeholder.jpg'">
                    <div class="overlay-temporada">
                        <h3>Verano</h3>
                        <p>Plantas resistentes al calor</p>
                    </div>
                </a>
                <a href="catalogo.php?temporada=otono" class="tarjeta-temporada">
                    <img src="img/temporadas/otono.png" alt="Otoño" onerror="this.src='img/placeholder.jpg'">
                    <div class="overlay-temporada">
                        <h3>Otoño</h3>
                        <p>Tonos cálidos y acogedores</p>
                    </div>
                </a>
                <a href="catalogo.php?temporada=invierno" class="tarjeta-temporada">
                    <img src="img/temporadas/invierno.png" alt="Invierno" onerror="this.src='img/placeholder.jpg'">
                    <div class="overlay-temporada">
                        <h3>Invierno</h3>
                        <p>Plantas de interior resistentes</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEST -->
    <section class="seccion-personalizada">
        <div class="contenedor">
            <div class="barra-verde"></div>
            <div class="contenido">
                <h1>Test De Plantas</h1>
                <p>Descubre tu planta ideal</p>
                <button class="boton-test" onclick="window.location.href='test/test.html'">Realizar Test</button>
            </div>
        </div>
    </section>

    <!-- SECCIÓN RAMOS PRE-HECHOS -->
    <!-- 
  ========================================
  SECCIÓN RAMOS PRE-HECHOS - INDEX.PHP
  ========================================
  Reemplaza la sección actual de ramos en index.php con esto
  Mantiene la estructura de tarjetas temporada pero minimalista
-->

<!-- SECCIÓN RAMOS PRE-HECHOS -->
<section class="seccion-ramos">
  <div class="ramos-container">
    <!-- Título de la sección -->
    <h2 class="ramos-titulo">🌸 Ramos Pre-hechos</h2>
    <p class="ramos-subtitulo">Descubre nuestras composiciones especiales de plantas para crear momentos especiales</p>
    
    <!-- Grid de 2 tarjetas SOLO -->
    <div class="ramos-grid">
      <!-- TARJETA 1: Regalos Perfectos -->
      <a href="ramos.php?tipo=regalos" class="tarjeta-ramo">
        <img src="img/plantas/Lirio de la Paz.jpg" alt="Regalos Perfectos" onerror="this.src='img/placeholder.jpg'">
        <div class="overlay-ramo">
          <h3>Regalos Perfectos</h3>
          <p>Composiciones especiales para sorprender a tus seres queridos</p>
          <span class="precio-ramo">Desde 45€</span>
        </div>
      </a>

      <!-- TARJETA 2: Plantas Seleccionadas -->
      <a href="ramos.php?tipo=seleccionadas" class="tarjeta-ramo">
        <img src="img/plantas/Anturio Rojo.jpg" alt="Plantas Seleccionadas" onerror="this.src='img/placeholder.jpg'">
        <div class="overlay-ramo">
          <h3>Plantas Seleccionadas</h3>
          <p>Las mejores variedades cuidadosamente seleccionadas</p>
          <span class="precio-ramo">Desde 35€</span>
        </div>
      </a>
    </div>
  </div>
</section>

    <!-- SECCIÓN EQUIPO -->
    <section class="seccion-equipo">
        <div class="equipo-container">
            <h2 class="equipo-titulo">¡Conoce a nuestro equipo!</h2>
            <p class="equipo-subtitulo">Somos una tienda de jardinería apasionada por las plantas y la vida vegetal. Nos encanta contribuir a nuestra comunidad y marcar la diferencia.</p>
            
            <div class="equipo-grid">
                <div class="miembro">
                    <img src="img/plantas/default.jpg" alt="Daniel Cebriano Buján" class="miembro-foto" onerror="this.src='img/avatar-default.jpg'">
                    <h3 class="miembro-nombre">Daniel Cebriano Buján</h3>
                    <p class="miembro-descripcion">Hola! Soy Daniel y me apasionan los musgos. Únete a mí para descubrir nuevas variedades.</p>
                    <a href="#" class="btn-rrss">RRSS</a>
                </div>
                <div class="miembro">
                    <img src="img/plantas/default.jpg" alt="Pau Gazapo Solís" class="miembro-foto" onerror="this.src='img/avatar-default.jpg'">
                    <h3 class="miembro-nombre">Pau Gazapo Solís</h3>
                    <p class="miembro-descripcion">Especialista en plantas de interior y diseño verde.</p>
                    <a href="#" class="btn-rrss">RRSS</a>
                </div>
                <div class="miembro">
                    <img src="img/plantas/default.jpg" alt="Marcos Narváez Suárez" class="miembro-foto" onerror="this.src='img/avatar-default.jpg'">
                    <h3 class="miembro-nombre">Marcos Narváez Suárez</h3>
                    <p class="miembro-descripcion">Amante de los cactus y variedades pinchudas.</p>
                    <a href="#" class="btn-rrss">RRSS</a>
                </div>
            </div>

                <div class="equipo-contacto">
                <a class="btn-contacto"
                    href="mailto:contacto@jardindejazmines.com?subject=Consulta%20desde%20la%20web">Escríbenos</a>
            </div>
        </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    
</body>
</html>