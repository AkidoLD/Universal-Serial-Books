<?php

namespace App\Interfaces;

use App\Model\User;
use Traversable;

/**
 * Interface for a repository that manages User objects.
 * 
 * This interface defines the contract for any User repository implementation,
 * whether data is stored in JSON, SQL, or another storage system.
 * It ensures consistent methods to interact with users.
 */
interface UserRepositoryInterface {

    /**
     * Retrieve all users from the repository.
     * 
     * Returns a Traversable object, which allows iteration over users without
     * necessarily loading all of them into memory at once.
     * Useful for large datasets or memory-efficient processing.
     * 
     * @return \Traversable<User> A collection of User objects
     */
    public function getAll(): \Traversable;

    /**
     * Delete a user from the repository.
     * 
     * Returns true if the user was successfully deleted, false otherwise.
     * 
     * @param string $id The unique identifier of the user
     * @return bool True on success, false on failure
     */
    public function delete(string $id): bool;

    /**
     * Add a new user to the repository.
     * 
     * Returns true if the user was successfully added, false otherwise.
     * 
     * @param User $user The User object to add
     * @return bool True on success, false on failure
     */
    public function add(User $user): bool;

    /**
     * Update an existing user in the repository.
     * 
     * Returns true if the update was successful, false otherwise.
     * This ensures that changes to a user's data can be persisted.
     * 
     * @param User $user The User object with updated data
     * @return bool True on success, false on failure
     */
    public function update(User $user): bool;

    /**
     * Count the number of users in the repository.
     * 
     * @return int The total number of registered users
     */
    public function count(): int;

    /**
     * Find a user by their unique identifier.
     * 
     * @param string $id The unique identifier of the user
     * @return User|null The User object if found, null otherwise
     */
    public function findById(string $id): ?User;

    /**
     * Find a user by their email address.
     * 
     * @param string $email The email of the user
     * @return User|null The User object if found, null otherwise
     */
    public function findByEmail(string $email): ?User;

    /**
     * Find a user by their username.
     * 
     * @param string $username The username of the user
     * @return Traversable User's object found
     */
    public function findByUsername(string $username): Traversable;

    /**
     * Check if a user exists by their unique identifier.
     * 
     * @param string $id The unique identifier of the user
     * @return bool True if the user exists, false otherwise
     */
    public function existById(string $id): bool;

    /**
     * Check if a user exists by their email address.
     * 
     * @param string $email The email of the user
     * @return bool True if a user with this email exists, false otherwise
     */
    public function existByEmail(string $email): bool;

    /**
     * Check if a user exists by their username.
     * 
     * @param string $username The username of the user
     * @return bool True if a user with this username exists, false otherwise
     */
    public function existByUsername(string $username): bool;
}
