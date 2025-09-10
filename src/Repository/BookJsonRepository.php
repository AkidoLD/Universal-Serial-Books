<?php

namespace App\Repository;

use App\Model\Book;
use App\Model\Person;
use App\Enums\BookGender;

/**
 * JSON-based implementation of the BookRepositoryInterface.
 *
 * This repository manages Book objects stored in a JSON file.
 * All keys are based on the constants defined in the Book class,
 * ensuring maintainability and avoiding hardcoded strings.
 */
class BookJsonRepository implements BookRepositoryInterface {

    /**
     * @var string Path to the JSON file storing books
     */
    private string $filePath;

    /**
     * Constructor
     *
     * @param string $filePath Path to the JSON file
     */
    public function __construct(string $filePath) {
        $this->filePath = $filePath;

        // Create file if it does not exist
        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode([]));
        }
    }

    /**
     * Load all books from the JSON file
     *
     * @return array<int, array> Raw associative array of books
     */
    private function loadData(): array {
        $json = file_get_contents($this->filePath);
        $data = json_decode($json, true);
        return is_array($data) ? $data : [];
    }

    /**
     * Save the raw array of books to JSON file
     *
     * @param array<int, array> $data
     * @return void
     */
    private function saveData(array $data): void {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(): ?\Traversable {
        $data = $this->loadData();

        foreach ($data as $item) {
            yield $this->createBookFromArray($item);
        }
    }

    /**
     * Create a Book object from a raw associative array
     *
     * @param array $item
     * @return Book
     */
    private function createBookFromArray(array $item): Book {
        return new Book(
            $item[Book::KEY_ID] ?? null,
            $item[Book::KEY_TITLE] ?? '',
            isset($item[Book::KEY_AUTHOR]) ? new Person($item[Book::KEY_AUTHOR]) : null,
            isset($item[Book::KEY_PUBLICATION_DATE]) ? new \DateTime($item[Book::KEY_PUBLICATION_DATE]) : null,
            $item[Book::KEY_ISBN] ?? null,
            $item[Book::KEY_PAGES] ?? null,
            isset($item[Book::KEY_GENRE]) ? BookGender::from($item[Book::KEY_GENRE]) : null,
            $item[Book::KEY_COVER] ?? null
        );
    }

    /**
     * {@inheritdoc}
     */
    public function add(Book $book): bool {
        $data = $this->loadData();

        // Prevent duplicate by ID
        foreach ($data as $item) {
            if ($item[Book::KEY_ID] === $book->getId()) {
                return false;
            }
        }

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
                return $this->createBookFromArray($item);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function findByTitle(string $title): ?\Traversable {
        $matches = [];
        foreach ($this->loadData() as $item) {
            if (stripos($item[Book::KEY_TITLE] ?? '', $title) !== false) {
                $matches[] = $this->createBookFromArray($item);
            }
        }
        return $matches ? new \ArrayIterator($matches) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function existByIsbn(string $isbn): bool {
        return $this->findByIsbn($isbn) !== null;
    }
}
