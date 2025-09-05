<?php
require_once __DIR__."/Person.php";

class User extends Person {
    private string $id;
    private ?string $pseudo;
    private string $email;
    private string $password;

    /**
     * User constructor
     * 
     * @param string $id User identifier
     * @param string $name User's first name
     * @param string|null $surname User's surname
     * @param string|null $pseudo Optional username
     * @param string $email User's email
     * @param string $password Already hashed password
     * @param DateTime|null $birthDate User's birth date
     * @param Gender|null $gender User's gender
     * @param int|null $height User's height
     */
    public function __construct(
        string $id,
        string $name,
        ?string $surname = null,
        ?string $pseudo = null,
        string $email,
        string $password,
        ?DateTime $birthDate = null,
        ?Gender $gender = null,
        ?int $height = null
    ){
        parent::__construct($name, $surname, $birthDate, $gender, $height);
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
    }

    // ===== Getters =====

    public function getId(): string {
        return $this->id;
    }

    public function getPseudo(): ?string {
        return $this->pseudo;
    }

    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Get the hashed password
     * 
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    // ===== Setters =====

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setPseudo(?string $pseudo): void {
        $this->pseudo = $pseudo;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    /**
     * Set password
     * 
     * The password should already be hashed before being set
     * 
     * @param string $password Hashed password
     * @return void
     */
    public function setPassword(string $password): void {
        $this->password = $password;
    }
}
