<?php
require_once __DIR__."/Gender.php";
/**
 * The basic representation of a person
 */
class Person{
    private ?string $name;
    private ?string $surname;
    private ?DateTime $birthDate;
    private ?Gender $gender;
    private ?int $height;

    public function __construct(
        ?string $name = 'default',
        ?string $surname = null,
        ?DateTime $birthDate = null,
        ?Gender $gender = null,
        ?int $height = null,
    )
    {   
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->height = $height;
    }

    /**
     * Get the person `name`
     * 
     * This method makes it possible to recover the name of the instantiated object
     * 
     * @return string|null
     */
    public function getName(): string|null{
        return $this->name;
    }
    
    /**
     * Get the person `name`
     * 
     * This method makes it possible to recover the surname of the instantiated object
     * 
     * @return string|null
     */
    public function getSurname(): string|null{
        return $this->surname;
    }
    
    /**
     * Get the person `name`
     * 
     * This method makes it possible to recover the birth date of the instantiated object
     * 
     * @return string|null
     */
    public function getBirthDate(): DateTime|null{
        return $this->birthDate;
    }
    
    /**
     * Get the person `name`
     * 
     * This method makes it possible to recover the gender of the instantiated object
     * 
     * @return string|null
     */
    public function getGender(): Gender|null{
        return $this->gender;
    }
    
    /**
     * Get the person `name`
     * 
     * This method makes it possible to recover the height of the instantiated object
     * 
     * @return string|null
     */
    public function getHeight(): int|null{
        return $this->height;
    }
    
    /**
     * Get the age of the person
     * @return int
     */
    public function getAge(): int {
        $now = new DateTime();
        $diff = $now->diff($this->birthDate);
        return $diff->y;
    }

    /**
     * Get the person `name`
     * 
     * This method makes it possible to modify the name of the instantiated object
     * 
     * @param string|null $name
     * 
     * @return void
     */
    public function setName(?string $name){
        $this->name = $name;
    }

    /**
     * Get the person `surname`
     * 
     * This method makes it possible to modify the surname of the instantiated object
     * 
     * @param string|null $surname
     * 
     * @return void
     */
    public function setSurname(?string $surname){
        $this->surname = $surname;
    }

    /**
     * Get the person `birth date`
     * 
     * This method makes it possible to modify the birth date of the instantiated object
     * 
     * @param DateTime $birthDate
     * 
     * @return void
     */
    public function setBirthDate(?DateTime $birthDate){
        $this->birthDate = $birthDate;
    }

    /**
     * Get the person `gender`
     * 
     * This method makes it possible to modify the gender of the instantiated object
     * 
     * @param Gender $gender
     * 
     * @return void
     */
    public function setGender(?Gender $gender){
        $this->gender = $gender;
    }

    /**
     * Get the person `height`
     * 
     * This method makes it possible to modify the height of the instantiated object
     * 
     * @param int $height
     * 
     * @return void
     */
    public function setHeight(?int $height){
        $this->height = $height;
    }


}