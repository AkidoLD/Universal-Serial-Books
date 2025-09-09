<?php

use App\Model\Book;

/**
 * Interface for a repository that manages Book objects.
 * 
 * This interface defines the contract for any Book repository implementation,
 * whether the data is stored in JSON, SQL, or another storage system.
 * It ensures consistent methods to interact with books.
 */
interface BookRepositoryInterface {

    /**
     * Retrieve all books from the repository.
     * 
     * Returns a Traversable object, which can be either an array or a generator.
     * Using Traversable allows iteration over the books without loading all of them
     * into memory at once. This is especially useful for large datasets.
     * 
     * @return Traversable A collection of Book objects
     */
    public function getAll(): Traversable;

    /**
     * Find a single book by its unique identifier.
     * 
     * Returns a Book object if found, or null if the book does not exist.
     * This method should not throw an error if the book is not present.
     * 
     * @param string $id The unique identifier of the book
     * @return Book|null The Book object or null if not found
     */
    public function find(string $id): ?Book;

    /**
     * Check whether a book exists in the repository.
     * 
     * Returns true if the book exists, false otherwise.
     * This method provides a lightweight way to check existence without
     * retrieving the entire Book object.
     * 
     * @param string $id The unique identifier of the book
     * @return bool True if the book exists, false otherwise
     */
    public function exist(string $id): bool;

    /**
     * Delete a book from the repository.
     * 
     * Returns true if the book was successfully deleted, false otherwise.
     * 
     * @param string $id The unique identifier of the book
     * @return bool True on success, false on failure
     */
    public function delete(string $id): bool;

    /**
     * Add a new book to the repository.
     * 
     * Returns true if the book was successfully added, false otherwise.
     * 
     * @param Book $book The Book object to add
     * @return bool True on success, false on failure
     */
    public function add(Book $book): bool;

    /**
     * Update an existing book in the repository.
     * 
     * Returns true if the update was successful, false otherwise.
     * This ensures that changes to a book's data can be persisted.
     * 
     * @param Book $book The Book object with updated data
     * @return bool True on success, false on failure
     */
    public function update(Book $book): bool;
}
