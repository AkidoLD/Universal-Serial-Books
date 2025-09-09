<?php

namespace App\Exceptions;
/**
 * Class RepositoryException
 *
 * Custom exception to wrap all low-level repository errors
 * (e.g., database errors, storage errors).
 *
 * Why use it?
 * - To abstract away technical exceptions (like PDOException).
 * - To provide a consistent error type for services and controllers.
 * - To keep the original exception for debugging purposes.
 */
class RepositoryException extends \Exception {
    /**
     * RepositoryException constructor.
     *
     * @param string         $message   A human-readable error message
     * @param int            $code      Optional error code (default: 0)
     * @param \Throwable|null $previous  The original exception (e.g. PDOException),
     *                                  useful for debugging and logging.
     */
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null){
        parent::__construct($message, $code, $previous);
    }
}
