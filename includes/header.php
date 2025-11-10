<?php
// includes/header.php
// - Fragmento de cabecera reutilizable para todas las páginas.
// - Dependencias: css/header.css, css/footer.css, Font Awesome (head)
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? $titulo_pagina : 'Tienda de Plantas'; ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <?php if (isset($css_adicional)) echo $css_adicional; ?>

    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="header-container">
        <!-- Barra de promoción -->
        <div class="promo-bar">
            <div class="promo-text">
                🌿 ¡Envío gratis en compras superiores a 50€! 🌿 Descubre nuestras plantas de temporada 🌿
            </div>
        </div>

        <!-- Header principal -->
        <header class="main-header">
            <div class="header-left">
                <!-- revisar: Falta la imagen de logo en img/logo.png; sustituir por logo real cuando lo tenagamos. -->
                <a href="index.php" class="logo">
                    <img src="img/logo.png" alt="Logo" class="logo-icon"
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'50\' height=\'50\'%3E%3Ccircle cx=\'25\' cy=\'25\' r=\'25\' fill=\'%234a7c59\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\' font-weight=\'bold\'%3EP%3C/text%3E%3C/svg%3E'; this.alt='Logo (pendiente)';">
                </a>
                <span class="site-title"><?php echo isset($nombre_empresa) ? $nombre_empresa : 'Nombre de la empresa (pendiente)'; ?></span>
            </div>

            <nav class="header-center">
                <a href="index.php" class="nav-button">Inicio</a>
                <a href="catalogo.php" class="nav-button">Plantas</a>
                <a href="catalogo.php?tipo=herramientas" class="nav-button">Herramientas</a>
                <a href="catalogo.php?tipo=ramos" class="nav-button">Ramos</a>
            </nav>

            <div class="header-right">
                <!-- Carrito: muestra contador desde $_SESSION['carrito']. Funcionalidad frontend aún pendiente. -->
                <button class="icon-button" title="Carrito de compras" onclick="window.location.href='#'" aria-label="Ver carrito de compras" aria-disabled="true">
                    <i class="fas fa-shopping-cart"></i>
                    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
                        <span class="cart-badge"><?php echo count($_SESSION['carrito']); ?></span>
                    <?php endif; ?>
                    <span class="note-small" style="font-size:0.75rem; margin-left:6px; color:#6c757d;">(Funcionalidad aún no implementada)</span>
                </button>

                <!-- Menú de usuario: los IDs #btnUserMenu y #userDropdown son usados por el JS. -->
                <div class="user-menu">
                    <button class="icon-button" id="btnUserMenu" aria-expanded="false" title="Menú de usuario">
                        <i class="fas fa-user"></i>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <?php if (isset($_SESSION['usuario_id'])): ?>
                            <a href="perfil.php" class="dropdown-item">
                                <i class="fas fa-user-circle"></i> Mi Perfil
                            </a>
                            <a href="pedidos.php" class="dropdown-item">
                                <i class="fas fa-shopping-bag"></i> Mis Pedidos
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </a>
                        <?php else: ?>
                            <!-- Iniciar sesión / Registrarse: enlaces marcadores. Texto indica estado. -->
                            <a href="login.php" class="dropdown-item" title="Funcionalidad aún no implementada">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión (aún no implementado)
                            </a>
                            <a href="registro.php" class="dropdown-item" title="Funcionalidad aún no implementada">
                                <i class="fas fa-user-plus"></i> Registrarse (aún no implementado)
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <!-- Aquí empieza el contenido de cada página -->
    <main class="contenido-principal">