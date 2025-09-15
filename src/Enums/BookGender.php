<?php
namespace App\Enums;

/**
 * Enum representing the main genres of books in a library.
 * 
 * Each case represents a genre that a Book object can have.
 * Using this enum ensures consistency when assigning or checking
 * the genre of a book.
 */
enum BookGender: string {
    case SCIENCE_FICTION = 'Science Fiction';
    case FANTASY = 'Fantasy';
    case ROMANCE = 'Romance';
    case MYSTERY = 'Mystery';
    case THRILLER = 'Thriller';
    case NON_FICTION = 'Non-Fiction';
    case HISTORY = 'History';
    case BIOGRAPHY = 'Biography';
    case CHILDREN = 'Children';
    case ADVENTURE = 'Aventure';
}
