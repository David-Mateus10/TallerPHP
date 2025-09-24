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