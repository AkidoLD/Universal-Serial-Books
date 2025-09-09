<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;
use App\Model\User;
use App\Exceptions\ValidationException;
use Ramsey\Uuid\Uuid;

class UserService {
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository){
        $this->repository = $repository;
    }

    /**
     * Retrieve all users.
     *
     * @return \Traversable A collection of User objects
     */
    public function getAllUsers(): \Traversable {
        return $this->repository->getAll();
    }

    /**
     * Find a user by ID.
     *
     * @param string $id
     * @return User|null
     */
    public function findUserById(string $id): ?User {
        return $this->repository->findById($id);
    }

    /**
     * Find a user by email.
     *
     * @param string $email
     * @return User|null
     */
    public function findUserByEmail(string $email): ?User {
        return $this->repository->findByEmail($email);
    }

    /**
     * Count all users.
     *
     * @return int
     */
    public function userCount(): int {
        return $this->repository->count();
    }

    /**
     * Add a new user.
     *
     * @param User $user
     * @throws ValidationException If the user data is invalid or email already exists
     */
    public function addUser(User $user): void {
        // Generate a new UUID for the user
        $user->setId(Uuid::uuid4()->toString());

        // Validate user data
        $this->validateUser($user, isNew: true);

        // Attempt to add user to repository
        try {
            $this->repository->add($user);
        } catch (\Exception $e) {
            // Re-throw as validation or repository exception if needed
            throw new ValidationException("Failed to add user: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Update an existing user.
     *
     * @param User $user
     * @throws ValidationException If the user does not exist or data is invalid
     */
    public function updateUser(User $user): void {
        // Ensure the user exists
        if (!$this->repository->existById($user->getId())) {
            throw new ValidationException("Cannot update: user does not exist");
        }

        // Validate user data
        $this->validateUser($user, isNew: false);

        // Attempt to update user in repository
        try {
            $this->repository->update($user);
        } catch (\Exception $e) {
            throw new ValidationException("Failed to update user: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Delete a user by ID.
     *
     * @param string $userId
     * @throws ValidationException If the user does not exist
     */
    public function deleteUserById(string $userId): void {
        if (!$this->repository->existById($userId)) {
            throw new ValidationException("User not found: cannot delete");
        }
        $this->repository->delete($userId);
    }

    /**
     * Validate user data.
     *
     * @param User $user
     * @param bool $isNew True if adding a new user, false if updating
     * @throws ValidationException
     */
    private function validateUser(User $user, bool $isNew): void {
        if (empty($user->getEmail())) {
            throw new ValidationException("Email cannot be empty");
        }

        if ($isNew && $this->repository->existByEmail($user->getEmail())) {
            throw new ValidationException("The email is already used by another user");
        }

        if (empty($user->getName())) {
            throw new ValidationException("Username cannot be empty");
        }

        if ($isNew && $this->repository->existByUsername($user->getName())) {
            throw new ValidationException("The username is already used by another user");
        }
    }
}
