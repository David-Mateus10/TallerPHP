<?php
function parseConjunto($input)
{
    $numeros = explode(',', $input);
    $numeros = array_map('trim', $numeros);
    $numeros = array_filter($numeros, 'is_numeric'); // solo números válidos
    $numeros = array_map('intval', $numeros);
    return array_unique($numeros);
}

$conjuntoA = $conjuntoB = $union = $interseccion = $diferenciaAB = $diferenciaBA = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conjuntoA = parseConjunto($_POST["conjuntoA"]);
    $conjuntoB = parseConjunto($_POST["conjuntoB"]);

    // Operaciones
    $union = array_unique(array_merge($conjuntoA, $conjuntoB));
    sort($union);

    $interseccion = array_values(array_intersect($conjuntoA, $conjuntoB));
    sort($interseccion);

    $diferenciaAB = array_values(array_diff($conjuntoA, $conjuntoB));
    $diferenciaBA = array_values(array_diff($conjuntoB, $conjuntoA));
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <h1>Resultados</h1>

        <?php if (!empty($conjuntoA) || !empty($conjuntoB)) : ?>
            <div class="resultado">
                <p><strong>Conjunto A:</strong> <?= !empty($conjuntoA) ? implode(', ', $conjuntoA) : "∅" ?></p>
                <p><strong>Conjunto B:</strong> <?= !empty($conjuntoB) ? implode(', ', $conjuntoB) : "∅" ?></p>

                <p><strong>Unión (A ∪ B):</strong> <?= !empty($union) ? implode(', ', $union) : "∅" ?></p>
                <p><strong>Intersección (A ∩ B):</strong> <?= !empty($interseccion) ? implode(', ', $interseccion) : "∅" ?></p>
                <p><strong>Diferencia (A - B):</strong> <?= !empty($diferenciaAB) ? implode(', ', $diferenciaAB) : "∅" ?></p>
                <p><strong>Diferencia (B - A):</strong> <?= !empty($diferenciaBA) ? implode(', ', $diferenciaBA) : "∅" ?></p>
            </div>
        <?php else : ?>
            <p class="error"> No se ingresaron datos válidos.</p>
        <?php endif; ?>
    </div>

    <div class="links">
        <a href="index.html">⬅ Volver al menú del Taller 2</a><br>
        <a href="../">⬅ Volver a la lista de talleres</a>
    </div>
</body>

</html>
