<?php

namespace App\Model;

use App\Enums\Gender;

/**
 * Class Person
 *
 * Represents a basic person with name, surname, birth date, gender, and height.
 */
class Person {
    private string $name;
    private ?string $surname;
    private ?\DateTime $birthDate;
    private ?Gender $gender;
    private ?int $height;

    /**
     * Person constructor.
     *
     * @param string $name First name of the person
     * @param string|null $surname Surname of the person
     * @param \DateTime|null $birthDate Birth date
     * @param Gender|null $gender Gender
     * @param int|null $height Height in cm
     */
    public function __construct(
        string $name = 'default',
        ?string $surname = null,
        ?\DateTime $birthDate = null,
        ?Gender $gender = null,
        ?int $height = null
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->height = $height;
    }

    // ===== GETTERS =====
    public function getName(): string { return $this->name; }
    public function getSurname(): ?string { return $this->surname; }
    public function getBirthDate(): ?\DateTime { return $this->birthDate; }
    public function getGender(): ?Gender { return $this->gender; }
    public function getHeight(): ?int { return $this->height; }

    /**
     * Calculate the age of the person
     *
     * @return int|null Age in years or null if birth date is not set
     */
    public function getAge(): ?int {
        if (!$this->birthDate) return null;
        $now = new \DateTime();
        return $now->diff($this->birthDate)->y;
    }

    // ===== SETTERS =====
    public function setName(string $name): void { $this->name = $name; }
    public function setSurname(?string $surname): void { $this->surname = $surname; }
    public function setBirthDate(?\DateTime $birthDate): void { $this->birthDate = $birthDate; }
    public function setGender(?Gender $gender): void { $this->gender = $gender; }
    public function setHeight(?int $height): void { $this->height = $height; }

    // ===== UTILITY =====
    public function __toString(): string {
        $name = $this->name;
        $surname = $this->surname ?? 'N/A';
        $age = $this->birthDate ? $this->getAge() : 'N/A';
        $birthDate = $this->birthDate ? $this->birthDate->format('Y-m-d') : 'N/A';
        $height = $this->height ?? 'N/A';
        $gender = $this->gender ? $this->gender->value : 'N/A';

        return "<pre>
            Name: $name
            Surname: $surname
            Age: $age
            Birth Date: $birthDate
            Height: $height
            Gender: $gender
        </pre>";
    }
}
