<?php

require_once __DIR__."/../vendor/autoload.php";

use App\Enums\Gender;
use App\model\Person;

$birthDate = new DateTime("2000-05-15");
$person = new Person(
    name: "Alex",
    surname: "LD",
    birthDate: $birthDate,
    gender: Gender::MALE,
    height: null
);


echo $person;
