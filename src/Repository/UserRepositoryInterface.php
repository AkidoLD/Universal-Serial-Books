<?php

use App\Model\User;

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
     * @return Traversable A collection of User objects
     */
    public function getAll(): Traversable;

    /**
     * Find a single user by their unique identifier.
     * 
     * Returns a User object if found, or null if the user does not exist.
     * This method should not throw an error if the user is not present.
     * 
     * @param string $id The unique identifier of the user
     * @return User|null The User object or null if not found
     */
    public function find(string $id): ?User;

    /**
     * Check whether a user exists in the repository.
     * 
     * Returns true if the user exists, false otherwise.
     * This method provides a lightweight way to verify existence without
     * retrieving the entire User object.
     * 
     * @param string $id The unique identifier of the user
     * @return bool True if the user exists, false otherwise
     */
    public function exist(string $id): bool;

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
}
