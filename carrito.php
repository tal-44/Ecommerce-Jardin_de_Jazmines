<?php
/**
 * carrito.php
 *
 * Vista sencilla del carrito de compras. Este script muestra los
 * productos almacenados en la sesión y sus cantidades, sumando el
 * total del pedido. Para simplificar, busca cada producto en las
 * tablas "productos" y "herramientas". Se recomienda optimizar
 * utilizando identificadores únicos o una columna que diferencie
 * entre tipos de artículos en una implementación real.
 */

session_start();

// Conectar a la base de datos
$host       = 'localhost';
$usuario    = 'root';
$contraseña = '';
$base_datos = 'ecommerce_plantas';
$conexion   = mysqli_connect($host, $usuario, $contraseña, $base_datos);

if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Obtener el carrito de la sesión
$carrito = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Preparar un array para almacenar detalles de productos
$items = [];
$total_general = 0;

foreach ($carrito as $id => $cantidad) {
    $id = (int)$id;
    $cantidad = (int)$cantidad;
    $detalle = null;

    // Buscar en la tabla de productos
    $sqlProducto = "SELECT id, nombre, precio, imagen, 'producto' AS tipo FROM productos WHERE id = $id";
    $resProd = mysqli_query($conexion, $sqlProducto);
    if ($resProd && mysqli_num_rows($resProd) > 0) {
        $detalle = mysqli_fetch_assoc($resProd);
    }

    // Si no se encuentra en productos, buscar en herramientas
    if (!$detalle) {
        $sqlHerramienta = "SELECT id, nombre, precio, imagen, 'herramienta' AS tipo FROM herramientas WHERE id = $id";
        $resHerr = mysqli_query($conexion, $sqlHerramienta);
        if ($resHerr && mysqli_num_rows($resHerr) > 0) {
            $detalle = mysqli_fetch_assoc($resHerr);
        }
    }

    // Si se encontró el artículo, calcular subtotal y acumular
    if ($detalle) {
        $detalle['cantidad']  = $cantidad;
        $detalle['subtotal']  = $detalle['precio'] * $cantidad;
        $total_general       += $detalle['subtotal'];
        $items[] = $detalle;
    }
}

// Variables de página para el header
$titulo_pagina  = 'Tu Carrito de Compras';
$css_adicional  = '<link rel="stylesheet" href="css/catalogo.css"><link rel="stylesheet" href="css/producto.css">';
$js_adicional   = '';

include 'includes/header.php';
?>

<!-- Contenido principal del carrito -->
<section class="catalogo-section">
    <div class="catalogo-container" style="grid-template-columns: 1fr;">
        <div class="productos-grid-container">
            <div class="catalogo-header">
                <h1>Carrito de Compras</h1>
            </div>
            <?php if (empty($items)): ?>
                <div class="sin-resultados">
                    <p>No tienes productos en tu carrito.</p>
                    <a href="catalogo.php" class="btn-reset">Volver al catálogo</a>
                </div>
            <?php else: ?>
                <table style="width:100%; border-collapse: collapse; margin-bottom: 2rem;">
                    <thead>
                        <tr>
                            <th style="text-align:left; padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">Producto</th>
                            <th style="text-align:center; padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">Cantidad</th>
                            <th style="text-align:right; padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">Precio</th>
                            <th style="text-align:right; padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f1f1f1; display:flex; align-items:center; gap:1rem;">
                                    <img src="img/<?php echo ($item['tipo'] === 'herramienta' ? 'herramientas' : 'plantas'); ?>/<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" style="width:60px; height:60px; object-fit:cover; border-radius:8px;" onerror="this.src='img/plantas/default.jpg'">
                                    <span><?php echo htmlspecialchars($item['nombre']); ?></span>
                                </td>
                                <td style="text-align:center; padding: 0.75rem; border-bottom: 1px solid #f1f1f1;">x<?php echo $item['cantidad']; ?></td>
                                <td style="text-align:right; padding: 0.75rem; border-bottom: 1px solid #f1f1f1;">€<?php echo number_format($item['precio'], 2); ?></td>
                                <td style="text-align:right; padding: 0.75rem; border-bottom: 1px solid #f1f1f1;">€<?php echo number_format($item['subtotal'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align:right; padding: 0.75rem; font-weight:600;">Total:</td>
                            <td style="text-align:right; padding: 0.75rem; font-weight:600;">€<?php echo number_format($total_general, 2); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <a href="catalogo.php" id="seguirComprandoBtn" class="btn-reset" style="display:inline-block; margin-top:1rem;">Seguir comprando</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';

// Cerrar conexión
mysqli_close($conexion);
?>

<!-- Script para mostrar chistes al seguir comprando -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnSeguir = document.getElementById('seguirComprandoBtn');
    if (btnSeguir) {
        btnSeguir.addEventListener('click', function(e) {
            e.preventDefault();
            const chistes = [
                '¿Por qué la planta fue a la fiesta? Porque tenía raíces en todas partes.',
                '¿Qué hace una planta cuando la invitan a salir? ¡Se planta!',
                '¿Por qué el tomate se puso rojo? Porque vio la ensalada desnuda.'
            ];
            alert(chistes[Math.floor(Math.random() * chistes.length)]);
            // Redirigir al catálogo después de mostrar el chiste
            window.location.href = 'catalogo.php';
        });
    }
});
</script>