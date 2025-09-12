<?php

namespace App\Model;

use App\Enums\BookGender;
use App\Interfaces\ArrayConvertible;
use App\Interfaces\JsonSerializable;
use DateTime;
use Ramsey\Uuid\Uuid;

/**
 * Class Book
 *
 * Represents a book with all its main attributes.
 * The ID is generated automatically if not provided using UUID v4.
 */
class Book implements ArrayConvertible, JsonSerializable{
    private readonly string $id; // Immutable book identifier
    private string $title;
    private ?string $author;
    private ?string $cover;
    private ?string $content;
    private ?DateTime $publicationDate;
    private ?DateTime $storageDate;
    private ?string $isbn;
    private ?int $pages;
    private ?BookGender $genre;

    // Array Keys
    public const KEY_ID = 'id';
    public const KEY_TITLE = 'title';
    public const KEY_AUTHOR = 'author';
    public const KEY_PUBLICATION_DATE = 'publicationDate';
    public const KEY_ISBN = 'isbn';
    public const KEY_PAGES = 'pages';
    public const KEY_GENDER = 'gender';
    public const KEY_COVER = 'cover';
    public const KEY_CONTENT = 'content';
    public const KEY_STORAGE_DATE = 'storageDate';

    //Constants


    /**
     * Book constructor.
     *
     * @param ?string $id Book identifier, UUID v4 will be generated if null
     * @param ?string $title Title of the book, cannot be empty
     * @param ?string $author Author of the book
     * @param ?BookGender $genre Genre of the book
     * @param ?string $cover Cover image or path
     * @param ?string $content The content of the book
     * @param ?DateTime $publicationDate Publication date
     * @param ?DateTime $storageDate The date has what the book was stored in the restitory rest
     * @param ?string $isbn ISBN code
     * @param ?int$pages Number of pages
     */
    public function __construct(
        ?string $id ,
        ?string $title ,
        ?string $author = null,
        ?BookGender $genre = null,
        ?string $cover = null,
        ?string $content = null,
        ?DateTime $publicationDate = null,
        ?DateTime $storageDate = null,
        ?string $isbn = null,
        ?int $pages = null,
    ) {
        $this->id = $id ?? Uuid::uuid4()->toString(); // Generate UUID v4 if null
        $this->storageDate = $storageDate ? $storageDate : new DateTime();
        $this->setTitle($title); // Apply validation
        $this->setAuthor($author);
        $this->setIsbn($isbn);
        $this->setCover($cover);
        $this->setContent($content);
        $this->setPublicationDate($publicationDate);
        $this->setPages($pages);
        $this->setGenre($genre);
    }

    // ===== GETTERS =====
    public function getId(): string { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getAuthor(): ?string { return $this->author; }
    public function getPublicationDate(): ?DateTime { return $this->publicationDate; }
    public function getStorageDate(): ?DateTime { return $this->storageDate; }
    public function getIsbn(): ?string { return $this->isbn; }
    public function getPages(): ?int { return $this->pages; }
    public function getGenre(): ?BookGender { return $this->genre; }
    public function getCover(): ?string { return $this->cover; }
    public function getContent(): ?string { return $this->content; }

    // ===== SETTERS =====
    /**
     * Set the book title
     * @param string $title Non-empty title
     * @throws \InvalidArgumentException if title is empty
     */
    public function setTitle(string $title): void {
        if (empty(trim($title))) {
            throw new \InvalidArgumentException("Title cannot be empty.");
        }
        $this->title = $title;
    }

    public function setAuthor(?string $author): void { $this->author = $author !== null ? trim($author) : null; }
    public function setIsbn(?string $isbn): void { $this->isbn = $isbn !== null ? trim($isbn) : null; }
    public function setCover(?string $cover): void { $this->cover = $cover !== null ? trim($cover) : null; }
    public function setContent(?string $content): void { $this->content = $content; }
    public function setPublicationDate(?DateTime $publicationDate): void { $this->publicationDate = $publicationDate; }
    public function setStorageDate(?DateTime $storageDate): void { $this->storageDate = $storageDate; }
    public function setPages(?int $pages): void { $this->pages = $pages; }
    public function setGenre(?BookGender $genre): void { $this->genre = $genre; }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array {
        return [
            self::KEY_ID => $this->id,
            self::KEY_TITLE => $this->title,
            self::KEY_AUTHOR => $this->author,
            self::KEY_GENDER => $this->genre?->value,
            self::KEY_COVER => $this->cover,
            self::KEY_CONTENT => $this->content,
            self::KEY_PUBLICATION_DATE => $this->getPublicationDate()?->getTimestamp(),
            self::KEY_STORAGE_DATE => $this->getStorageDate()?->getTimestamp(),
            self::KEY_ISBN => $this->isbn,
            self::KEY_PAGES => $this->pages,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function fromArray(array $array): Book{
        return new Book(
            $array[self::KEY_ID] ?? null,
            $array[self::KEY_TITLE] ?? null,
            $array[self::KEY_AUTHOR] ?? null,
            $array[self::KEY_GENDER] ? BookGender::from($array[self::KEY_GENDER]) : null,
            $array[self::KEY_COVER] ?? null,
            $array[self::KEY_CONTENT] ?? null,
            $array[self::KEY_PUBLICATION_DATE] ? new DateTime()->setTimestamp($array[self::KEY_PUBLICATION_DATE]) : null,
            $array[self::KEY_STORAGE_DATE] ? new DateTime()->setTimestamp($array[self::KEY_STORAGE_DATE]) : null,
            $array[self::KEY_ISBN] ?? null,
            $array[self::KEY_PAGES] ?? null,
        );
        
    }


    /**
     * Convert the Book instance to a JSON string
     * @return string
     */
    public function toJson(): string {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    }

    /**
     * Parse a JSON string to a `Book` instance
     * @param string $jsonString
     * @return Book
     */
    public static function fromJson(string $jsonString): Book{
        return self::fromArray(json_decode($jsonString, flags:JSON_THROW_ON_ERROR));
    }

    /**
     * Magic method to represent the book as a string
     * @return string
     */
    public function __toString(): string {
        $authorName = $this->author ?? "N/A";
        $isbn = $this->isbn ?? 'N\A';
        $pubDate = $this->publicationDate?->format('Y-m-d') ?? "N\A";
        $storageDate = $this->getStorageDate()?->format('Y-m-d \a\t H-i-s');
        $genre = $this->genre?->value ?? "N\A";
        $cover = $this->cover ??  "N\A";
        $content = $this->content ?? "N\A";
        $page = $this->pages ?? "N\A";

        return "
            ID: {$this->id}
            ISBN: {$isbn}
            Title: {$this->title}
            Author: {$authorName}
            Genre: {$genre}
            Cover: {$cover}
            Content : {$content}
            Published: {$pubDate}
            Storage date : {$storageDate}
            Pages: {$page}
        ";
    }
}
