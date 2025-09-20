<?php
function parseConjunto($input) {
    $numeros = explode(',', $input);
    $numeros = array_map('trim', $numeros);
    $numeros = array_map('intval', $numeros);
    return array_unique($numeros); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conjuntoA = parseConjunto($_POST["conjuntoA"]);
    $conjuntoB = parseConjunto($_POST["conjuntoB"]);

    $union = array_unique(array_merge($conjuntoA, $conjuntoB));

    $interseccion = array_values(array_intersect($conjuntoA, $conjuntoB));

    $diferenciaAB = array_values(array_diff($conjuntoA, $conjuntoB));
    $diferenciaBA = array_values(array_diff($conjuntoB, $conjuntoA));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Resultados</h1>

        <p><strong>Conjunto A:</strong> <?= implode(', ', $conjuntoA) ?></p>
        <p><strong>Conjunto B:</strong> <?= implode(', ', $conjuntoB) ?></p>

        <p><strong>Unión (A ∪ B):</strong> <?= implode(', ', $union) ?></p>
        <p><strong>Intersección (A ∩ B):</strong> <?= implode(', ', $interseccion) ?></p>
        <p><strong>Diferencia (A - B):</strong> <?= implode(', ', $diferenciaAB) ?></p>
        <p><strong>Diferencia (B - A):</strong> <?= implode(', ', $diferenciaBA) ?></p>

        <a href="index.html" style="display:block; margin-top:20px;">← Volver</a>
    </div>
</body>
</html>