<?php
/**
 * Archivo de conexión a base de datos
 * Este archivo se incluye en todas las páginas que necesiten acceso a BD
 */

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ecommerce_plantas');

// Crear conexión
$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if (!$conexion) {
    die("❌ Error de conexión: " . mysqli_connect_error());
}

// Configurar charset para caracteres especiales (ñ, acentos, etc)
mysqli_set_charset($conexion, "utf8mb4");

// Iniciar sesión si no está activa (para carrito de compras futuro)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función helper para consultas
function consulta_segura($conexion, $sql) {
    $resultado = mysqli_query($conexion, $sql);
    if (!$resultado) {
        error_log("Error SQL: " . mysqli_error($conexion));
        return false;
    }
    return $resultado;
}
?>
