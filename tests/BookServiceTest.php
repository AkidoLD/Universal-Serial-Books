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

foreach($books as $book){
    $service->addBook($book);
}

$data = $service->getAllBooks();

foreach($data as $book) echo $book;


