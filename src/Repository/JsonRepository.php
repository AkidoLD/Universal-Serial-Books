<?php

namespace App\Repository;

use App\Exceptions\RepositoryException;
use JsonException;
use RuntimeException;

abstract class JsonRepository{
    /**
     * @var string Path to the JSON file storing users
     */
    private string $filePath;

    public function __construct(string $filePath){
        $this->filePath = $filePath;

        // Create file if it does not exist
        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode([]));
        }
    }

    /**
     * Load all users from JSON file
     *
     * @return array<int, array> Raw associative array
     */
    public function loadData(): array {
        $json = file_get_contents($this->filePath);
        //Check if the file has been read
        if($json === false){
            throw new RepositoryException('Failed to read the file. FilePath : '.$this->filePath);
        }

        //try to decode the file content
        try{
            $data = json_decode($json, true);
        }catch(JsonException $e){
            //If the decodation failed, throw an exception
            throw new RepositoryException('Error occured when decode data : '.$e->getMessage());
        }
        return is_array($data) ? $data : [$data];
    }

    /**
     * Save raw array of users to JSON
     *
     * @param array<int, array> $data
     * @return void
     */
    public function saveData(array $data): void {
        try{
            $data = json_encode($data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
        }catch(JsonException $e){
            throw new RepositoryException('Error occured when encoding data');
        }
        if(file_put_contents($this->filePath, $data) === false){
            throw new RepositoryException('Failed to write datas in the file: FilePath : '.$this->filePath);
        }
    }

}