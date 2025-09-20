<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado Ejercicio 2</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Resultado - Ejercicio 2</h1>

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
                    echo "$n no es un número válido<br>";
                }
            }

            if (count($validos) > 0) {
                sort($validos);

                // Promedio
                $promedio = array_sum($validos) / count($validos);

                // Mediana
                $count = count($validos);
                if ($count % 2 == 0) {
                    $media = ($validos[$count/2 - 1] + $validos[$count/2]) / 2;
                } else {
                    $media = $validos[floor($count/2)];
                }

                // Moda (convertimos a string para array_count_values)
                $stringNums = array_map('strval', $validos);
                $frecuencias = array_count_values($stringNums);
                $maxFrecuencia = max($frecuencias);
                $modas = [];
                foreach ($frecuencias as $num => $freq) {
                    if ($freq == $maxFrecuencia) {
                        $modas[] = $num;
                    }
                }

                echo "Números válidos: " . implode(", ", $validos) . "<br><br>";
                echo "Promedio: " . $promedio . "<br>";
                echo "Mediana: " . $media . "<br>";
                echo "Moda: " . implode(", ", $modas) . "<br>";
            } else {
                echo "No se ingresaron números válidos.";
            }
        } else {
            echo "No se recibieron datos.";
        }
    ?>
    </div>

    <br>
    <a href="index.html">⬅ Volver al menú del Taller 2</a>
    <br>
    <a href="../">⬅ Volver a la lista de talleres</a>
</body>
</html>
