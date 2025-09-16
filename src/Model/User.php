<?php

namespace App\Model;

use App\Enums\Gender;
use App\Interfaces\ArrayConvertible;
use Ramsey\Uuid\Uuid;
use App\Model\Person;
use App\Interfaces\JsonSerializable;
use DateTime;

/**
 * Class User
 *
 * Represents an application user.
 * The ID is generated automatically if not provided using UUID v4.
 */
class User extends Person implements ArrayConvertible, JsonSerializable {
    private readonly string $id; // Immutable user identifier
    private string $email;
    private string $password; // Already hashed password
    private ?DateTime $regDate;
    private ?string $pseudo;

    // ===== JSON KEYS =====
    public const KEY_ID = 'id';
    public const KEY_PSEUDO = 'pseudo';
    public const KEY_EMAIL = 'email';
    public const KEY_PASSWORD = 'password';
    public const KEY_REG_DATE = 'reg_date';

    /**
     * User constructor.
     *
     * @param ?string $id User identifier, UUID v4 will be generated if null
     * @param string $name User's first name
     * @param ?string $surname User's surname
     * @param string $email User's email
     * @param string $password Already hashed password
     * @param ?\DateTime $birthDate User's birth date
     * @param ?DateTime $regDate User's registration date
     * @param ?Gender $gender User's gender
     * @param ?string $pseudo Optional username
     * @param ?float $height User's height
     */
    public function __construct(
        ?string $id,
        string $name,
        string $email,
        string $password,
        ?string $surname = null,
        ?DateTime $birthDate = null,
        ?DateTime $regDate = null,
        ?Gender $gender = null,
        ?string $pseudo = null,
        ?float $height = null,
    ){
        parent::__construct($name, $surname, $birthDate, $gender, $height);
        $this->id = $id ?? Uuid::uuid4()->toString(); // generate UUID internally
        $this->regDate = $regDate ?? new DateTime(); // If the registration date is null, use the server time
        $this->setPseudo($pseudo);
        $this->setEmail($email);
        $this->setPassword($password);
    }
    
    // ===== GETTERS =====
    public function getId(): string { return $this->id; }
    public function getPseudo(): ?string { return $this->pseudo; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getRegDate(): DateTime { return $this->regDate; }

    // ===== SETTERS =====
    public function setPseudo(?string $pseudo): void { $this->pseudo = $pseudo === null ? null :  trim($pseudo); }
    public function setEmail(string $email): void { $this->email = $email === null ? null : trim($email); }
    public function setPassword(?string $password): void { $this->password = $password === null ? null : trim($password); }
    public function setRegDate(?DateTime $regDate): void { $this->regDate = $regDate; }

    // ===== UTILITY METHODS =====
    /**
     * Convert the user to an associative array
     *
     * @return array
     */
    public function toArray(): array {
        return [
            self::KEY_ID => $this->getId(),
            self::KEY_NAME => $this->getName(),
            self::KEY_EMAIL => $this->getEmail(),
            self::KEY_PASSWORD => $this->getPassword(),
            self::KEY_SURNAME => $this->getSurname(),
            self::KEY_BIRTHDATE => $this->getBirthDate()?->getTimestamp(),
            self::KEY_REG_DATE => $this->getRegDate()?->getTimestamp(),
            self::KEY_GENDER => $this->getGender()?->value,
            self::KEY_PSEUDO => $this->getPseudo(),
            self::KEY_HEIGHT => $this->getHeight(),
        ];
    }

    public static function fromArray(array $array): User {
        return new User(
            $array[self::KEY_ID] ?? null,
            $array[self::KEY_NAME] ?? null,
            $array[self::KEY_EMAIL] ?? null,
            $array[self::KEY_PASSWORD] ?? null,
            $array[self::KEY_SURNAME] ?? null,
            $array[self::KEY_BIRTHDATE] ? new DateTime()->setTimestamp($array[self::KEY_BIRTHDATE]) : null,
            $array[self::KEY_REG_DATE] ? new DateTime()->setTimestamp($array[self::KEY_REG_DATE]) : null,
            $array[self::KEY_GENDER] ? Gender::from($array[self::KEY_GENDER]) : null,
            $array[self::KEY_PSEUDO] ?? null,
            $array[self::KEY_HEIGHT] ?? null,
        );
    }

    /**
     * Convert the user to a JSON string
     *
     * @return string
     */
    public function toJson(): string {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    }

    public static function fromJson(string $jsonString): User{
        return self::fromArray(json_decode($jsonString, flags: JSON_THROW_ON_ERROR));
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
        $regDate = $this->getRegDate()?->format('Y-m-d a H: i: s') ?? 'N\A';
        return parent::__toString() . "
            ID: {$this->id}
            Registration date : $regDate
            Pseudo: $pseudo
            Email: $email
            Password: $password";
    }
}
