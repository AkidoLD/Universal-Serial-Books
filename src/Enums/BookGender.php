<?php
namespace Enums;

/**
 * Enum representing the main genres of books in a library.
 * 
 * Each case represents a genre that a Book object can have.
 * Using this enum ensures consistency when assigning or checking
 * the genre of a book.
 */
enum BookGender: string {
    /** Science Fiction genre */
    case SCIENCE_FICTION = 'Science Fiction';

    /** Fantasy genre */
    case FANTASY = 'Fantasy';

    /** Romance genre */
    case ROMANCE = 'Romance';

    /** Mystery genre */
    case MYSTERY = 'Mystery';

    /** Thriller genre */
    case THRILLER = 'Thriller';

    /** Non-Fiction genre */
    case NON_FICTION = 'Non-Fiction';

    /** History genre */
    case HISTORY = 'History';

    /** Biography genre */
    case BIOGRAPHY = 'Biography';

    /** Children genre */
    case CHILDREN = 'Children';
}
