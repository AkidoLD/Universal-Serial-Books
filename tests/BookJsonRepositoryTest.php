<?php

require_once __DIR__."/../src/Core/Helpers.php";
require_once __DIR__."/../vendor/autoload.php";

use App\Repository\BookJsonRepository;
use Config\Paths;

$filePath = Paths::BOOK_JSON;

$repo = new BookJsonRepository($filePath);

// $books = require_once __DIR__."/../config/BooksList.php"; // For load fake books, uncomment this line


foreach($books as $book) $repo->add($book);


$data = $repo->getAll();

echo "<p>The repository contain ".$repo->count(). " books</p>";

echoBR();

$booktitle = "vie";

echo "<h3>Liste des livres dont le nom contient \"<strong>".$booktitle."\"</strong></h3>";


$foundBooks = $repo->findByTitle($booktitle);

foreach($foundBooks as $book) prettyPrint($book);

