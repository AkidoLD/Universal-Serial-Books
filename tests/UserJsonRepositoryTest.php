<?php

require_once __DIR__."/../src/Core/Helpers.php";

use App\Repository\UserJsonRepository;
use Config\Paths;


// $usersList = require_once __DIR__."/../config/UsersList.php"; //Remove the comment to load Users. Don't forget to comment it after 🥲

$userRepo = new UserJsonRepository(Paths::USER_JSON);


//Try to add users in the repository
try {
    if(!$userRepo->count()){
        foreach($usersList as $user){
            $userRepo->add($user);
        }
    }
}catch(Exception $e){
    echo $e->getMessage();
}

$userRepo->refreshData();

$needle = "M";

echo "<h3>Found User with name contain <span style='color: red'>".$needle."</span></h3>";

$data = $userRepo->findByUsername($needle);

foreach($data as $user) prettyPrint($user);