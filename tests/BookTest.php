<?php

use App\Enums\BookGender;
use App\Model\Person;
use App\Model\Book;

$title = 'Une nuit noir';
$author = new Person();
$publicationDate = new DateTime();

$book = new Book(
    null,
    $title,
    $author,
    BookGender::BIOGRAPHY,
    null,
    null,
    new DateTime('2021-02-1'),
    new DateTime(),
    null,
    12
);

echo $book;
