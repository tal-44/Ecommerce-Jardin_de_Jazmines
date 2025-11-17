<?php
// resultado.php - Muestra el resultado del test de plantas.
// Selecciona dos plantas aleatorias de la base de datos y las muestra
// con el mismo estilo de tarjetas que el catálogo. No depende de las
// respuestas del test; simplemente sirve para sugerir productos.

// Conexión a la base de datos (ajusta según tu entorno)
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$base_datos = 'ecommerce_plantas';

$conexion = mysqli_connect($host, $usuario, $contraseña, $base_datos);
if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Obtener dos plantas aleatorias con stock disponible
$consulta = "SELECT * FROM productos WHERE stock > 0 ORDER BY RAND() LIMIT 2";
$resultado = mysqli_query($conexion, $consulta);
$plantas = [];
if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $plantas[] = $fila;
    }
}
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Test</title>
    <!-- Estilos originales del test -->
    <!-- Al estar en la raíz utilizamos rutas relativas directas a la carpeta css -->
    <link rel="stylesheet" href="css/testPaginas.css">
    <!-- Variables globales y estilos base (para que las variables CSS estén definidas) -->
    <link rel="stylesheet" href="css/index.css">
    <!-- Estilos del catálogo para reutilizar las tarjetas de producto -->
    <link rel="stylesheet" href="css/catalogo.css">
</head>
<body class="resultado-body">

    <div class="resultado-container">
        <h1 class="resultado-titulo">¡Estas plantas podrían ser perfectas para ti!</h1>
        <p class="resultado-subtitulo">Basándonos en tus respuestas, te sugerimos estas plantas de nuestro catálogo.</p>
        <?php if (isset($_GET['p']) && !empty($_GET['p'])): ?>
            <p class="resultado-recomendacion">Recomendación seleccionada: <strong><?php echo htmlspecialchars($_GET['p']); ?></strong></p>
        <?php endif; ?>

        <div class="productos-grid">
            <?php if (!empty($plantas)): ?>
                <?php foreach ($plantas as $planta): ?>
                    <div class="producto-card">
                        <div class="producto-img">
                            <img src="img/plantas/<?php echo htmlspecialchars($planta['imagen']); ?>" alt="<?php echo htmlspecialchars($planta['nombre']); ?>" onerror="this.src='img/plantas/default.jpg'">
                        </div>
                        <div class="producto-info">
                            <h3 class="producto-nombre"><?php echo htmlspecialchars($planta['nombre']); ?></h3>
                            <p class="producto-precio">€<?php echo number_format($planta['precio'], 2); ?></p>
                            <a href="producto.php?id=<?php echo $planta['id']; ?>" class="btn-ver-mas">Ver más</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="sin-plantas">No pudimos encontrar plantas en este momento. Inténtalo más tarde.</p>
            <?php endif; ?>
        </div>

        <div class="resultado-navegacion">
            <a href="test/test.html" class="btn-nav btn-volver">← Repetir Test</a>
            <a href="catalogo.php" class="btn-nav btn-catalogo">Ver Todas las Plantas →</a>
            <a href="index.php" class="btn-nav btn-inicio">🏠 Volver al Inicio</a>
        </div>
    </div>

</body>
</html>