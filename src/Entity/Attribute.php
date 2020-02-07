<?php

declare(strict_types=1);

namespace Users\Entity;

class Attribute
{
    public int $id;
    public string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function __toString()
    {
        return $this->title;
    }
}