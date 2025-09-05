<?php
require_once __DIR__."/../src/model/Person.php";
require_once __DIR__."/../src/model/Gender.php";

$birthDate = new DateTime("2000-05-15");
$person = new Person(
    name: "Alex",
    surname: "LD",
    birthDate: $birthDate,
    gender: Gender::MALE,
    height: 175
);

// Test des getters
echo "Name: " . $person->getName() . PHP_EOL;
echo "Surname: " . $person->getSurname() . PHP_EOL;
echo "Birthdate: " . $person->getBirthDate()?->format("Y-m-d") . PHP_EOL;
echo "Gender: " . $person->getGender()?->value . PHP_EOL;
echo "Height: " . $person->getHeight() . " cm" . PHP_EOL;

// Test de la methode getAge()
echo "Age: " . $person->getAge() . " years" . PHP_EOL;

// Test d'un setter
$person->setName("Akido");
echo "Updated name: " . $person->getName() . PHP_EOL;
