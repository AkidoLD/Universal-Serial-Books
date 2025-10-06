<?php

require_once __DIR__."/../vendor/autoload.php";

use SimpleRoute\Router\Node;

$root = new Node('root', function() {echo "Hello word";});

$root->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Buenos dias senior</h1>
</body>
</html>
