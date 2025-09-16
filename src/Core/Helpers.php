<?php

function echoBR(){
    echo "<br>";
}

/**
 * HTML <br> balise
 */
define('BR', "<br>");
define('H3o', '<h3>');
define('H3c', '</h3>');
function prettyPrint(string $value){
    echo "<pre>".$value."</pre>";
}

/**
 * Checks if a Traversable collection is empty.
 *
 * @param Traversable $traversable The collection to check.
 * @return bool True if empty, false otherwise.
 */
function isEmptyTraversable(Traversable $traversable): bool{
    foreach ($traversable as $item) return false;
    return true;
}