<?php

namespace App\Services;

use App\Exceptions\RepositoryException;
use App\Interfaces\UserRepositoryInterface;
use App\Model\User;
use App\Exceptions\ValidationException;
use Exception;
use Traversable;

class UserService {
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository){
        $this->repository = $repository;
    }

    /**
     * Retrieve all users.
     *
     * @return Traversable A collection of User objects
     */
    public function getAllUsers(): Traversable {
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
     * Find the user by its name
     * 
     * @param string $name The string to found
     * 
     * @return ?User User found
     */
    public function findUsersByName(string $name): ?User{
        return $this->repository->findByUsername($name);
    }

    /**
     * Search for user whose name contains `name`
     * 
     * @param string $name
     * @return Traversable
     */
    public function searchUSerByName(string $name): Traversable{
        return $this->repository->searchByUserName($name);
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
        $this->validateUser($user);
        // Attempt to add user to repository
        try {
            $this->repository->add($user);
        } catch (RepositoryException $e) {
            throw new ValidationException("Failed to add user: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Validate the user information before add it
     * 
     * @param \App\Model\User $user The user to validate
     * @throws \App\Exceptions\ValidationException
     * @return void
     */
    public function validateUser(User $user){
        if(empty($user->getName())){
            throw new ValidationException("The user name can't be empty");
        }
        
        $oldUserData = $this->repository->findById($user->getId());
        if ($this->repository->existByEmail($user->getEmail()) &&
            (!$oldUserData || $oldUserData->getEmail() !== $user->getEmail())) {
            throw new ValidationException("This user email is already taken");
        }

        if($this->repository->existByUsername($user->getName()) &&
            (!$oldUserData || $oldUserData->getName() !== $user->getName())    ) {
            throw new ValidationException('This user name is already taken');
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

        //Valide the user email
        $this->validateUser($user);

        // Attempt to update user in repository
        try {
            $this->repository->update($user);
        } catch (RepositoryException $e) {
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

}
