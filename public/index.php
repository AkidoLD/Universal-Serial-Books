<?php

// require_once __DIR__."/../tests/PersonTest.php";
// require_once __DIR__."/../tests/BookTest.php";
// require_once __DIR__."/../tests/UserTest.php";

require __DIR__ . '/../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$uuid = Uuid::uuid4()->toString();
$uuid2 = Uuid::uuid4()->toString();

echo "Mon UUID : " . $uuid;
echo "Mon UUID2: ".$uuid2;
