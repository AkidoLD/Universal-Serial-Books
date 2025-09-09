<?php

namespace App\Exceptions;

/**
 * Class ValidationException
 *
 * Custom exception to handle validation errors in the domain or service layer.
 *
 * Why use it?
 * - To separate validation issues from repository/database errors.
 * - To provide clear feedback when user input or business rules are violated.
 * - Can be used to send meaningful error messages back to the user interface.
 */
class ValidationException extends \Exception {
    /**
     * ValidationException constructor.
     *
     * @param string         $message   A human-readable error message describing the validation issue
     * @param int            $code      Optional error code (default: 0)
     * @param \Throwable|null $previous  The original exception, if any
     */
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null){
        parent::__construct($message, $code, $previous);
    }
}
