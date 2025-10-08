<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST["texto"] ?? '';
    $busqueda = $_POST["busqueda"] ?? '';

    $textoSeguro = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    $busquedaSeguro = htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8');

    if (!empty($textoSeguro) && !empty($busquedaSeguro)) {
        if (preg_match("/" . preg_quote($busquedaSeguro, '/') . "/i", $textoSeguro)) {
            $resultado = preg_replace(
                "/" . preg_quote($busquedaSeguro, '/') . "/i",
                "<span class='highlight'>$0</span>",
                $textoSeguro
            );
        } else {
            $resultado = null;
        }
    } else {
        $resultado = null;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Búsqueda</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <h1>Resultado de la búsqueda</h1>

        <?php if (!empty($resultado)) { ?>
            <div class="resultado"><?= $resultado ?></div>
        <?php } else { ?>
            <div class="resultado">No se encontraron coincidencias.</div>
        <?php } ?>

        <div class="links">
            <a href="index.html">⬅ Volver al Buscador</a>
            <a href="../"> Volver a la lista de talleres</a>
        </div>
    </div>
</body>
</html>
