<?php
function buildTreePreIn($pre, $in) {
    if (empty($pre) || empty($in)) return null;

    $rootVal = array_shift($pre);
    $rootIndex = array_search($rootVal, $in);

    $leftIn = array_slice($in, 0, $rootIndex);
    $rightIn = array_slice($in, $rootIndex + 1);

    $leftPre = array_slice($pre, 0, count($leftIn));
    $rightPre = array_slice($pre, count($leftIn));

    return [
        "valor" => $rootVal,
        "izq" => buildTreePreIn($leftPre, $leftIn),
        "der" => buildTreePreIn($rightPre, $rightIn)
    ];
}

function buildTreePostIn($post, $in) {
    if (empty($post) || empty($in)) return null;

    $rootVal = array_pop($post);
    $rootIndex = array_search($rootVal, $in);

    $leftIn = array_slice($in, 0, $rootIndex);
    $rightIn = array_slice($in, $rootIndex + 1);

    $leftPost = array_slice($post, 0, count($leftIn));
    $rightPost = array_slice($post, count($leftIn));

    return [
        "valor" => $rootVal,
        "izq" => buildTreePostIn($leftPost, $leftIn),
        "der" => buildTreePostIn($rightPost, $rightIn)
    ];
}

function printTree($node) {
    if (!$node) return;
    echo "<ul>";
    echo "<li>" . $node["valor"];
    if ($node["izq"] || $node["der"]) {
        printTree($node["izq"]);
        printTree($node["der"]);
    }
    echo "</li>";
    echo "</ul>";
}

$preorden = !empty($_POST['preorden']) ? explode(" ", trim($_POST['preorden'])) : [];
$inorden = !empty($_POST['inorden']) ? explode(" ", trim($_POST['inorden'])) : [];
$postorden = !empty($_POST['postorden']) ? explode(" ", trim($_POST['postorden'])) : [];

echo "<h2>Árbol Reconstruido</h2>";

if (!empty($preorden) && !empty($inorden)) {
    $tree = buildTreePreIn($preorden, $inorden);
    printTree($tree);
} elseif (!empty($postorden) && !empty($inorden)) {
    $tree = buildTreePostIn($postorden, $inorden);
    printTree($tree);
} else {
    echo "⚠️ Debes ingresar <b>Inorden</b> y al menos uno de los otros recorridos (Preorden o Postorden).";
}
?>
