<?php
// Archivo de prueba que incluye header/footer desde la carpeta pages.
// Intenta preferir archivos .php y, si no existen, cae a .html.
// Uso de realpath() para evitar rutas mal formadas y mejorar portabilidad.

// Carpeta pages relativa al archivo actual
$pagesDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR;

// Resolver rutas posibles (realpath devuelve FALSE si no existe)
// Hay que cambiar header.php, footer.php y el resto de paginas a /pages.
// Los archivos .html que ya no se usen hay que elminarlos en algun momento que estemos los tres.
$hPhp = realpath($pagesDir . 'header.php');
$hHtml = realpath($pagesDir . 'header.html');
$fPhp = realpath($pagesDir . 'footer.php');
$fHtml = realpath($pagesDir . 'footer.html');

// Incluir header: preferir PHP, luego HTML, si no existe mostrar header por defecto.
if ($hPhp && file_exists($hPhp)) {
    include $hPhp;
} elseif ($hHtml && file_exists($hHtml)) {
    include $hHtml;
} else {
    // Header por defecto
    ?>
    <!doctype html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Página</title>
        <style>body{font-family:Arial,Helvetica,sans-serif;margin:0}header,footer{padding:1rem;text-align:center;background:#f5f5f5}main{padding:1rem}</style>
    </head>
    <body>
    <header><h1>Header</h1></header>
    <?php
}

// Contenido de ejemplo
?>

<main>
    <h2>Contenido principal</h2>
    <p>Contenido de temp.php.</p>
</main>

<?php
// Incluir footer: preferir PHP, luego HTML, si no existe mostrar footer por defecto.
if ($fPhp && file_exists($fPhp)) {
    include $fPhp;
} elseif ($fHtml && file_exists($fHtml)) {
    include $fHtml;
} else {
    ?>
    <footer><p>Footer &copy; <?= date('Y') ?></p></footer>
    </body>
    </html>
    <?php
}
