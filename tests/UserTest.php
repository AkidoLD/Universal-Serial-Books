<?php

use Enums\Gender;

require_once __DIR__."/../src/model/User.php";

$date = new DateTime();

$user = new User(
    '1',
    'Wouagang',
    'Rayan',
    null,
    'alexrayan14231423@gmail.com',
    '0001',
    $date,
    null,
    null
);

echo $user;