<?php

use App\model\User;

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