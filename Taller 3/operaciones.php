<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado Estadistico</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Resultado Estadistico</h1>

        <div class="resultado">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $entrada = $_POST["numeros"];
                $numeros = array_map('trim', explode(",", $entrada));
                $validos = [];

                foreach ($numeros as $n) {
                    if (is_numeric($n)) {
                        $validos[] = floatval($n);
                    } else {
                        echo "<p class='error'>$n no es un número válido.</p>";
                    }
                }

                if (count($validos) > 0) {
                    sort($validos);

                    $promedio = array_sum($validos) / count($validos);

                    $count = count($validos);
                    if ($count % 2 == 0) {
                        $media = ($validos[$count/2 - 1] + $validos[$count/2]) / 2;
                    } else {
                        $media = $validos[floor($count/2)];
                    }


                    $stringNums = array_map('strval', $validos);
                    $frecuencias = array_count_values($stringNums);
                    $maxFrecuencia = max($frecuencias);
                    $modas = [];
                    foreach ($frecuencias as $num => $freq) {
                        if ($freq == $maxFrecuencia) {
                            $modas[] = $num;
                        }
                    }

                    echo "<p><strong>Números válidos:</strong> " . implode(", ", $validos) . "</p>";
                    echo "<p><strong>Promedio:</strong> $promedio</p>";
                    echo "<p><strong>Mediana:</strong> $media</p>";
                    echo "<p><strong>Moda:</strong> " . implode(", ", $modas) . "</p>";
                } else {
                    echo "<p class='error'>No se ingresaron números válidos.</p>";
                }
            } else {
                echo "<p class='error'>No se recibieron datos.</p>";
            }
        ?>
        </div>

        <div class="links">
            <a href="index.html">⬅ Volver al menú del Taller 2</a><br>
            <a href="../">⬅ Volver a la lista de talleres</a>
        </div>
    </div>
</body>
</html>
