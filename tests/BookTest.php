<?php

use App\Enums\BookGender;
use App\Model\Person;
use App\Model\Book;

$title = 'Une nuit noir';
$author = new Person();
$publicationDate = new DateTime();
$pages = 300;

$book = new Book(
    title: $title,
    author: $author,
    publicationDate: $publicationDate,
    pages: $pages,
    genre: BookGender::FANTASY
);

echo $book;
