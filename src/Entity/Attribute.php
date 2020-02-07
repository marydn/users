<?php

declare(strict_types=1);

namespace Users\Entity;

final class Attribute
{
    public int $id;
    public string $name;

    public function __construct(?string $name = null)
    {
        $this->name = $name;
    }
}