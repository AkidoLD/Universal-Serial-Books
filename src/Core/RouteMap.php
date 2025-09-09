<?php
/**
 * Represents an HTTP route as a list of URI segments.
 *
 * This class parses a URI path into segments and provides
 * navigation methods to iterate over them one by one.
 * Useful for custom routing systems.
 *
 * @author akido-ld
 * @version 1.0.0
 */
class RouteMap {
    /**
     * @var array List of URI segments
     */
    private $segments;

    /**
     * @var int Current cursor position in the segment list
     */
    private $cursor;

    /**
     * Constructs a new RouteMap instance from a given URI.
     *
     * @param string $URI The request URI (e.g. "/auth/login/edit")
     */
    public function __construct(string $URI) {
        $this->segments = $this->parsePath($URI);
        $this->cursor = 0;
    }

    /**
     * Splits a URI path into individual segments.
     *
     * @param string $path The URI path to parse
     * @return array An array of non-empty segments
     */
    private function parsePath($path) {
        $segments = [];
        $token = strtok($path, '/');
        while ($token !== false) {
            $segments[] = $token;
            $token = strtok('/');
        }
        return $segments;
    }

    /**
     * Resets the cursor back to the beginning of the route.
     *
     * @return void
     */
    public function reset() {
        $this->cursor = 0;
    }

    /**
     * Checks if there is a next segment available.
     *
     * @return bool True if there is a next segment, false otherwise
     */
    public function hasNext() {
        return sizeof($this->segments) > ($this->cursor);
    }

    /**
     * Returns the next segment and moves the cursor forward.
     *
     * @return string|false The next segment or false if none left
     */
    public function next() {
        return $this->hasNext() ? $this->segments[$this->cursor++] : false;
    }

    /**
     * Gets the current cursor position (useful for debugging).
     *
     * @return int Current position in the segment list
     */
    public function current() {
        return $this->cursor;
    }
}
