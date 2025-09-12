<?php

namespace App\Interfaces;

/**
 * Represent a objet can be convert to an `Array`
 */
interface ArrayConvertible{
    /**
     * Convert the `Objet` to an `Array`
     * 
     * @return array
     */
    public function toArray(): array;

    /**
     * Convert an `Array` to an `Object`
     * @param array $array
     * @return void
     */
    public static function fromArray(array $array): self;
}