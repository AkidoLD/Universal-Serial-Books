<?php

namespace App\Services;

use App\Interfaces\BookRepositoryInterface;
use App\Model\Book;
use App\Exceptions\ValidationException;
use Traversable;

class BookService {
    private BookRepositoryInterface $repository;

    public function __construct(BookRepositoryInterface $repository){
        $this->repository = $repository;
    }

    /**
     * Retrieve all books.
     *
     * @return Traversable A collection of Book objects
     */
    public function getAllBooks(): Traversable {
        return $this->repository->getAll();
    }

    /**
     * Find a book by its ID.
     *
     * @param string $id
     * @return Book|null
     */
    public function findBookById(string $id): ?Book {
        return $this->repository->findById($id);
    }

    /**
     * Find a book by its title
     * 
     * @param string $title
     * @return Book|null
     */
    public function findBookByTitle(string $title): ?Book{
        return $this->repository->findByTitle($title);
    }

    /**
     * Search a books by their title
     * 
     * @param string $title
     * @return Traversable<int|string, Book>
     */
    public function searchBookByTitle(string $title): Traversable{
        return $this->repository->searchByTitle($title);
    }

    /**
     * Count all books.
     *
     * @return int
     */
    public function bookCount(): int {
        return $this->repository->count();
    }

    /**
     * Add a new book.
     *
     * @param Book $book
     * @throws ValidationException If the book data is invalid or ISBN/title already exists
     */
    public function addBook(Book $book): void {
        // Validate book data
        $this->validateBook($book);

        // Attempt to add book to repository
        try {
            $this->repository->add($book);
        } catch (\Exception $e) {
            throw new ValidationException("Failed to add book: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Update an existing book.
     *
     * @param Book $book
     * @throws ValidationException If the book does not exist or data is invalid
     */
    public function updateBook(Book $book): void {
        // Ensure the book exists
        if (!$this->repository->existById($book->getId())) {
            throw new ValidationException("Cannot update: book does not exist");
        }

        // Validate book data
        $this->validateBook($book);

        // Attempt to update book in repository
        try {
            $this->repository->update($book);
        } catch (\Exception $e) {
            throw new ValidationException("Failed to update book: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Delete a book by ID.
     *
     * @param string $bookId
     * @throws ValidationException If the book does not exist
     */
    public function deleteBookById(string $bookId): void {
        if (!$this->repository->existById($bookId)) {
            throw new ValidationException("Book not found: cannot delete");
        }
        $this->repository->delete($bookId);
    }

    /**
     * Validate book data.
     *
     * @param Book $book
     * @throws ValidationException
     */
    private function validateBook(Book $book): void {
        if (empty($book->getTitle())) {
            throw new ValidationException("Book title cannot be empty");
        }
        //Get old book information if already existe in the repository
        $oldBookData = $this->repository->findById($book->getId());

        //Verify information
        if ($this->repository->existByIsbn($book->getIsbn()) && 
            (!$oldBookData || $oldBookData->getIsbn() !== $book->getIsbn())) {
            throw new ValidationException("The ISBN is already used for another book");
        }

        if($this->repository->existByTitle($book->getTitle()) &&
            (!$oldBookData || $oldBookData->getId() !== $book->getTitle())){
            throw new ValidationException("The title is already used for another book");
        }
    }
}
