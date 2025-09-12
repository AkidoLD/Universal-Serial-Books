<?php

namespace App\Interfaces;

interface JsonSerializable {
    public function toJson(): string;
    public static function fromJson(string $jsonString): self;
}