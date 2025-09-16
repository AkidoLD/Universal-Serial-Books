<?php

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../src/Core/Helpers.php";

use App\Enums\BookGender;
use App\Model\Book;
use App\Repository\BookJsonRepository;
use App\Services\BookService;
use Config\Paths;
use Ramsey\Uuid\Uuid;

$filePath = Paths::BOOK_JSON;

$repo = new BookJsonRepository($filePath);

$service = new BookService($repo);

//===== Test delete book ======//
$deleteBook = "32ddc142-a242-4c8f-82b5-1337c67cd210";

echo "La base de donnee a ".$service->bookCount()." livre enregistre";

echoBR();

//==== Test Book modification =======//

$title = 'Un jour blue';
$author = "Akira Toriyama";
$publicationDate = new DateTime();
$uuid = false ? "5f08eeab-d6a6-45cb-b86f-dd55dad0c4ea" : Uuid::uuid4()->toString();

$book = new Book(
    null,
    $title,
    $author,
    BookGender::BIOGRAPHY,
    null,
    null,
    new DateTime('2021-02-1'),
    new DateTime(),
    $uuid,
    12
);

$service->addBook($book);

//====== Test Find Book =======//

echo "Test de la recherche de livre : ";
echoBR();
//
echo "-> Find by ID"; 
echoBR();
$id = "670d797d-fa1c-41fa-a092-a3dea36a8e97";
$foundbook = $service->findBookById($id);

echo $foundbook ? "Le livre ".$foundbook->getTitle()." a ete trouve." : "Aucun film trouve";
echoBR();

if($foundbook) prettyPrint($foundbook);

//===== Test book modification

echo "Test de modification d'un livre";

if($foundbook){
    $newBook = clone $foundbook;
    $newBook->setAuthor('AkidoLD');
    $newBook->setTitle('La modification d\'un livre');
    $newBook->setIsbn("749d0ab5-62fe-4615-a8b3-ebad71398df3");
    $service->updateBook($newBook);
}

//======= End Test ========//
