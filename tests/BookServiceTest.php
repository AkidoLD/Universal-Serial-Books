<?php

use App\Model\Book;
use App\Repository\BookJsonRepository;
use App\Services\BookService;
use Config\Paths;
use App\Model\Person;
use App\Enums\BookGender;

$filePath = Paths::BOOK_JSON;

$repo = new BookJsonRepository($filePath);

$service = new BookService($repo);

// $books = $service->getAllBooks();

// foreach($books as $book){
//     $service->addBook($book);
// }


$deleteBook = "1bb6c619-76c4-4dd0-91d1-4a1f07c1d11b";

$service->deleteBookById($deleteBook);

foreach($service->getAllBooks() as $book) echo $book;