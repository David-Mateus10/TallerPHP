<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["a"];
    $b = $_POST["b"];

    if (!is_numeric($a) || !is_numeric($b)) {
        $mensaje = "Debe ingresar solo números.";
    } elseif (intval($a) != $a || intval($b) != $b) {

        if (intval($a) != $a && intval($b) != $b) {
            $mensaje = "Los números $a y $b no son enteros.";
        } elseif (intval($a) != $a) {
            $mensaje = "El número $a no es entero.";
        } else {
            $mensaje = "El número $b no es entero.";
        }
    } elseif ($a <= 0 || $b <= 0) {

        if ($a <= 0 && $b <= 0) {
            $mensaje = "Los números $a y $b no son enteros positivos.";
        } elseif ($a <= 0) {
            $mensaje = "El número $a no es entero positivo.";
        } else {
            $mensaje = "El número $b no es entero positivo.";
        }
    } else {

        if ($a % $b == 0) {
            $mensaje = "El número $a es divisible entre el número $b.";
        } else {
            $mensaje = "El número $a no es divisible entre el número $b.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="container">
        <h1>Resultado</h1>
        <div class="resultado">
            <?= $mensaje ?>
        </div>
        <div class="links">
            <a href="index.html">⬅ Volver al menú del Taller 2</a><br>
            <a href="../">⬅ Volver a la lista de talleres</a>
        </div>
    </div>
</body>

</html>