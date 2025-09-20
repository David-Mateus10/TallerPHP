<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <h1>Resultado</h1>
  <div class="resultado">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = intval($_POST["numero"]);
        $operacion = $_POST["operacion"];

        if ($numero < 0) {
            echo "Por favor, ingresa un número entero positivo.";
            exit;
        }

        if ($operacion == "factorial") {
            $resultado = 1;
            for ($i = 1; $i <= $numero; $i++) {
                $resultado *= $i;
            }
            echo "El factorial de $numero es: $resultado";
        } elseif ($operacion == "fibonacci") {
            $a = 0;
            $b = 1;
            echo "Sucesión de Fibonacci hasta $numero términos:<br>";
            for ($i = 0; $i < $numero; $i++) {
                echo "$a ";
                $siguiente = $a + $b;
                $a = $b;
                $b = $siguiente;
            }
        } else {
            echo "Operación no válida.";
        }
    } else {
        echo "No se enviaron datos.";
    }
    ?>
  </div>
  <br>
  <a href="index.html">⬅ Volver</a>
</body>
</html>
