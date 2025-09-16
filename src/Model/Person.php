<?php

namespace App\Model;

use App\Enums\Gender;
use App\Interfaces\ArrayConvertible;
use DateTime;
use InvalidArgumentException;

/**
 * Class Person
 *
 * Represents a basic person with name, surname, birth date, gender, and height.
 */
class Person implements ArrayConvertible{
    private string $name;
    private ?string $surname;
    private ?DateTime $birthDate;
    private ?Gender $gender;
    private ?float $height;

    // ===== JSON KEYS =====
    public const KEY_NAME = 'name';
    public const KEY_SURNAME = 'surname';
    public const KEY_BIRTHDATE = 'birthDate';
    public const KEY_GENDER = 'gender';
    public const KEY_HEIGHT = 'height';

    //Constantes
    public const DEFAULT_NAME = "No name";
    public const MAXIMUM_AGE = 150;
    public const MINIMUM_AGE = 10;

    /**
     * Person constructor.
     *
     * @param string $name First name of the person
     * @param string|null $surname Surname of the person
     * @param \DateTime|null $birthDate Birth date
     * @param Gender|null $gender Gender
     * @param float|null $height Height in cm
     */
    public function __construct(
        string $name = self::DEFAULT_NAME,
        ?string $surname = null,
        ?DateTime $birthDate = null,
        ?Gender $gender = null,
        ?float $height = null
    ) {
        $this->setName($name);
        $this->setSurname($surname);
        $this->setBirthDate($birthDate);
        $this->setGender($gender);
        $this->setHeight($height);
    }

    // ===== GETTERS =====
    public function getName(): string { return $this->name; }
    public function getSurname(): ?string { return $this->surname; }
    public function getBirthDate(): ?DateTime { return $this->birthDate; }
    public function getGender(): ?Gender { return $this->gender; }
    public function getHeight(): ?float { return $this->height; }

    /**
     * Calculate the age of the person
     *
     * @return int|null Age in years or null if birth date is not set
     */
    public function getAge(): ?int {
        if (!$this->birthDate) return null;
        $now = new DateTime();
        return $now->diff($this->birthDate)->y;
    }

    // ===== SETTERS =====
    public function setName(string $name): void {
        $trimmed = trim($name);
        if ($trimmed === '') {
            throw new InvalidArgumentException("The person's name cannot be empty.");
        }
        $this->name = $trimmed;
    }
        
    public function setSurname(?string $surname): void { 
        if ($surname !== null) {
            $surnameTrimmed = trim($surname);
            if ($surnameTrimmed === '') {
                throw new InvalidArgumentException('The person surname cannot be empty.');
            }
            $surname = $surnameTrimmed;
        }
        $this->surname = $surname;
    }

    public function setBirthDate(?DateTime $birthDate): void {
        if ($birthDate === null) {
            $this->birthDate = null;
            return;
        }
    
        $now = new DateTime();
        $age = $now->diff($birthDate)->y; // nombre d'années
    
        
        if ($age < 0) {
            throw new InvalidArgumentException("Birth date cannot be in the future.");
        }

        if ($age < self::MINIMUM_AGE) {
            throw new InvalidArgumentException(
                "Birth date cannot be less than " . self::MINIMUM_AGE . " years ago."
            );
        }
        
        if ($age > self::MAXIMUM_AGE) {
            throw new InvalidArgumentException(
                "Birth date cannot be more than " . self::MAXIMUM_AGE . " years ago."
            );
        }        
    
        $this->birthDate = $birthDate;
    }
    
    public function setGender(?Gender $gender): void { $this->gender = $gender; }
    public function setHeight(?float $height): void { $this->height = $height !== null ? abs($height) : null; }

    // ===== UTILITY =====

    /**
     * Convert the `Person` instance to an `Array`
     * 
     * @return array
     */
    public function toArray(): array{
        return [
            self::KEY_NAME => $this->name,
            self::KEY_SURNAME => $this->surname,
            self::KEY_BIRTHDATE => $this->birthDate->getTimestamp(),
            self::KEY_GENDER => $this->gender->value,
            self::KEY_HEIGHT => $this->height,
        ];
    }

    /**
     * Convert an `Array` to an `Person` instance
     * @param array $array
     * @return Person
     */
    public static function fromArray(array $array): Person{
        return new Person(
            $array[self::KEY_NAME] ?? null,
            $array[self::KEY_SURNAME] ?? null,
            $array[self::KEY_BIRTHDATE] ? new DateTime()->setTimestamp($array[self::KEY_BIRTHDATE]) : null,
            $array[self::KEY_GENDER] ? Gender::from($array[self::KEY_GENDER]) : null,
            $array[self::KEY_HEIGHT] ?? null,
        );
    }

    public function __toString(): string {
        $name = $this->name;
        $surname = $this->surname ?? 'N/A';
        $age = $this->birthDate ? $this->getAge() : 'N/A';
        $birthDate = $this->birthDate ? $this->birthDate->format('Y-m-d') : 'N/A';
        $height = $this->height ?? 'N/A';
        $gender = $this->gender ? $this->gender->value : 'N/A';

        return "
            Name: $name
            Surname: $surname
            Age: $age
            Birth Date: $birthDate
            Height: $height
            Gender: $gender";
    }
}
