<?php
require_once 'config/conexion.php';

// Obtener parámetros de filtro
$temporada = isset($_GET['temporada']) ? $_GET['temporada'] : null;
$categoria_id = isset($_GET['categoria']) ? (int)$_GET['categoria'] : null;

// Variables para header
$titulo_pagina = "Catálogo de Plantas";
$css_adicional = '<link rel="stylesheet" href="css/catalogo.css">';
$js_adicional = '<script src="js/catalogo.js"></script>';

include 'includes/header.php';
?>

<section class="catalogo-section">
    <div class="catalogo-container">
        
        <!-- Sidebar Filtros -->
        <aside class="filtros-sidebar">
            <h2>Filtros</h2>
            
            <!-- Filtro por Temporada -->
            <div class="filtro-grupo">
                <h3>Temporada</h3>
                <a href="catalogo.php" class="filtro-link <?php echo !$temporada ? 'activo' : ''; ?>">
                    Todas
                </a>
                <a href="catalogo.php?temporada=primavera" class="filtro-link <?php echo $temporada == 'primavera' ? 'activo' : ''; ?>">
                    Primavera
                </a>
                <a href="catalogo.php?temporada=verano" class="filtro-link <?php echo $temporada == 'verano' ? 'activo' : ''; ?>">
                    Verano
                </a>
                <a href="catalogo.php?temporada=otoño" class="filtro-link <?php echo $temporada == 'otoño' ? 'activo' : ''; ?>">
                    Otoño
                </a>
                <a href="catalogo.php?temporada=invierno" class="filtro-link <?php echo $temporada == 'invierno' ? 'activo' : ''; ?>">
                    Invierno
                </a>
                <a href="catalogo.php?temporada=todo_año" class="filtro-link <?php echo $temporada == 'todo_año' ? 'activo' : ''; ?>">
                    Todo el año
                </a>
            </div>

            <!-- Filtro por Categoría -->
            <div class="filtro-grupo">
                <h3>Categoría</h3>
                <?php
                $sql_cat = "SELECT * FROM categorias WHERE id <= 5 ORDER BY nombre";
                $result_cat = consulta_segura($conexion, $sql_cat);
                
                echo '<a href="catalogo.php" class="filtro-link ' . (!$categoria_id ? 'activo' : '') . '">Todas</a>';
                
                while($cat = mysqli_fetch_assoc($result_cat)) {
                    $activo = ($categoria_id == $cat['id']) ? 'activo' : '';
                    echo '<a href="catalogo.php?categoria=' . $cat['id'] . '" class="filtro-link ' . $activo . '">';
                    echo $cat['nombre'];
                    echo '</a>';
                }
                ?>
            </div>
        </aside>

        <!-- Grid de Productos -->
        <div class="productos-grid-container">
            <div class="catalogo-header">
                <h1>
                    <?php 
                    if($temporada) {
                        echo "Plantas de " . ucfirst($temporada);
                    } else {
                        echo "Todas las Plantas";
                    }
                    ?>
                </h1>
            </div>

            <div class="productos-grid">
                <?php
                // Construir consulta SQL con filtros
                $sql = "SELECT p.*, c.nombre as categoria_nombre 
                        FROM productos p 
                        INNER JOIN categorias c ON p.categoria_id = c.id 
                        WHERE 1=1";
                
                // Aplicar filtro de temporada
                if($temporada) {
                    $sql .= " AND p.temporada = '" . mysqli_real_escape_string($conexion, $temporada) . "'";
                }
                
                // Aplicar filtro de categoría
                if($categoria_id) {
                    $sql .= " AND p.categoria_id = $categoria_id";
                }
                
                $sql .= " ORDER BY p.nombre";
                
                $resultado = consulta_segura($conexion, $sql);
                
                if($resultado && mysqli_num_rows($resultado) > 0) {
                    while($producto = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <div class="producto-card">
                            <a href="producto.php?id=<?php echo $producto['id']; ?>" class="producto-link">
                                <div class="producto-imagen">
                                    <img src="img/plantas/<?php echo $producto['imagen']; ?>" 
                                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                         onerror="this.src='img/plantas/default.jpg'">
                                    
                                    <!-- Badge de temporada -->
                                    <span class="badge-temporada <?php echo $producto['temporada']; ?>">
                                        <?php echo ucfirst($producto['temporada']); ?>
                                    </span>
                                </div>

                                <div class="producto-info">
                                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                                    <p class="nombre-cientifico"><?php echo htmlspecialchars($producto['nombre_cientifico']); ?></p>
                                    <p class="categoria"><?php echo $producto['categoria_nombre']; ?></p>
                                    <p class="precio">€<?php echo number_format($producto['precio'], 2); ?></p>
                                    
                                    <?php if($producto['stock'] > 0): ?>
                                        <span class="stock disponible">En stock: <?php echo $producto['stock']; ?></span>
                                    <?php else: ?>
                                        <span class="stock agotado">Agotado</span>
                                    <?php endif; ?>
                                </div>
                            </a>

                            <?php if($producto['stock'] > 0): ?>
                                <button class="btn-agregar-carrito" data-id="<?php echo $producto['id']; ?>">
                                    <i class="fas fa-shopping-cart"></i> Agregar al carrito
                                </button>
                            <?php else: ?>
                                <button class="btn-agregar-carrito" disabled>
                                    No disponible
                                </button>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="sin-resultados">';
                    echo '<i class="fas fa-search fa-3x"></i>';
                    echo '<p>No se encontraron productos con los filtros seleccionados</p>';
                    echo '<a href="catalogo.php" class="btn-reset">Ver todas las plantas</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
