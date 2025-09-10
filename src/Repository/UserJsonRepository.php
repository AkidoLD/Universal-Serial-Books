<?php

namespace App\Repository;

use App\Model\User;
use App\Model\Person;
use App\Enums\Gender;

/**
 * JSON-based implementation of the UserRepositoryInterface.
 *
 * This repository manages User objects stored in a JSON file.
 * All keys are based on constants defined in the User class, ensuring
 * maintainability and avoiding hardcoded strings.
 */
class UserJsonRepository implements UserRepositoryInterface {

    /**
     * @var string Path to the JSON file storing users
     */
    private string $filePath;

    /**
     * Constructor
     *
     * @param string $filePath Path to the JSON file
     */
    public function __construct(string $filePath) {
        $this->filePath = $filePath;

        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode([]));
        }
    }

    /**
     * Load all users from JSON file
     *
     * @return array<int, array> Raw associative array
     */
    private function loadData(): array {
        $json = file_get_contents($this->filePath);
        $data = json_decode($json, true);
        return is_array($data) ? $data : [];
    }

    /**
     * Save raw array of users to JSON
     *
     * @param array<int, array> $data
     * @return void
     */
    private function saveData(array $data): void {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Convert an associative array to a User object
     *
     * @param array $item
     * @return User
     */
    private function createUserFromArray(array $item): User {
        return new User(
            $item[Person::KEY_NAME] ?? '',
            $item[User::KEY_EMAIL] ?? '',
            $item[User::KEY_PASSWORD] ?? '',
            $item[User::KEY_ID] ?? null,
            $item[Person::KEY_SURNAME] ?? null,
            $item[User::KEY_PSEUDO] ?? null,
            isset($item[Person::KEY_BIRTHDATE]) ? new \DateTime($item[Person::KEY_BIRTHDATE]) : null,
            isset($item[Person::KEY_GENDER]) ? Gender::from($item[Person::KEY_GENDER]) : null,
            $item[Person::KEY_HEIGHT] ?? null
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(): \Traversable {
        $data = $this->loadData();
        foreach ($data as $item) {
            yield $this->createUserFromArray($item);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function add(User $user): bool {
        $data = $this->loadData();

        foreach ($data as $item) {
            if ($item[User::KEY_ID] === $user->getId()) return false;
        }

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
                return $this->createUserFromArray($item);
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
                return $this->createUserFromArray($item);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function findByUsername(string $username): ?User {
        foreach ($this->loadData() as $item) {
            if (($item[User::KEY_PSEUDO] ?? null) === $username) {
                return $this->createUserFromArray($item);
            }
        }
        return null;
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
}
