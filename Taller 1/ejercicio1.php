<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado Ejercicio 1</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Resultado - Ejercicio 1</h1>

    <div class="resultado">
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $entrada = $_POST["numeros"];
            $numeros = explode(",", $entrada);

            foreach ($numeros as $num) {
                $num = trim($num);

                if (is_numeric($num) && intval($num) == $num) {
                    if ($num % 2 == 0) {
                        echo "$num es número par<br>";
                    } else {
                        echo "$num es número impar<br>";
                    }
                } else {
                    echo "$num no es un número entero<br>";
                }
            }
        } else {
            echo "No se recibieron datos.";
        }
    ?>
    </div>

    <br>
    <a href="index.html">⬅ Volver al menú del Taller 1</a>
    <br>
    <a href="../">⬅ Volver a la lista de talleres</a>
</body>
</html>

