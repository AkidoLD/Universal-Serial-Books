<?php

namespace App\Interfaces;

use App\Model\Book;
use Traversable;

/**
 * Interface for a repository that manages Book objects.
 * 
 * This interface defines the contract for any Book repository implementation,
 * whether the data is stored in SQL, JSON, or another storage system.
 * It ensures consistent methods to interact with books.
 */
interface BookRepositoryInterface {

    /**
     * Retrieve all books from the repository.
     *
     * @return Traversable<Book> A collection of Book objects
     */
    public function getAll(): Traversable;

    /**
     * Delete a book from the repository.
     *
     * @param string $id The unique identifier of the book
     * @return bool True on success, false on failure
     */
    public function delete(string $id): bool;

    /**
     * Add a new book to the repository.
     *
     * @param Book $book The Book object to add
     * @return bool True on success, false on failure
     */
    public function add(Book $book): bool;

    /**
     * Update an existing book in the repository.
     *
     * @param Book $book The Book object with updated data
     * @return bool True on success, false on failure
     */
    public function update(Book $book): bool;

    /**
     * Count the total number of books in the repository.
     *
     * @return int Number of books
     */
    public function count(): int;

    /**
     * Find a book by its ID
     * 
     * @param string $id
     * @return Book|null
     */
    public function findById(string $id): ?Book;

    /**
     * Find a book by its ISBN (unique code for books).
     *
     * @param string $isbn The ISBN code
     * @return Book|null The matching Book object, or null if not found
     */
    public function findByIsbn(string $isbn): ?Book;

    /**
     * Find a book by its title.
     * 
     * This method uses a strict comparison to search for a book
     *      with exactly the same title as the given parameter.
     *
     * @param string $title The exact title of the book
     * @return ?Book The matching book, or null if none found
     */
    public function findByTitle(string $title): ?Book;


    /**
     * Search books by their title.
     * 
     * This method performs a partial (case-insensitive) search on the title string
     *      and returns all books that contain the given substring.
     * 
     * @param string $title The substring to search for in the book titles
     * @return Traversable<Book> A list of books whose titles match the search
     */
    public function searchByTitle(string $title): Traversable;


    /**
     * Check if a book exists by its ISBN.
     *
     * @param string $isbn The ISBN code
     * @return bool True if a book with this ISBN exists, false otherwise
     */
    public function existByIsbn(string $isbn): bool;

    /**
     * Check if a book exists by its Id
     * @param string $id
     * @return bool
     */
    public function existById(string $id): bool;

    /**
     * Check if a book exists by its title
     * 
     * @param string $title
     * @return bool
     */
    public function existByTitle(string $title): bool;
}
