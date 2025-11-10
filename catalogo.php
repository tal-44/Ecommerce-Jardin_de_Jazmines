<?php
require_once 'config/conexion.php';

// Obtener parámetros de filtro
$temporada = isset($_GET['temporada']) ? $_GET['temporada'] : null;
$categoria_id = isset($_GET['categoria']) ? (int)$_GET['categoria'] : null;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'plantas'; // 'plantas' o 'ramos'

// Variables para header
$titulo_pagina = ($tipo === 'ramos') ? "Catálogo de Ramos" : "Catálogo de Plantas";
$css_adicional = '<link rel="stylesheet" href="css/catalogo.css">';
$js_adicional = '<script src="js/catalogo.js"></script>';

include 'includes/header.php';
?>

<section class="catalogo-section">
    <div class="catalogo-container">

        <!-- Selector de Tipo (Plantas o Ramos) -->
        <div class="tipo-selector">
            <a href="catalogo.php?tipo=plantas" class="tipo-btn <?php echo $tipo === 'plantas' ? 'activo' : ''; ?>">
                <i class="fas fa-leaf"></i> Plantas
            </a>
            <a href="catalogo.php?tipo=ramos" class="tipo-btn <?php echo $tipo === 'ramos' ? 'activo' : ''; ?>">
                <i class="fas fa-spa"></i> Ramos Pre-hechos
            </a>
        </div>

        <!-- Sidebar Filtros -->
        <aside class="filtros-sidebar">
            <h2>Filtros</h2>

            <!-- Filtro por Temporada -->
            <div class="filtro-grupo">
                <h3>Temporada</h3>
                <a href="catalogo.php?tipo=<?php echo $tipo; ?>" class="filtro-link <?php echo !$temporada ? 'activo' : ''; ?>">
                    Todas
                </a>
                <a href="catalogo.php?tipo=<?php echo $tipo; ?>&temporada=primavera" class="filtro-link <?php echo $temporada == 'primavera' ? 'activo' : ''; ?>">
                    Primavera
                </a>
                <a href="catalogo.php?tipo=<?php echo $tipo; ?>&temporada=verano" class="filtro-link <?php echo $temporada == 'verano' ? 'activo' : ''; ?>">
                    Verano
                </a>
                <a href="catalogo.php?tipo=<?php echo $tipo; ?>&temporada=otoño" class="filtro-link <?php echo $temporada == 'otoño' ? 'activo' : ''; ?>">
                    Otoño
                </a>
                <a href="catalogo.php?tipo=<?php echo $tipo; ?>&temporada=invierno" class="filtro-link <?php echo $temporada == 'invierno' ? 'activo' : ''; ?>">
                    Invierno
                </a>
                <a href="catalogo.php?tipo=<?php echo $tipo; ?>&temporada=todo_año" class="filtro-link <?php echo $temporada == 'todo_año' ? 'activo' : ''; ?>">
                    Todo el año
                </a>
            </div>

            <?php if ($tipo === 'plantas'): ?>
                <!-- Filtro por Categoría (solo para plantas) -->
                <div class="filtro-grupo">
                    <h3>Categoría</h3>
                    <?php
                    $sql_cat = "SELECT * FROM categorias WHERE id <= 5 ORDER BY nombre";
                    $result_cat = consulta_segura($conexion, $sql_cat);

                    echo '<a href="catalogo.php?tipo=plantas" class="filtro-link ' . (!$categoria_id ? 'activo' : '') . '">Todas</a>';

                    while ($cat = mysqli_fetch_assoc($result_cat)) {
                        $activo = ($categoria_id == $cat['id']) ? 'activo' : '';
                        echo '<a href="catalogo.php?tipo=plantas&categoria=' . $cat['id'] . '" class="filtro-link ' . $activo . '">';
                        echo $cat['nombre'];
                        echo '</a>';
                    }
                    ?>
                </div>
            <?php else: ?>
                <!-- Filtro por Ocasión (solo para ramos) -->
                <div class="filtro-grupo">
                    <h3>Ocasión</h3>
                    <?php
                    // PENDIENTE: No se si la tabla de ramos prefabricados ya existe ni como se llama si es asi. Tampoco sus campos ni atributos.
                    //  Tampoco he podido probar del todo si funciona todo perfectamente.
                    //  Por eso he hardcoeado algunas opciones.
                    $ocasiones = array(
                        'todas' => 'Todas',
                        'cumpleaños' => 'Cumpleaños',
                        'aniversario' => 'Aniversario',
                        'boda' => 'Bodas',
                        'condolencias' => 'Condolencias',
                        'felicitaciones' => 'Felicitaciones',
                        'día de la madre' => 'Día de la Madre'
                    );

                    foreach ($ocasiones as $valor => $etiqueta) {
                        $activo = (!isset($_GET['ocasion']) && $valor === 'todas') || (isset($_GET['ocasion']) && $_GET['ocasion'] === $valor) ? 'activo' : '';
                        $url = ($valor === 'todas') ? "catalogo.php?tipo=ramos" : "catalogo.php?tipo=ramos&ocasion=" . urlencode($valor);
                        echo '<a href="' . $url . '" class="filtro-link ' . $activo . '">' . $etiqueta . '</a>';
                    }
                    ?>
                </div>

                <!-- Filtro por Tamaño (solo para ramos) -->
                <div class="filtro-grupo">
                    <h3>Tamaño</h3>
                    <?php
                    $tamanos = array('todos' => 'Todos', 'pequeño' => 'Pequeño', 'mediano' => 'Mediano', 'grande' => 'Grande');
                    foreach ($tamanos as $valor => $etiqueta) {
                        $activo = (!isset($_GET['tamaño']) && $valor === 'todos') || (isset($_GET['tamaño']) && $_GET['tamaño'] === $valor) ? 'activo' : '';
                        $url = ($valor === 'todos') ? "catalogo.php?tipo=ramos" : "catalogo.php?tipo=ramos&tamaño=" . urlencode($valor);
                        if (isset($_GET['ocasion']) && $valor !== 'todos') $url .= "&ocasion=" . urlencode($_GET['ocasion']);
                        echo '<a href="' . $url . '" class="filtro-link ' . $activo . '">' . $etiqueta . '</a>';
                    }
                    ?>
                </div>
            <?php endif; ?>
        </aside>

        <!-- Grid de Productos -->
        <div class="productos-grid-container">
            <div class="catalogo-header">
                <h1>
                    <?php
                    if ($tipo === 'ramos') {
                        if (isset($_GET['ocasion']) && $_GET['ocasion'] !== 'todas') {
                            echo "Ramos para " . ucfirst($_GET['ocasion']);
                        } else {
                            echo "Todos los Ramos Pre-hechos";
                        }
                    } else {
                        if ($temporada) {
                            echo "Plantas de " . ucfirst($temporada);
                        } else {
                            echo "Todas las Plantas";
                        }
                    }
                    ?>
                </h1>
            </div>

            <div class="productos-grid">
                <?php
                if ($tipo === 'ramos') {
                    // ============================================================
                    // CONSULTA PARA RAMOS PRE-FABRICADOS
                    // ============================================================

                    $tabla_existe = mysqli_query($conexion, "SHOW TABLES LIKE 'ramos_prefabricados'");

                    if (mysqli_num_rows($tabla_existe) > 0) {

                        $sql = "SELECT * FROM ramos_prefabricados WHERE 1=1";

                        if ($temporada) {
                            $sql .= " AND temporada = '" . mysqli_real_escape_string($conexion, $temporada) . "'";
                        }

                        if (isset($_GET['ocasion']) && $_GET['ocasion'] !== 'todas') {
                            $sql .= " AND ocasion = '" . mysqli_real_escape_string($conexion, $_GET['ocasion']) . "'";
                        }

                        if (isset($_GET['tamaño']) && $_GET['tamaño'] !== 'todos') {
                            $sql .= " AND tamaño = '" . mysqli_real_escape_string($conexion, $_GET['tamaño']) . "'";
                        }

                        $sql .= " ORDER BY nombre";

                        $resultado = consulta_segura($conexion, $sql);

                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            while ($ramo = mysqli_fetch_assoc($resultado)) {
                ?>
                                <div class="producto-card ramo-card">
                                    <a href="ramo.php?id=<?php echo $ramo['id']; ?>" class="producto-link">
                                        <div class="producto-imagen">
                                            <img src="img/ramos/<?php echo $ramo['imagen']; ?>"
                                                alt="<?php echo htmlspecialchars($ramo['nombre']); ?>"
                                                onerror="this.src='img/plantas/default.jpg'">

                                            <!-- Badge de temporada -->
                                            <span class="badge-temporada <?php echo $ramo['temporada']; ?>">
                                                <?php echo ucfirst($ramo['temporada']); ?>
                                            </span>

                                            <!-- Badge de tamaño -->
                                            <span class="badge-tamaño">
                                                <?php echo ucfirst($ramo['tamaño']); ?>
                                            </span>
                                        </div>

                                        <div class="producto-info">
                                            <h3><?php echo htmlspecialchars($ramo['nombre']); ?></h3>
                                            <p class="ocasion-ramo"><i class="fas fa-gift"></i> <?php echo ucfirst($ramo['ocasion']); ?></p>
                                            <p class="descripcion-corta"><?php echo substr(htmlspecialchars($ramo['descripcion']), 0, 100) . '...'; ?></p>
                                            <p class="precio">€<?php echo number_format($ramo['precio'], 2); ?></p>

                                            <?php if ($ramo['stock'] > 0): ?>
                                                <span class="stock disponible">Disponible: <?php echo $ramo['stock']; ?></span>
                                            <?php else: ?>
                                                <span class="stock agotado">Agotado</span>
                                            <?php endif; ?>

                                            <div class="ramo-extras">
                                                <?php if ($ramo['incluye_envoltorio']): ?>
                                                    <span class="extra-icon" title="Incluye envoltorio"><i class="fas fa-gift-wrap"></i></span>
                                                <?php endif; ?>
                                                <?php if ($ramo['incluye_tarjeta']): ?>
                                                    <span class="extra-icon" title="Incluye tarjeta"><i class="fas fa-envelope"></i></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>

                                    <?php if ($ramo['stock'] > 0): ?>
                                        <button class="btn-agregar-carrito" data-id="<?php echo $ramo['id']; ?>" data-tipo="ramo">
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
                            echo '<p>No se encontraron ramos con los filtros seleccionados</p>';
                            echo '<a href="catalogo.php?tipo=ramos" class="btn-reset">Ver todos los ramos</a>';
                            echo '</div>';
                        }
                    } else {
                        // Ejemplo de muestra por si no existe la tabla
                        echo '<div class="sin-resultados advertencia-bd">';
                        echo '<i class="fas fa-database fa-3x" style="color: #f39c12;"></i>';
                        echo '<h3>Base de datos incompleta</h3>';
                        echo '<p>La tabla <code>ramos_prefabricados</code> aún no ha sido creada.</p>';
                        echo '<p><strong>Para activar esta funcionalidad:</strong></p>';
                        echo '<ol style="text-align: left; display: inline-block; margin: 1rem auto;">';
                        echo '<li>Importa el archivo <code>databases/extension_ramos.sql</code></li>';
                        echo '<li>Esto creará la tabla y datos de ejemplo</li>';
                        echo '<li>Recarga esta página</li>';
                        echo '</ol>';
                        echo '<a href="catalogo.php?tipo=plantas" class="btn-reset">Ver catálogo de plantas mientras tanto</a>';
                        echo '</div>';
                    }
                } else {
                    // ============================================================
                    // CONSULTA PARA PLANTAS (código original)
                    // ============================================================

                    // Construir consulta SQL con filtros
                    $sql = "SELECT p.*, c.nombre as categoria_nombre 
                        FROM productos p 
                        INNER JOIN categorias c ON p.categoria_id = c.id 
                        WHERE 1=1";

                    // Aplicar filtro de temporada
                    if ($temporada) {
                        $sql .= " AND p.temporada = '" . mysqli_real_escape_string($conexion, $temporada) . "'";
                    }

                    // Aplicar filtro de categoría
                    if ($categoria_id) {
                        $sql .= " AND p.categoria_id = $categoria_id";
                    }

                    $sql .= " ORDER BY p.nombre";

                    $resultado = consulta_segura($conexion, $sql);

                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($producto = mysqli_fetch_assoc($resultado)) {
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

                                        <?php if ($producto['stock'] > 0): ?>
                                            <span class="stock disponible">En stock: <?php echo $producto['stock']; ?></span>
                                        <?php else: ?>
                                            <span class="stock agotado">Agotado</span>
                                        <?php endif; ?>
                                    </div>
                                </a>

                                <?php if ($producto['stock'] > 0): ?>
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
                } // Fin del else de plantas
                ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>