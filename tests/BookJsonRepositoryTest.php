<?php

require_once __DIR__."/../src/Core/Helpers.php";
use App\Model\Book;
use App\Repository\BookJsonRepository;
use Config\Paths;

$filePath = Paths::BOOK_JSON;

$repo = new BookJsonRepository($filePath);
$book = new Book(
    null,
    'Akido',
    'Alex',
    null,
);

$repo->refreshData();

$data = $repo->getAll();


$bookID = "f3d97653-82db-4496-8076-8a2af36fdf3a";

$booktitle = "La nuit";

echo $repo->count();

echoBR();

echo $repo->existById($bookID);

$found = $repo->findByTitle($booktitle) ?? [];

prettyPrint ($repo->findById($bookID) ?? "N\A");

foreach($data as $book) {
    // echo "<pre>";
    // var_dump($book);
    // echo "</pre>";
    prettyPrint(($book));
}
