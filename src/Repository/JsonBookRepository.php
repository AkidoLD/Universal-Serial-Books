<?php

namespace App\Repository;

use App\Exceptions\RepositoryException;
use App\Model\Book;
use App\Repository\BookRepositoryInterface;

class JsonBookRepository implements BookRepositoryInterface{
    /**
     * The JSON repository filePath
     * @var string
     */
    private string $filePath;

    public function __construct(string $filePath) {
        // Check if the file exists, otherwise attempt to create it
        if (!file_exists($filePath)) {
            $created = @file_put_contents($filePath, json_encode([], JSON_PRETTY_PRINT), LOCK_EX);
            if ($created === false) {
                // If creation fails, the repository cannot function
                throw new RepositoryException("Impossible de créer le fichier JSON : $filePath");
            }
        }
    
        // Ensure the file is accessible for both reading and writing
        if (!is_readable($filePath) || !is_writable($filePath)) {
            throw new RepositoryException("Le fichier JSON n'est pas accessible en lecture/écriture : $filePath");
        }
    
        // Check if the file contains valid JSON
        $content = file_get_contents($filePath);
        $decoded = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RepositoryException("Fichier JSON corrompu : " . json_last_error_msg());
        }
    
        // File is valid → store path
        $this->filePath = $filePath;
    }

    public function getAll(): \Traversable{
        
    }
    
    
}