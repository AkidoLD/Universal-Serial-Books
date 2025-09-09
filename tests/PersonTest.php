<?php

use App\model\Person;

$birthDate = new DateTime("2000-05-15");
$person = new Person(
    name: "Alex",
    surname: "LD",
    birthDate: $birthDate,
    gender: null,
    height: null
);

print($person);

// Test des getters
echo "Name: " . $person->getName() . PHP_EOL;

// Test de la methode getAge()
echo "Age: " . $person->getAge() . " years" . PHP_EOL;

// Test d'un setter
$person->setName("Akido");
echo "Updated name: " . $person->getName() . PHP_EOL;
