<?php
function buildTree(array $order, array $in, bool $isPre = true): ?array {
    if (!$order || !$in) return null;

    $rootVal   = $isPre ? array_shift($order) : array_pop($order);
    $rootIndex = array_search($rootVal, $in, true);
    if ($rootIndex === false) {
        throw new RuntimeException("El valor '$rootVal' no se encuentra en el inorden.");
    }

    $leftIn   = array_slice($in, 0, $rootIndex);
    $rightIn  = array_slice($in, $rootIndex + 1);

    $leftOrder  = array_slice($order, 0, count($leftIn));
    $rightOrder = array_slice($order, count($leftIn));

    return [
        'valor' => $rootVal,
        'izq'   => buildTree($leftOrder,  $leftIn,  $isPre),
        'der'   => buildTree($rightOrder, $rightIn, $isPre)
    ];
}

function renderTree(?array $node): string {
    if (!$node) return '';
    $html  = "<ul role=\"tree\">";
    $html .= "<li role=\"treeitem\">" . htmlspecialchars($node['valor']) . "</li>";
    if ($node['izq'] || $node['der']) {
        $html .= renderTree($node['izq']);
        $html .= renderTree($node['der']);
    }
    $html .= "</ul>";
    return $html;
}

function validateConsistency(array $mainOrder, array $in): bool {
    sort($mainOrder);
    sort($in);
    return $mainOrder === $in;
}

function sanitizeInput(string $input): array {
    return array_values(array_filter(preg_split('/\s+/', trim($input)), 'strlen'));
}

$preorden  = !empty($_POST['preorden'])  ? sanitizeInput($_POST['preorden'])  : [];
$inorden   = !empty($_POST['inorden'])   ? sanitizeInput($_POST['inorden'])   : [];
$postorden = !empty($_POST['postorden']) ? sanitizeInput($_POST['postorden']) : [];

ob_start();

try {
    if ($preorden && $inorden) {
        if (!validateConsistency($preorden, $inorden)) {
            echo "⚠️ Los valores de Preorden e Inorden no coinciden exactamente.";
        } else {
            $tree = buildTree($preorden, $inorden, true);
            echo "<h2>Árbol reconstruido (Preorden + Inorden)</h2>";
            echo renderTree($tree);
        }
    } elseif ($postorden && $inorden) {
        if (!validateConsistency($postorden, $inorden)) {
            echo "⚠️ Los valores de Postorden e Inorden no coinciden exactamente.";
        } else {
            $tree = buildTree($postorden, $inorden, false);
            echo "<h2>Árbol reconstruido (Postorden + Inorden)</h2>";
            echo renderTree($tree);
        }
    } else {
        echo "⚠️ Debes ingresar <b>Inorden</b> y al menos uno de los otros recorridos (Preorden o Postorden).";
    }
} catch (RuntimeException $e) {
    echo "❌ Error al construir el árbol: " . htmlspecialchars($e->getMessage());
}

$resultado = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Resultado</h1>
        <div class="resultado">
            <?= $resultado ?>
        </div>
        <div class="links">
            <a href="index.html">⬅ Volver al menú del Taller 2</a><br>
            <a href="../">⬅ Volver a la lista de talleres</a>
        </div>
    </div>
</body>
</html>