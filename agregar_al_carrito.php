<?php
/**
 * agregar_al_carrito.php
 *
 * Endpoint para añadir productos o herramientas al carrito mediante
 * peticiones POST (AJAX). Recibe el ID del producto y la cantidad,
 * guarda estos valores en la sesión del usuario y devuelve un JSON
 * con la cantidad total de artículos en el carrito.
 */

session_start();

// Leer el ID del producto y la cantidad desde la petición
$producto_id = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : 0;
$cantidad    = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;

// Validar datos
if ($producto_id <= 0 || $cantidad <= 0) {
    echo json_encode([
        'success' => false,
        'mensaje' => 'Datos de producto no válidos'
    ]);
    exit;
}

// Inicializar carrito si no existe
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Agregar o actualizar la cantidad del producto
if (isset($_SESSION['cart'][$producto_id])) {
    $_SESSION['cart'][$producto_id] += $cantidad;
} else {
    $_SESSION['cart'][$producto_id] = $cantidad;
}

// Calcular el total de artículos en el carrito
$total_items = 0;
foreach ($_SESSION['cart'] as $qty) {
    $total_items += (int)$qty;
}

// Devolver respuesta JSON
echo json_encode([
    'success'     => true,
    'total_items' => $total_items
]);
?>