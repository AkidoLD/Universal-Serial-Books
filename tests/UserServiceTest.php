<?php

use App\Model\User;
use App\Repository\UserJsonRepository;
use App\Services\UserService;
use Config\Paths;

$filePath = Paths::USER_JSON;

$repository = new UserJsonRepository($filePath);

$service = new UserService($repository);

$user = new User(
    'Steffan',
    '123@gmail.com',
    '245',
);

var_dump($service->getAllUsers());

// $service->addUser($user);

var_dump($users = $service->getAllUsers());

foreach($users as $user){
    echo $user;
}