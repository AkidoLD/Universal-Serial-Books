<?php

require_once __DIR__."/../vendor/autoload.php";

use App\Repository\UserJsonRepository;
use App\Services\UserService;
use Config\Paths;

$filePath = Paths::USER_JSON;

$repository = new UserJsonRepository($filePath);

$service = new UserService($repository);


$users = $service->getAllUsers();

foreach($users as $user){
    echo $user;
}