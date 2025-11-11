<?php
// Archivo de prueba para verificar conexión a la base de datos
// Colocar en: c:\xampp\htdocs\interfacesWeb1\test_db.php

require_once __DIR__ . '/config/conexion.php';

// Si `conexion.php` falla, normalmente hará die() y se verá el error.
// Si llega hasta aquí, la conexión está OK.
echo "✅ Conexión correcta a la base de datos: " . DB_NAME . "<br>";
echo "Host: " . DB_HOST . " - Usuario: " . DB_USER . "<br>";

// Ejecutar una consulta simple para verificar lecturas
$sql = "SELECT NOW() as ahora";
$res = mysqli_query($conexion, $sql);
if ($res) {
    $row = mysqli_fetch_assoc($res);
    echo "Hora del servidor MySQL: " . $row['ahora'];
} else {
    echo "❌ Error ejecutando consulta de prueba: " . mysqli_error($conexion);
}

?>
