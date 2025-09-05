<?php

use Enums\BookGender;

require_once __DIR__."/../src/model/Book.php";

$title = 'Une nuit noir';
$author = new Person();
$publicationDate = new DateTime('2010-04-09');
$page = 300;

$date = new DateTime();
$book = new Book(
    $title,
    $author,
    $publicationDate,
    null,
    300,
    BookGender::FANTASY,
);

echo $book;