<?php

namespace App\Repository;

use App\Model\Book;
use App\Exceptions\RepositoryException;
use App\Interfaces\BookRepositoryInterface;
use Traversable;

/**
 * JSON-based implementation of the BookRepositoryInterface.
 *
 * This repository manages Book objects stored in a JSON file.
 * All keys are based on the constants defined in the Book class,
 * ensuring maintainability and avoiding hardcoded strings.
 */
class BookJsonRepository extends JsonRepository implements BookRepositoryInterface {

    /**
     * Constructor
     *
     * @param string $filePath Path to the JSON file
     */
    public function __construct(string $filePath) {
        parent::__construct($filePath);
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(): ?Traversable {
        $data = $this->loadData();
        foreach ($data as $item) {
            yield Book::fromArray($item);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function add(Book $book): bool {
        // Prevent duplicate by ID
        if($this->existById($book)){
            throw new RepositoryException('The book id already exist in the database');
        }
        
        $data = $this->loadData();
        $data[] = $book->toArray();
        $this->saveData($data);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function update(Book $book): bool {
        $data = $this->loadData();
        foreach ($data as $index => $item) {
            if ($item[Book::KEY_ID] === $book->getId()) {
                $data[$index] = $book->toArray();
                $this->saveData($data);
                return true;
            }
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $id): bool {
        $data = $this->loadData();
        foreach ($data as $index => $item) {
            if ($item[Book::KEY_ID] === $id) {
                unset($data[$index]);
                $this->saveData(array_values($data));
                return true;
            }
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int {
        return count($this->loadData());
    }

    /**
     * {@inheritdoc}
     */
    public function findByIsbn(string $isbn): ?Book {
        foreach ($this->loadData() as $item) {
            if (($item[Book::KEY_ISBN] ?? null) === $isbn) {
                return Book::fromArray($item);
            }
        }
        return null;
    }

    public function findById(string $id): ?Book{
        foreach ($this->loadData() as $item) {
            if (($item[Book::KEY_ID] ?? null) === $id) {
                return Book::fromArray($item);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function findByTitle(string $title): Traversable {
        $matches = [];
        foreach ($this->loadData() as $item) {
            if (stripos($item[Book::KEY_TITLE] ?? '', $title) !== false) {
                yield Book::fromArray($item);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function existByIsbn(string $isbn): bool {
        return $this->findByIsbn($isbn) !== null;
    }

    public function existById(string $id): bool{
        return $this->findById($id) !== null;
    }

    public function refreshData(){
        $books = $this->getAll();
        $data = [];
        foreach($books as $book){
            $data[] = $book->toArray();
        }
        $this->saveData($data);
    }
}
