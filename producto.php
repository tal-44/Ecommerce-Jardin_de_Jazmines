<?php
require_once 'config/conexion.php';

// ============================================================
// 1. OBTENER ID DEL PRODUCTO
// ============================================================
$producto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($producto_id == 0) {
    header("Location: catalogo.php");
    exit;
}

// ============================================================
// 2. CONSULTAR PRODUCTO
// ============================================================
$sql = "SELECT p.*, c.nombre as categoria_nombre 
        FROM productos p 
        INNER JOIN categorias c ON p.categoria_id = c.id 
        WHERE p.id = ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $producto_id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$producto = mysqli_fetch_assoc($resultado);

// Si no existe el producto, redirigir
if(!$producto) {
    header("Location: catalogo.php");
    exit;
}

// ============================================================
// 3. VARIABLES PARA HEADER
// ============================================================
$titulo_pagina = htmlspecialchars($producto['nombre']) . " - Tienda de Plantas";
$css_adicional = '<link rel="stylesheet" href="css/producto.css">';
$js_adicional = '<script src="js/producto.js"></script>';

// ============================================================
// 4. INCLUIR HEADER
// ============================================================
include 'includes/header.php';
?>

<!-- ============================================================
     5. CONTENIDO PRINCIPAL
     ============================================================ -->

<div class="producto-detalle-container">
    
    <!-- Breadcrumb (migas de pan) -->
    <nav class="breadcrumb">
        <a href="index.php">Inicio</a>
        <span class="separador">/</span>
        <a href="catalogo.php">Catálogo</a>
        <span class="separador">/</span>
        <a href="catalogo.php?categoria=<?php echo $producto['categoria_id']; ?>">
            <?php echo $producto['categoria_nombre']; ?>
        </a>
        <span class="separador">/</span>
        <span class="actual"><?php echo htmlspecialchars($producto['nombre']); ?></span>
    </nav>

    <!-- Grid principal: 2 columnas -->
    <div class="producto-grid">
        
        <!-- ============================================================
             COLUMNA IZQUIERDA: IMAGEN
             ============================================================ -->
        <div class="producto-imagen-contenedor">
            <div class="imagen-principal">
                <img src="img/plantas/<?php echo $producto['imagen']; ?>" 
                     alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                     id="imagenPrincipal"
                     onerror="this.src='img/plantas/default.jpg'">
                
                <!-- Badge de temporada -->
                <span class="badge-temporada badge-<?php echo $producto['temporada']; ?>">
                    <i class="fas fa-calendar-alt"></i>
                    <?php echo ucfirst($producto['temporada']); ?>
                </span>
            </div>
        </div>

        <!-- ============================================================
             COLUMNA DERECHA: INFORMACIÓN
             ============================================================ -->
        <div class="producto-info-contenedor">
            
            <!-- Categoría -->
            <div class="categoria-badge">
                <i class="fas fa-tag"></i>
                <?php echo $producto['categoria_nombre']; ?>
            </div>

            <!-- Nombre -->
            <h1 class="producto-nombre"><?php echo htmlspecialchars($producto['nombre']); ?></h1>
            
            <!-- Nombre científico -->
            <p class="nombre-cientifico">
                <i class="fas fa-leaf"></i>
                <?php echo htmlspecialchars($producto['nombre_cientifico']); ?>
            </p>

            <!-- Precio y Stock -->
            <div class="precio-stock">
                <div class="precio-principal">
                    <span class="precio">€<?php echo number_format($producto['precio'], 2); ?></span>
                </div>
                <div class="stock-info">
                    <?php if($producto['stock'] > 0): ?>
                        <span class="stock disponible">
                            <i class="fas fa-check-circle"></i>
                            En stock (<?php echo $producto['stock']; ?> unidades)
                        </span>
                    <?php else: ?>
                        <span class="stock agotado">
                            <i class="fas fa-times-circle"></i>
                            Agotado
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Descripción -->
            <div class="descripcion-producto">
                <h3><i class="fas fa-info-circle"></i> Descripción</h3>
                <p><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
            </div>

            <!-- Cuidados -->
            <div class="cuidados-contenedor">
                <h3><i class="fas fa-seedling"></i> Guía de Cuidados</h3>
                <div class="cuidados-grid">
                    
                    <div class="cuidado-item">
                        <div class="icono-cuidado">
                            <i class="fas fa-tint"></i>
                        </div>
                        <div class="info-cuidado">
                            <span class="label">Riego</span>
                            <span class="valor"><?php echo htmlspecialchars($producto['riego']); ?></span>
                        </div>
                    </div>

                    <div class="cuidado-item">
                        <div class="icono-cuidado">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="info-cuidado">
                            <span class="label">Dificultad</span>
                            <span class="valor"><?php echo htmlspecialchars($producto['dificultad']); ?></span>
                        </div>
                    </div>

                    <div class="cuidado-item">
                        <div class="icono-cuidado">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="info-cuidado">
                            <span class="label">Temporada</span>
                            <span class="valor"><?php echo ucfirst($producto['temporada']); ?></span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Formulario Agregar al Carrito -->
            <?php if($producto['stock'] > 0): ?>
            <div class="agregar-carrito-contenedor">
                <form id="formAgregarCarrito" class="form-carrito">
                    <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                    
                    <div class="cantidad-selector">
                        <button type="button" class="btn-cantidad" id="btnMenos">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" 
                               name="cantidad" 
                               id="inputCantidad" 
                               value="1" 
                               min="1" 
                               max="<?php echo $producto['stock']; ?>" 
                               readonly>
                        <button type="button" class="btn-cantidad" id="btnMas">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <button type="submit" class="btn-agregar-carrito-grande">
                        <i class="fas fa-shopping-cart"></i>
                        Agregar al Carrito
                    </button>
                </form>

                <div id="mensaje-exito" class="mensaje-exito oculto">
                    <i class="fas fa-check-circle"></i>
                    ¡Producto agregado al carrito!
                </div>
            </div>
            <?php else: ?>
            <div class="mensaje-agotado">
                <i class="fas fa-exclamation-triangle"></i>
                Producto agotado. Te notificaremos cuando esté disponible.
            </div>
            <?php endif; ?>

            <!-- Botón volver -->
            <a href="catalogo.php" class="btn-volver">
                <i class="fas fa-arrow-left"></i>
                Volver al catálogo
            </a>

        </div>

    </div>

    <!-- ============================================================
         6. PRODUCTOS RELACIONADOS
         ============================================================ -->
    <div class="productos-relacionados">
        <h2><i class="fas fa-leaf"></i> Productos Relacionados</h2>
        <div class="grid-relacionados">
            <?php
            $sql_rel = "SELECT * FROM productos 
                        WHERE categoria_id = ? 
                        AND id != ? 
                        AND stock > 0 
                        LIMIT 4";
            $stmt_rel = mysqli_prepare($conexion, $sql_rel);
            mysqli_stmt_bind_param($stmt_rel, "ii", $producto['categoria_id'], $producto_id);
            mysqli_stmt_execute($stmt_rel);
            $result_rel = mysqli_stmt_get_result($stmt_rel);
            
            if(mysqli_num_rows($result_rel) > 0) {
                while($rel = mysqli_fetch_assoc($result_rel)) {
                    ?>
                    <a href="producto.php?id=<?php echo $rel['id']; ?>" class="card-relacionado">
                        <div class="imagen-relacionado">
                            <img src="img/plantas/<?php echo $rel['imagen']; ?>" 
                                 alt="<?php echo htmlspecialchars($rel['nombre']); ?>"
                                 onerror="this.src='img/plantas/default.jpg'">
                        </div>
                        <div class="info-relacionado">
                            <h4><?php echo htmlspecialchars($rel['nombre']); ?></h4>
                            <p class="precio-relacionado">€<?php echo number_format($rel['precio'], 2); ?></p>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo '<p class="sin-relacionados">No hay productos relacionados disponibles</p>';
            }
            ?>
        </div>
    </div>

</div>

<?php
// ============================================================
// 7. INCLUIR FOOTER
// ============================================================
include 'includes/footer.php';
?>