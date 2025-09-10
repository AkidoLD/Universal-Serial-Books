<?php

use App\Model\User;

$date = new DateTime();

$user = new User(
    name: 'Wouagang',
    surname: 'Rayan',
    pseudo: null,
    email: 'alexrayan14231423@gmail.com',
    password: '0001',
    birthDate: $date,
    gender: null,
    height: null
);

echo $user;