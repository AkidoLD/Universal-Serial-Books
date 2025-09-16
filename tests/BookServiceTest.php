<?php

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../src/Core/Helpers.php";

use App\Enums\BookGender;
use App\Exceptions\ValidationException;
use App\Model\Book;
use App\Repository\BookJsonRepository;
use App\Services\BookService;
use Config\Paths;
use Ramsey\Uuid\Uuid;

//=========================
// CONFIGURATION TEST
//=========================
$filePath = Paths::BOOK_JSON;
$repository = new BookJsonRepository($filePath);
$service    = new BookService($repository);
$displayLimit = 5;

//=========================
// VARIABLES POUR TESTS
//=========================
// Ajout d’un livre
$testTitle       = 'Un jour bleu';
$testAuthor      = 'Akira Toriyama';
$testGender      = BookGender::BIOGRAPHY;
$testIsbn        = Uuid::uuid4()->toString();
$testPageCount   = 300;
$testPubDate     = new DateTime('2021-02-01');

// Mise à jour du livre
$updateTitle     = "La modification d'un livre";
$updateAuthor    = "AkidoLD";
$updateIsbn      = Uuid::uuid4()->toString();

// Recherche
$searchTitle     = "La";
$findId          = "5fceb8cc-aaef-4a56-a113-a916aa99a7c8";
$findTitle       = "Le pays des enfants";

//=========================
// ICONES ET COULEURS
//=========================
define('ICON_SUCCESS', '✅');
define('ICON_INFO', 'ℹ️');
define('ICON_ERROR', '❌');

//=========================
// TEST GET ALL BOOKS
//=========================
echo H3o.ICON_INFO." Get all books".H3c;
echo "The application contains ". $service->bookCount() ." books".BR;

$books = $service->getAllBooks();
echo "Display first $displayLimit books:".BR;
echo "<ul>";
$i = 0;
foreach($books as $book){
    if($i++ >= $displayLimit) break;
    echo "<li>".$book->getTitle()."</li>";
}
echo "</ul>";
echo "End of section".BR;
echo "============================".BR;

//=========================
// TEST ADD BOOK
//=========================
echo H3o.ICON_INFO." Test adding a book".H3c;

$newBook = new Book(
    null,
    $testTitle,
    $testAuthor,
    $testGender,
    null,
    null,
    $testPubDate,
    new DateTime(),
    $testIsbn,
    $testPageCount
);

try {
    $service->addBook($newBook);
    echo ICON_SUCCESS." Book '{$newBook->getTitle()}' added successfully!".BR;
    prettyPrint($newBook);
} catch (ValidationException $e) {
    echo ICON_ERROR." Error adding book: ".$e->getMessage().BR;
}

echo "===============================".BR;

//=========================
// TEST UPDATE BOOK
//=========================
echo H3o.ICON_INFO." Test updating a book".H3c;

$updateBook = clone $newBook;
$updateBook->setAuthor($updateAuthor);
$updateBook->setTitle($updateTitle);
$updateBook->setIsbn($updateIsbn);

try {
    $service->updateBook($updateBook);
    echo ICON_SUCCESS." Book updated successfully.".BR;
    prettyPrint($updateBook);
} catch (ValidationException $e) {
    echo ICON_ERROR." Error updating book: ".$e->getMessage().BR;
}
echo "===============================".BR;

//=========================
// TEST DELETE BOOK
//=========================
echo H3o.ICON_INFO." Test deleting a book".H3c;

$deleteId = $newBook->getId();
try {
    $service->deleteBookById($deleteId);
    echo ICON_SUCCESS." Book '{$newBook->getTitle()}' deleted successfully".BR;
} catch (ValidationException $e) {
    echo ICON_ERROR." Error deleting book: ".$e->getMessage().BR;
}
echo "===============================".BR;

//=========================
// TEST SEARCH BOOKS BY TITLE
//=========================
echo H3o.ICON_INFO." Test searching books by title".H3c;

$foundBooks = $service->searchBooksByTitle($searchTitle);
if(isEmptyTraversable($foundBooks)) {
    echo ICON_ERROR." No books found with title containing '{$searchTitle}'".BR;
} else {
    echo ICON_SUCCESS." Books found:".BR;
    echo "<ul>";
    foreach($foundBooks as $book) {
        echo "<li>".$book->getTitle()."</li>";
    }
    echo "</ul>";
}
echo "==============================".BR;

//=========================
// TEST FIND BOOK
//=========================
echo H3o.ICON_INFO." Test finding books".H3c;

// By ID
$foundBook = $service->findBookById($findId);
if(!$foundBook) echo ICON_ERROR." Book with ID {$findId} not found".BR;
else {
    echo ICON_SUCCESS." Book found by ID: ".BR;
    prettyPrint($foundBook);
}

// By Title
$foundBook = $service->findBookByTitle($findTitle);
if(!$foundBook) echo ICON_ERROR." No books found with title '{$findTitle}'".BR;
else {
    echo ICON_SUCCESS." Books found by title: ".BR;
    prettyPrint($foundBook);
}
echo "==============================".BR;
