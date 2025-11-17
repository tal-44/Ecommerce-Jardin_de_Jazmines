<?php
/**
 * =================================================================
 * ARCHIVO: herramientas.php - CATÁLOGO DE HERRAMIENTAS
 * =================================================================
 * 
 * Basado en: catalogo.php
 * 
 * Diferencias:
 * - Conecta a tabla 'herramientas' en lugar de 'productos'
 * - Filtra por 'tipo_herramienta' en lugar de 'temporada'
 * - Muestra herramientas de jardinería
 * 
 * =================================================================
 */

// Incluir el header (logo, navegación, etc.)
// Después de incluir el header añadimos la hoja de estilos específica
// para esta página. Colocar el enlace aquí permite que se cargue el
// CSS sin modificar el archivo del header. Si ya tienes un sistema
// de importación de CSS adicional en tu header, puedes mover este
// enlace allí.
include 'includes/header.php';

// Cargar estilos específicos de herramientas
echo '<link rel="stylesheet" href="css/herramientas.css">';

// Conexión a BD
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$base_datos = 'ecommerce_plantas';

$conexion = mysqli_connect($host, $usuario, $contraseña, $base_datos);

if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Obtener tipos de herramientas disponibles
$query_tipos = "SELECT DISTINCT tipo_herramienta FROM herramientas ORDER BY tipo_herramienta";
$resultado_tipos = mysqli_query($conexion, $query_tipos);
$tipos = [];
if ($resultado_tipos) {
    while ($row = mysqli_fetch_assoc($resultado_tipos)) {
        $tipos[] = $row['tipo_herramienta'];
    }
}

// Obtener herramientas (con filtros)
$filtro_tipo = isset($_GET['tipo']) ? mysqli_real_escape_string($conexion, $_GET['tipo']) : '';

$query = "SELECT * FROM herramientas WHERE 1=1";

if ($filtro_tipo) {
    $query .= " AND tipo_herramienta = '$filtro_tipo'";
}

$query .= " ORDER BY nombre ASC";

$resultado = mysqli_query($conexion, $query);
$herramientas = [];

if ($resultado) {
    while ($herramienta = mysqli_fetch_assoc($resultado)) {
        $herramientas[] = $herramienta;
    }
}
?>

<!-- =================================================================
     SECCIÓN: ENCABEZADO DE HERRAMIENTAS
     ================================================================= -->
<section class="seccion-catalogo-header">
    <h1>Herramientas de Jardinería</h1>
    <p>Todo lo que necesitas para cuidar tus plantas</p>
</section>

<!-- =================================================================
     SECCIÓN: CATÁLOGO CON FILTROS
     ================================================================= -->
<section class="seccion-catalogo">
    <div class="catalogo-container">
        
        <!-- FILTROS (izquierda) -->
        <aside class="filtros-panel">
            <h3>Filtros</h3>
            
            <!-- Filtro por Tipo -->
            <div class="filtro-grupo">
                <h4>Tipo de Herramienta</h4>
                <ul class="filtro-lista">
                    <li>
                        <a href="herramientas.php" class="<?php echo $filtro_tipo == '' ? 'activo' : ''; ?>">
                            Todos
                        </a>
                    </li>
                    <?php foreach ($tipos as $tipo): ?>
                        <li>
                            <a href="herramientas.php?tipo=<?php echo urlencode($tipo); ?>" 
                               class="<?php echo $filtro_tipo == $tipo ? 'activo' : ''; ?>">
                                <?php echo ucfirst($tipo); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>

        <!-- CONTENIDO (derecha) -->
        <main class="catalogo-contenido">
            
            <!-- Grid de Herramientas -->
            <div class="grid-herramientas">
                <?php foreach ($herramientas as $herramienta): ?>
                    <div class="tarjeta-herramienta">
                        
                        <!-- Imagen -->
                        <div class="herramienta-imagen">
                            <img src="img/herramientas/<?php echo $herramienta['imagen']; ?>"
                                 alt="<?php echo htmlspecialchars($herramienta['nombre']); ?>"
                                 onerror="this.src='img/plantas/herra.jpg'">
                            <span class="tipo-badge"><?php echo ucfirst($herramienta['tipo_herramienta']); ?></span>
                        </div>

                        <!-- Contenido -->
                        <div class="herramienta-contenido">
                            <h3><?php echo $herramienta['nombre']; ?></h3>
                            <p class="descripcion"><?php echo substr($herramienta['descripcion'], 0, 80) . '...'; ?></p>
                            
                            <div class="herramienta-info">
                                <span class="material">
                                    <?php
                                    // Mostrar materiales solo si existen en la base de datos
                                    if (!empty($herramienta['material'])) {
                                        echo 'Materiales: ' . htmlspecialchars($herramienta['material']);
                                    }
                                    ?>
                                </span>
                            </div>

                            <p class="precio">€<?php echo number_format($herramienta['precio'], 2); ?></p>

                            <?php if ($herramienta['stock'] > 0): ?>
                                <p class="stock">En stock (<?php echo $herramienta['stock']; ?>)</p>
                            <?php else: ?>
                                <p class="sin-stock">Agotado</p>
                            <?php endif; ?>

                            <!-- Botones -->
                            <div class="herramienta-botones">
                                <a href="producto.php?id=<?php echo $herramienta['id']; ?>&tipo=herramienta" 
                                   class="btn btn-detalle">
                                    Ver Detalle
                                </a>
                                <?php if ($herramienta['stock'] > 0): ?>
                                    <button class="btn btn-carrito" 
                                            onclick="agregarAlCarrito(<?php echo $herramienta['id']; ?>, '<?php echo addslashes($herramienta['nombre']); ?>')">
                                        🛒 Agregar
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-deshabilitado" disabled>Agotado</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Mensaje si no hay herramientas -->
            <?php if (count($herramientas) == 0): ?>
                <div class="sin-resultados">
                    <p>No se encontraron herramientas con los filtros seleccionados.</p>
                </div>
            <?php endif; ?>

        </main>

    </div>
</section>

<!-- Script para agregar al carrito -->
<script>
function agregarAlCarrito(id, nombre) {
    // Construir datos a enviar (1 unidad por defecto)
    const formData = new FormData();
    formData.append('producto_id', id);
    formData.append('cantidad', 1);

    fetch('agregar_al_carrito.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Producto agregado al carrito:\n' + nombre);
            // Actualizar contador de carrito en el header
            actualizarContadorCarrito(data.total_items);
        } else {
            alert('Error: ' + (data.mensaje || 'No se pudo agregar el producto'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al agregar el producto');
    });
}

// Función para actualizar el badge del carrito en el header
function actualizarContadorCarrito(total) {
    const btnCarrito = document.querySelector('[title="Carrito de compras"]');
    if (!btnCarrito) return;
    let badge = btnCarrito.querySelector('.cart-badge');
    if (!badge) {
        badge = document.createElement('span');
        badge.className = 'cart-badge';
        btnCarrito.appendChild(badge);
    }
    badge.textContent = total;
}
</script>

<?php
// Incluir footer
include 'includes/footer.php';

// Cerrar conexión
mysqli_close($conexion);
?>