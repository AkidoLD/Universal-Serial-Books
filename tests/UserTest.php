<?php

use App\Model\User;

$date = new DateTime();

$user = new User(
    name: 'Wouagang',
    surname: 'Rayan',
    email: 'alexrayan14231423@gmail.com',
    password: '0001'
);


echo $user;