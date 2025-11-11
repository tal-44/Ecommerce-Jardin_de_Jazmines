<?php
// Este archivo se incluye al final de todas las páginas
?>
</main> <!-- Cierra el main abierto en header.php -->

<footer class="footer-container">
    <div class="footer-left">
        <div class="logo-section">
            <a href="/index.php" class="logo">
                <img src="/img/logo.png" alt="Logo">
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

            <div class="links-column">
                <h3>Legal</h3>
                <ul class="links-list">
                    <li><a href="/pages/aviso-legal.php" class="footer-link">Aviso Legal</a></li>
                    <li><a href="/pages/politica-privacidad.php" class="footer-link">Política de Privacidad</a></li>
                    <li><a href="/pages/politica-cookies.php" class="footer-link">Política de Cookies</a></li>
                    <li><a href="/pages/condiciones-venta.php" class="footer-link">Condiciones de Venta</a></li>
                    <li><a href="/pages/derecho-desistimiento.php" class="footer-link">Derecho de Desistimiento</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Información legal del pie de página -->
<div class="footer-legal">
    <p>&copy; <?php echo date('Y'); ?> Jardín de Jazmines. Todos los derechos reservados.</p>
    <p class="legal-info">
        <span>NIF/CIF: [Pendiente]</span> |
        <span>Registro Mercantil: [Pendiente]</span> |
        <span>Dirección: [Pendiente]</span>
    </p>
</div>

<!-- Scripts JavaScript -->
<script src="/interfacesWeb1/js/header.js"></script>
<script src="/interfacesWeb1/js/footer.js"></script>

<!-- JS específico de cada página -->
<?php if (isset($js_adicional)) echo $js_adicional; ?>
</body>

</html>