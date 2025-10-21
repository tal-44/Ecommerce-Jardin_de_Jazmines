<?php
// Este archivo se incluye al final de todas las páginas
?>
    </main> <!-- Cierra el main abierto en header.php -->
<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer - Jardín de Jazmines</title>
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <footer class="footer-container">
        <div class="footer-left">
            <div class="logo-section">
                <a href="../index.php" class="logo">
                    <img src="../assets/logo.png" alt="Logo Jardín de Jazmines" class="logo-icon">
                </a>
            </div>
            <div class="register-section">
                <h2 class="register-title">¿Quieres registrarte?</h2>
                <p class="register-description">
                    Escríbenos a un correo a nuestra dirección de correo con tus
                    datos personales y una foto de tu tarjeta bancaria por los dos
                    lados y te registraremos en nuestra maravillosa plataforma.
                    ¡Anímate a formar parte de nuestra fantástica familia!!!
                </p>
                <button class="register-btn" id="registerBtn" aria-label="Contactar para registro">¡Escríbenos!</button>
            </div>
        </div>

        <div class="footer-right">
            <div class="search-section">
                <div class="search-container">
                    <input type="text" placeholder="Búsqueda" class="search-input" id="searchInput"
                        aria-label="Campo de búsqueda">
                    <button class="search-btn" id="searchBtn" aria-label="Buscar">Buscar</button>
                </div>
            </div>

            <div class="links-section">
                <div class="links-column">
                    <h3 class="column-title">Help</h3>
                    <ul class="links-list">
                        <li><a href="temp.html" class="footer-link">Conócenos</a></li> <!-- redirigir-->
                        <li><a href="temp.html" class="footer-link">Catálogo</a></li>
                        <!-- redirigir a catalogo.html cuando exista-->
                        <li><a href="temp.html" class="footer-link">Registro</a></li>
                        <!-- redirigir a registro.html cuando exista-->
                    </ul>
                </div>
                <div class="links-column">
                    <h3 class="column-title">Páginas de interés</h3>
                    <ul class="links-list">
                        <li><a href="https://cajadesuculentas.com/como-cuidar-suculentas-y-plantas-exoticas/"
                                class="footer-link" target="_blank" rel="noopener">Guía plantas exoticas</a></li>
                        <li><a href="https://hortodocampogrande.pt/loja/plantas-de-exterior/" class="footer-link"
                                target="_blank" rel="noopener">Guía plantas de extetior</a></li>
                        <li><a href="https://eligeveg.com/blog/lee-estos-chistes-para-veganos/" class="footer-link"
                                target="_blank" rel="noopener">Chistes sobre plantas</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <footer class="footer-container">
        <div class="footer-left">
            <div class="logo-section">
                <a href="index.php" class="logo">
                    <img src="img/logo.png" alt="Logo">
                </a>
            </div>

            <div class="register-section">
                <h2 class="register-title">¿Quieres registrarte?</h2>
                <p class="register-description">
                    Recibe noticias, ofertas exclusivas y consejos de jardinería.
                </p>
                <button class="register-btn" id="registerBtn">Registrarme</button>
            </div>
        </div>

        <div class="footer-right">
            <div class="search-section">
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Buscar..." class="search-input">
                    <button class="search-btn" id="searchBtn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="links-section">
                <div class="links-column">
                    <h3>Ayuda</h3>
                    <ul class="links-list">
                        <li><a href="#" class="footer-link">FAQ</a></li>
                        <li><a href="#" class="footer-link">Contacto</a></li>
                    </ul>
                </div>

                <div class="links-column">
                    <h3>Sobre Nosotros</h3>
                    <ul class="links-list">
                        <li><a href="#" class="footer-link">Quiénes somos</a></li>
                        <li><a href="#" class="footer-link">Blog</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts JavaScript -->
    <script src="js/header.js"></script>
    <script src="js/footer.js"></script>
    
    <!-- JS específico de cada página -->
    <?php if(isset($js_adicional)) echo $js_adicional; ?>
</body>
</html>
