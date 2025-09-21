<?php

namespace Router;

use ArrayAccess;
use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;

class Node implements Countable, ArrayAccess, IteratorAggregate {
    private string $key;
    private array $children = [];
    /** 
     * @var callable|null 
     */
    private $handler = null;

    public function __construct(string $key, ?callable $handler = null) {
        $this->key = $key;
        $this->handler = $handler;
    }

    public function getKey(): string {
        return $this->key;
    }
    
    public function addChild(Node $child): void {
        $this->children[] = $child;
    }

    public function addChildren(array $children): void {
        foreach ($children as $child) {
            if (!($child instanceof Node)) {
                throw new InvalidArgumentException("All children must be instances of Node");
            }
            $this->children[] = $child;
        }
    }
    
    public function setHandler(?callable $handler): void {
        $this->handler = $handler;
    }

    public function getHandler(): ?callable {
        return $this->handler;
    }

    public function getChild(string $key): ?Node {
        foreach ($this->children as $child) {
            if ($child->getKey() === $key) {
                return $child;
            }
        }
        return null;
    }

    public function __invoke(...$args) {
        if ($this->handler) {
            return ($this->handler)(...$args);
        }
        return null;
    }
    

    // Implementation of Countable
    public function count(): int {
        return count($this->children);
    }

    // Implementation of ArrayAccess
    public function offsetGet(mixed $offset): ?Node {
        return $this->children[$offset] ?? null;
    }

    public function offsetExists(mixed $offset): bool {
        return isset($this->children[$offset]);
    }

    public function offsetSet(mixed $offset, mixed $value): void {
        if (!($value instanceof Node)) {
            throw new InvalidArgumentException(
                'Error: Only instances of Node can be added as children.'
            );
        }

        if ($offset === null) {
            $this->children[] = $value;
        } else {
            $this->children[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void {
        unset($this->children[$offset]);
    }

    //Implementation of IteratorAggregate
    public function getIterator(): ArrayIterator {
        return new ArrayIterator($this->children);
    }
}
