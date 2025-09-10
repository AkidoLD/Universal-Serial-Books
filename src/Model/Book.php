<?php

namespace App\Model;

use App\Enums\BookGender;
use Ramsey\Uuid\Uuid;

/**
 * Class Book
 *
 * Represents a book with all its main attributes.
 * The ID is generated automatically if not provided using UUID v4.
 */
class Book {
    private readonly string $id; // Immutable book identifier
    private string $title;
    private ?Person $author;
    private ?string $cover;
    private ?\DateTime $publicationDate;
    private ?string $isbn;
    private ?int $pages;
    private ?BookGender $genre;

    // JSON keys
    public const KEY_ID = 'id';
    public const KEY_TITLE = 'title';
    public const KEY_AUTHOR = 'author';
    public const KEY_PUBLICATION_DATE = 'publicationDate';
    public const KEY_ISBN = 'isbn';
    public const KEY_PAGES = 'pages';
    public const KEY_GENRE = 'genre';
    public const KEY_COVER = 'cover';

    /**
     * Book constructor.
     *
     * @param string|null $id Book identifier, UUID v4 will be generated if null
     * @param string $title Title of the book, cannot be empty
     * @param ?Person $author Author of the book
     * @param \DateTime|null $publicationDate Publication date
     * @param string|null $isbn ISBN code
     * @param int|null $pages Number of pages
     * @param BookGender|null $genre Genre of the book
     * @param string|null $cover Cover image or path
     */
    public function __construct(
        ?string $id = null,
        string $title = "",
        ?Person $author = null,
        ?\DateTime $publicationDate = null,
        ?string $isbn = null,
        ?int $pages = null,
        ?BookGender $genre = null,
        ?string $cover = null
    ) {
        $this->id = $id ?? Uuid::uuid4()->toString(); // Generate UUID v4 if null
        $this->setTitle($title); // Apply validation
        $this->author = $author;
        $this->publicationDate = $publicationDate;
        $this->isbn = $isbn;
        $this->pages = $pages;
        $this->genre = $genre;
        $this->cover = $cover;
    }

    // ===== GETTERS =====
    public function getId(): string { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getAuthor(): ?Person { return $this->author; }
    public function getPublicationDate(): ?\DateTime { return $this->publicationDate; }
    public function getIsbn(): ?string { return $this->isbn; }
    public function getPages(): ?int { return $this->pages; }
    public function getGenre(): ?BookGender { return $this->genre; }
    public function getCover(): ?string { return $this->cover; }

    // ===== SETTERS =====
    /**
     * Set the book title
     * @param string $title Non-empty title
     * @throws \InvalidArgumentException if title is empty
     */
    public function setTitle(string $title): void {
        if (trim($title) === '') {
            throw new \InvalidArgumentException("Title cannot be empty.");
        }
        $this->title = $title;
    }

    public function setAuthor(?Person $author): void { $this->author = $author; }
    public function setPublicationDate(?\DateTime $publicationDate): void { $this->publicationDate = $publicationDate; }
    public function setIsbn(?string $isbn): void { $this->isbn = $isbn; }
    public function setPages(?int $pages): void { $this->pages = $pages; }
    public function setGenre(?BookGender $genre): void { $this->genre = $genre; }
    public function setCover(?string $cover): void { $this->cover = $cover; }

    // ===== UTILITY METHODS =====
    /**
     * Convert the book to an associative array
     * @return array
     */
    public function toArray(): array {
        return [
            self::KEY_ID => $this->id,
            self::KEY_TITLE => $this->title,
            self::KEY_AUTHOR => $this->author?->getName(),
            self::KEY_PUBLICATION_DATE => $this->publicationDate?->format('Y-m-d'),
            self::KEY_ISBN => $this->isbn,
            self::KEY_PAGES => $this->pages,
            self::KEY_GENRE => $this->genre?->value,
            self::KEY_COVER => $this->cover,
        ];
    }

    /**
     * Convert the book to a JSON string
     * @return string
     */
    public function toJson(): string {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    /**
     * Magic method to represent the book as a string
     * @return string
     */
    public function __toString(): string {
        $authorName = $this->author?->getName() ?? "N/A";
        $pubDate = $this->publicationDate?->format('Y-m-d') ?? "N/A";
        $genre = $this->genre?->value ?? "N/A";
        return "<pre>
            ID: {$this->id}
            Title: {$this->title}
            Author: {$authorName}
            Published: {$pubDate}
            ISBN: {$this->isbn}
            Pages: {$this->pages}
            Genre: {$genre}
            Cover: {$this->cover}
        </pre>";
    }
}
