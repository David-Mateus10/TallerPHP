<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Pares e Impares</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="container">
        <h1>Resultado de los números pares e impares</h1>

        <div class="resultado">
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $entrada = $_POST["numeros"];
                $numeros = explode(",", $entrada);

                foreach ($numeros as $num) {
                    $num = trim($num);
                    if (is_numeric($num) && intval($num) == $num) {
                        if ($num % 2 == 0) {
                            echo "<p class='par'>$num es número par</p>";
                        } else {
                            echo "<p class='impar'>$num es número impar</p>";
                        }
                    } else {
                        echo "<p class='error'>$num no es un número entero</p>";
                    }
                }
            } else {
                echo "<p class='error'>No se recibieron datos.</p>";
            }
            ?>
        </div>

        <footer class="acciones">
            <a href="index.html">← Volver al menú del Taller 2</a>
            <a href="../index.html">← Volver a la lista de talleres</a>
        </footer>
    </div>
</body>

</html>
