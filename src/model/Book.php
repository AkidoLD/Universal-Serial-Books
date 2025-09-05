<?php

require_once __DIR__ . "/Person.php";
require_once __DIR__ . "/../Enums/BookGender.php";

use Enums\BookGender;
/**
 * Class Book
 *
 * Represents a book with all its main attributes.
 */
class Book {
    private string $title;
    private Person $author;
    private ?string $cover;
    private ?DateTime $publicationDate;
    private ?string $isbn;
    private ?int $pages;
    private ?BookGender $genre;

    /**
     * Book constructor.
     *
     * @param string $title The title of the book
     * @param Person $author The author of the book
     * @param DateTime|null $publicationDate The publication date (optional)
     * @param string|null $isbn The ISBN code (optional)
     * @param int|null $pages Number of pages (optional)
     * @param BookGender|null $genre The genre of the book (optional)
     * @param ?string $cover The cover of the book 
     */
    public function __construct(
        string $title,
        Person $author,
        ?DateTime $publicationDate = null,
        ?string $isbn = null,
        ?int $pages = null,
        ?BookGender $genre = null,
        ?string $cover = null,
    ) {
        $this->title = $title;
        $this->author = $author;
        $this->publicationDate = $publicationDate;
        $this->isbn = $isbn;
        $this->pages = $pages;
        $this->genre = $genre;
    }

    // ===== GETTERS =====

    public function getTitle(): string {
        return $this->title;
    }

    public function getAuthor(): Person {
        return $this->author;
    }

    public function getPublicationDate(): ?DateTime {
        return $this->publicationDate;
    }

    public function getIsbn(): ?string {
        return $this->isbn;
    }

    public function getPages(): ?int {
        return $this->pages;
    }

    public function getGenre(): ?BookGender {
        return $this->genre;
    }

    // ===== SETTERS =====

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setAuthor(Person $author): void {
        $this->author = $author;
    }

    public function setPublicationDate(?DateTime $publicationDate): void {
        $this->publicationDate = $publicationDate;
    }

    public function setIsbn(?string $isbn): void {
        $this->isbn = $isbn;
    }

    public function setPages(?int $pages): void {
        $this->pages = $pages;
    }

    public function setGenre(?BookGender $genre): void {
        $this->genre = $genre;
    }

    // ===== OTHER METHODS =====

    /**
     * Returns a brief description of the book.
     *
     * @return string Description including title, author, publication date, ISBN, pages, and genre.
     */
    public function getDescription(): string {
        $authorName = $this->author->getName() ?? "Unknown Author";
        $pubDate = $this->publicationDate ? $this->publicationDate->format('Y-m-d') : "Unknown Date";
        $isbn = $this->isbn ?? "N/A";
        $pages = $this->pages ?? "N/A";
        $genre = $this->genre?->value ?? "N/A"; // Use enum value
        return "<pre>
            Title: {$this->title}
            Author: {$authorName}
            Published: {$pubDate}
            ISBN: {$isbn}
            Pages: {$pages}
            Genre: {$genre}
        </pre>";
    }

    /**
     * Magic method to return the book as a string.
     *
     * @return string Complete string representation of the book.
     */
    public function __toString(): string {
        return $this->getDescription();
    }
}
