<?php

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../src/Core/Helpers.php";

use App\Enums\Gender;
use App\Exceptions\ValidationException;
use App\Model\User;
use App\Repository\UserJsonRepository;
use App\Services\UserService;
use Config\Paths;
use Traversable;

//=========================
// CONFIGURATION TEST
//=========================
$filePath = Paths::USER_JSON;
$repository = new UserJsonRepository($filePath);
$service = new UserService($repository);

// Nombre d'utilisateurs à afficher pour preview
$displayLimit = 5;

//=========================
// VARIABLES POUR TESTS
//=========================
$testName      = 'Sonic';
$testEmail     = 'sonic@gmail.com';
$testPassword  = '0202';
$testSurname   = 'Romeo';
$testBirthDate = '1997-06-23';
$testGender    = Gender::MALE;
$testNickname  = 'Salopard';
$testHeight    = 1.79;

$searchName    = "an";
$findId        = "f63a986f-27e1-4051-8b69-816e336accce";
$findEmail     = "alexrayan@gmail.com";
$findName      = "Tchouameni";

//=========================
// ICONES ET COULEURS
//=========================
define('ICON_SUCCESS', '✅');
define('ICON_INFO', 'ℹ️');
define('ICON_ERROR', '❌');

//=========================
// TEST GET ALL USERS
//=========================
echo H3o.ICON_INFO." Get all users".H3c;
echo "The application contains ". $service->userCount() ." users".BR;

$users = $service->getAllUsers();
echo "Display first $displayLimit users:".BR;
echo "<ul>";
$i = 0;
foreach($users as $user){
    if($i++ >= $displayLimit) break;
    echo "<li>".$user->getName()."</li>";
}
echo "</ul>";
echo "End of section".BR;
echo "============================".BR;

//=========================
// TEST ADD USER
//=========================
echo H3o.ICON_INFO." Test adding a user".H3c;

$newUser = new User(
    null,
    $testName,
    $testEmail,
    password_hash($testPassword, PASSWORD_DEFAULT),
    $testSurname,
    new DateTime($testBirthDate),
    new DateTime(),
    $testGender,
    $testNickname,
    $testHeight
);

echo "Attempting to add user {$newUser->getName()}...".BR;

try {
    $service->addUser($newUser);
    echo ICON_SUCCESS." User added successfully!".BR;
    prettyPrint($newUser);
} catch (ValidationException $e) {
    echo ICON_ERROR." Error adding user: ".$e->getMessage().BR;
}

echo "End of section".BR;
echo "===============================".BR;

//=========================
// TEST UPDATE USER
//=========================
echo H3o.ICON_INFO." Test updating a user".H3c;

$updateName = "Mahoraga";
$updateEmail = "makora.general@gmail.com";
//
$updateUser = clone $newUser;
$updateUser->setGender(Gender::FEMALE);
$updateUser->setName($updateName);
$updateUser->setEmail($updateEmail);

echo "Attempting to update user info...".BR;

try {
    $service->updateUser($updateUser);
    echo ICON_SUCCESS." User updated successfully.".BR;
    prettyPrint($updateUser);
} catch (ValidationException $e) {
    echo ICON_ERROR." Error updating user: ".$e->getMessage().BR;
}

echo "End of section".BR;
echo "===============================".BR;

//=========================
// TEST DELETE USER
//=========================

echo H3o.ICON_INFO."Test deleting a user".H3c;

$deleteuserId = $newUser->getId();

echo "Attemping to delete user {$testName}";
try{
    $service->deleteUserById($deleteuserId);
    echo ICON_SUCCESS."User {$testName} deleted sussessfully".BR;
}catch(ValidationException $e){
    echo ICON_ERROR."Error deleting user : ".$e->getMessage().BR;
}

echo "End of section".BR;
echo "===============================".BR;

//=========================
// TEST SEARCH USERS BY NAME
//=========================
echo H3o.ICON_INFO." Test searching users by name".H3c;

$foundUsers = $service->searchUsersByName($searchName);

if(isEmptyTraversable($foundUsers)) {
    echo ICON_ERROR." No users found with name '{$searchName}'".BR;
} else {
    echo ICON_SUCCESS." Users found:".BR;
    echo "<ul>";
    foreach($foundUsers as $user) {
        echo "<li>".$user->getName()."</li>";
    }
    echo "</ul>";
}

echo "End of section".BR;
echo "==============================".BR;

//=========================
// TEST FIND USER
//=========================
echo H3o.ICON_INFO." Test finding users".H3c;

// By ID
$foundUser = $service->findUserById($findId);
if(!$foundUser) echo ICON_ERROR." User with ID {$findId} not found".BR;
else {
    echo ICON_SUCCESS." User found by ID: ".BR;
    prettyPrint($foundUser);
}

// By Email
$foundUser = $service->findUserByEmail($findEmail);
if(!$foundUser) echo ICON_ERROR." User with email {$findEmail} not found".BR;
else {
    echo ICON_SUCCESS." User found by email: ".BR;
    prettyPrint($foundUser);
}

// By Name
$foundUser = $service->findUsersByName($findName);
if(!$foundUser) echo ICON_ERROR." No users found with name {$findName}".BR;
else {
    echo ICON_SUCCESS." Users found by name: ".BR;
    prettyPrint($foundUser);
}

echo "End of section".BR;
echo "==============================".BR;
