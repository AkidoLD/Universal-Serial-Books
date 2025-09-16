<?php

require_once __DIR__."/../vendor/autoload.php";

use App\Enums\Gender;
use App\Model\User;

$date = new DateTime();

$user = new User(
    null,
    "Wouagang Alex",
    'alexrayan@gmail.com',
    password_hash('asd', PASSWORD_DEFAULT),
    'Rayan',
    new DateTime('2004-02-03'),
    new DateTime(),
    Gender::MALE,
    'AkidoLD',
    1.14,
);

echo $user;