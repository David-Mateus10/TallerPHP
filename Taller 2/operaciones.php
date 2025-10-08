<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <h1>Resultado</h1>
    <div class="resultado">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero = intval($_POST["numero"]);
            $operacion = $_POST["operacion"];

            if ($numero < 0) {
                echo "<p>⚠ Por favor, ingresa un número entero positivo.</p>";
            } else {
                if ($operacion == "factorial") {
                    $resultado = 1;
                    $serie = [];

                    for ($i = $numero; $i >= 1; $i--) {
                        $resultado *= $i;
                        $serie[] = $i;
                    }

                    $cadena = implode(" × ", $serie);
                    echo "<p><strong>Serie del factorial de $numero:</strong><br>$cadena = <strong>$resultado</strong></p>";

                } elseif ($operacion == "fibonacci") {
                    $a = 0;
                    $b = 1;
                    $serie = [];

                    for ($i = 0; $i < $numero; $i++) {
                        $serie[] = $a;
                        $siguiente = $a + $b;
                        $a = $b;
                        $b = $siguiente;
                    }

                    $cadena = implode(", ", $serie);
                    echo "<p><strong>Sucesión de Fibonacci de $numero términos:</strong><br>$cadena</p>";
                } else {
                    echo "<p>⚠ Operación no válida.</p>";
                }
            }
        } else {
            echo "<p>No se enviaron datos.</p>";
        }
        ?>
    </div>
    <div class="links">
        <a href="index.html">⬅ Volver al menú del Taller 2</a><br>
        <a href="../">⬅ Volver a la lista de talleres</a>
    </div>
</body>

</html>