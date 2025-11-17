<?php
/**
 * ARCHIVO: ramos.php
 * PROPÓSITO: Mostrar catálogo de plantas pre-seleccionadas para hacer ramos
 * SIMILITUD: Similar a catalogo.php pero filtra productos con es_para_ramo = 1
 * 
 * FLUJO:
 * 1. Incluir header (navegación y estilos)
 * 2. Conectar a BD
 * 3. Construir query para obtener solo plantas para ramos
 * 4. Mostrar productos en grid
 * 5. Incluir footer
 */

// ============================================
// PASO 1: INCLUIR HEADER (logo, nav, estilos)
// ============================================
include 'includes/header.php';

// =============================
// CARGAR HOJA DE ESTILOS PARA RAMOS
// =============================
// Insertamos el enlace a la hoja de estilos específica de ramos
// inmediatamente después de cargar el header. Esto asegura que la
// página de ramos pre‑hechos utilice sus propios estilos y respete
// la estructura general del sitio sin interferir con otras vistas.
echo '<link rel="stylesheet" href="css/ramos.css">';

// ============================================
// PASO 2: CONECTAR A BASE DE DATOS
// ============================================
// Esta conexión es igual a la de catalogo.php
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$base_datos = 'ecommerce_plantas';

$conexion = mysqli_connect($host, $usuario, $contraseña, $base_datos);

// Verificar que la conexión fue exitosa
if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// ============================================
// PASO 3: CONSTRUIR LA CONSULTA SQL
// ============================================
// EXPLICACIÓN:
// - SELECT * FROM productos: obtener todos los campos de productos
// - WHERE es_para_ramo = 1: FILTRO CRUCIAL - solo plantas marcadas como aptas para ramos
// - ORDER BY nombre: ordenar alfabéticamente
// - LIMIT 12: mostrar máximo 12 productos (puedes cambiar según necesites)

$consulta = "SELECT * FROM productos WHERE es_para_ramo = 1 ORDER BY nombre LIMIT 12";
$resultado = mysqli_query($conexion, $consulta);

// ============================================
// PASO 4: VERIFICAR QUE LA CONSULTA FUNCIONÓ
// ============================================
// Si hay error en la consulta, mostrar mensaje
if (!$resultado) {
    echo '<div class="error-mensaje">';
    echo 'Error al obtener los ramos: ' . mysqli_error($conexion);
    echo '</div>';
}

// ============================================
// PASO 5: CREAR HTML DE LA PÁGINA
// ============================================
?>

<!-- SECCIÓN: Título y Descripción de Ramos -->
<section class="ramos-contenedor">
    <div class="ramos-encabezado">
        <h1>🌸 Ramos Pre-hechos</h1>
        <p>Selecciona entre nuestras mejores plantas para crear composiciones personalizadas</p>
    </div>

    <!-- SECCIÓN: Grid de Productos (Ramos) -->
    <div class="ramos-grid">
        <?php
        /**
         * EXPLICACIÓN DEL LOOP:
         * - mysqli_fetch_assoc($resultado) obtiene cada fila como array asociativo
         * - Mientras haya productos, entra al loop
         * - Cada iteración muestra una tarjeta de producto
         */
        
        if (mysqli_num_rows($resultado) > 0) {
            // Hay productos para mostrar
            while ($producto = mysqli_fetch_assoc($resultado)) {
                // Variables locales para esta iteración (cada producto)
                $id = $producto['id'];
                $nombre = $producto['nombre'];
                $nombre_cientifico = $producto['nombre_cientifico'];
                $precio = $producto['precio'];
                $stock = $producto['stock'];
                $imagen = $producto['imagen'];
                $dificultad = $producto['dificultad'];
                $riego = $producto['riego'];
                $temporada = strtoupper($producto['temporada']); // Convertir a mayúsculas
                ?>

                <!-- TARJETA DE PRODUCTO INDIVIDUAL -->
                <div class="ramo-tarjeta">
                    <!-- Badge de Temporada (pequeño cartel en esquina) -->
                    <div class="badge-temporada"><?php echo $temporada; ?></div>

                    <!-- Imagen del Producto -->
                    <div class="ramo-imagen">
                        <img src="img/plantas/ramo_default.jpg"
                             alt="<?php echo htmlspecialchars($nombre); ?>"
                             onerror="this.src='img/plantas/ramo_default.jpg'">
                    </div>

                    <!-- Contenido: Nombre, Precio, Info -->
                    <div class="ramo-contenido">
                        <!-- Nombre Común y Científico -->
                        <h3><?php echo $nombre; ?></h3>
                        <p class="nombre-cientifico"><?php echo $nombre_cientifico; ?></p>

                        <!-- Estado de Stock -->
                        <p class="stock-info">
                            <?php 
                            if ($stock > 0) {
                                echo '<span class="en-stock">En stock: ' . $stock . '</span>';
                            } else {
                                echo '<span class="agotado">Agotado</span>';
                            }
                            ?>
                        </p>

                        <!-- Información de Cuidados -->
                        <div class="cuidados-ramo">
                            <span class="cuidado-item">
                                💧 <?php echo $riego; ?>
                            </span>
                            <span class="cuidado-item">
                                📊 <?php echo $dificultad; ?>
                            </span>
                        </div>

                        <!-- Precio -->
                        <p class="ramo-precio">€<?php echo number_format($precio, 2); ?></p>

                        <!-- Botones de Acción -->
                        <div class="ramo-acciones">
                            <!-- Botón Ver Detalle -->
                            <a href="producto.php?id=<?php echo $id; ?>" 
                               class="boton boton-detalle">
                                Ver Detalle
                            </a>

                            <!-- Botón Agregar al Carrito (si hay stock) -->
                            <?php if ($stock > 0): ?>
                                <button class="boton boton-carrito" 
                                        onclick="agregarAlCarrito(<?php echo $id; ?>, '<?php echo $nombre; ?>')">
                                    🛒 Agregar
                                </button>
                            <?php else: ?>
                                <button class="boton boton-deshabilitado" disabled>
                                    No Disponible
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php
            } // Fin del while
        } else {
            // No hay productos para mostrar
            echo '<div class="sin-productos">';
            echo '<p>No hay ramos disponibles en este momento.</p>';
            echo '<a href="index.php" class="boton boton-volver">Volver al inicio</a>';
            echo '</div>';
        }
        ?>
    </div>
</section>

<?php
// ============================================
// PASO 6: CERRAR CONEXIÓN A BASE DE DATOS
// ============================================
// Buena práctica: liberar recursos después de usar la BD
mysqli_close($conexion);

// ============================================
// PASO 7: INCLUIR FOOTER (enlaces, newsletter)
// ============================================
include 'includes/footer.php';
?>

<!-- Script para agregar ramos al carrito con AJAX -->
<script>
// Función global para agregar un ramo al carrito. Envía una
// petición POST a agregar_al_carrito.php con id y cantidad=1. Al
// completarse se muestra una alerta y se actualiza el badge del
// carrito. Si ocurre un error, se captura en consola y se avisa al
// usuario.
function agregarAlCarrito(id, nombre) {
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
            alert('Producto agregado al carrito:\n\n' + nombre);
            actualizarContadorCarrito(data.total_items);
        } else {
            alert('Error al agregar el producto');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al agregar el producto');
    });
}

// Actualiza el contador del carrito
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