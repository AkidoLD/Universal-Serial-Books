<?php

namespace App\Model;

use App\Enums\Gender;
use Ramsey\Uuid\Uuid;
use App\Model\Person;

/**
 * Class User
 *
 * Represents an application user.
 * The ID is generated automatically if not provided using UUID v4.
 */
class User extends Person {
    private readonly string $id; // Immutable user identifier
    private ?string $pseudo;
    private string $email;
    private string $password; // Already hashed password

    /**
     * User constructor.
     *
     * @param string|null $id User identifier, UUID v4 will be generated if null
     * @param string $name User's first name
     * @param string|null $surname User's surname
     * @param string|null $pseudo Optional username
     * @param string $email User's email
     * @param string $password Already hashed password
     * @param \DateTime|null $birthDate User's birth date
     * @param Gender|null $gender User's gender
     * @param int|null $height User's height
     */
    public function __construct(
        ?string $id = null,
        string $name,
        ?string $surname = null,
        ?string $pseudo = null,
        string $email,
        string $password,
        ?\DateTime $birthDate = null,
        ?Gender $gender = null,
        ?int $height = null
    ) {
        parent::__construct($name, $surname, $birthDate, $gender, $height);
        $this->id = $id ?? Uuid::uuid4()->toString(); // Generate UUID v4 if null
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
    }

    // ===== GETTERS =====
    public function getId(): string { return $this->id; }
    public function getPseudo(): ?string { return $this->pseudo; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }

    // ===== SETTERS =====
    public function setPseudo(?string $pseudo): void { $this->pseudo = $pseudo; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $password): void { $this->password = $password; }

    // ===== UTILITY METHODS =====
    /**
     * Convert the user to an associative array
     *
     * @return array
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'pseudo' => $this->pseudo,
            'email' => $this->email,
            'birthDate' => $this->getBirthDate()?->format('Y-m-d'),
            'gender' => $this->getGender()?->value,
            'height' => $this->getHeight(),
        ];
    }

    /**
     * Convert the user to a JSON string
     *
     * @return string
     */
    public function toJson(): string {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    /**
     * Magic method to represent the user as a string
     *
     * @return string
     */
    public function __toString(): string {
        $pseudo = $this->pseudo ?? 'N/A';
        $email = $this->email;
        $password = $this->password;
        return parent::__toString() . "<pre>
            ID: {$this->id}
            Pseudo: {$pseudo}
            Email: {$email}
            Password: {$password}
        </pre>";
    }
}
