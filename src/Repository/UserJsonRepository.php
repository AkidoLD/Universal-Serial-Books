<?php

namespace App\Repository;

use App\Exceptions\RepositoryException;
use App\Model\User;
use App\Interfaces\UserRepositoryInterface;
use App\Model\Person;
use ArrayIterator;
use Traversable;

/**
 * JSON-based implementation of the UserRepositoryInterface.
 *
 * This repository manages User objects stored in a JSON file.
 * All keys are based on constants defined in the User class, ensuring
 * maintainability and avoiding hardcoded strings.
 */
class UserJsonRepository extends JsonRepository implements UserRepositoryInterface {
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
    public function getAll(): Traversable {
        $data = $this->loadData();
        foreach ($data as $item) {
            yield User::fromArray($item);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function add(User $user): bool {
        //Check if the user id already exist in the repository
        if($this->existById($user)){
            throw new RepositoryException('Failed to add new User : The user Id already exist in the repository');
        }

        $data = $this->loadData();
        $data[] = $user->toArray();
        $this->saveData($data);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function update(User $user): bool {
        $data = $this->loadData();
        foreach ($data as $index => $item) {
            if ($item[User::KEY_ID] === $user->getId()) {
                $data[$index] = $user->toArray();
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
            if ($item[User::KEY_ID] === $id) {
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
    public function findById(string $id): ?User {
        foreach ($this->loadData() as $item) {
            if (($item[User::KEY_ID] ?? null) === $id) {
                return User::fromArray($item);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function findByEmail(string $email): ?User {
        foreach ($this->loadData() as $item) {
            if (($item[User::KEY_EMAIL] ?? null) === $email) {
                return User::fromArray($item);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function findByUsername(string $username): ?User {
        foreach ($this->loadData() as $item) {
            if ($item[Person::KEY_NAME] === $username) {
                return User::fromArray($item);
            }
        }
        return null;
    }

    public function searchByUserName(string $username): Traversable{
        foreach ($this->loadData() as $item) {
            if (stripos(($item[Person::KEY_NAME] ?? ''), $username) !== false) {
                yield User::fromArray($item);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function existById(string $id): bool {
        return $this->findById($id) !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function existByEmail(string $email): bool {
        return $this->findByEmail($email) !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function existByUsername(string $username): bool {
        return $this->findByUsername($username) !== null;
    }

    /**
     * {@inheritDoc}
     */
    public function refreshData(){
        $users = $this->getAll();
        $data = [];
        foreach($users as $user){
            $data[] = $user->toArray();
        }
        $this->saveData($data);
    }
}
