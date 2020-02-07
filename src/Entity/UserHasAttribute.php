<?php

declare(strict_types=1);

namespace Users\Entity;

final class UserHasAttribute
{
    public int $id;
    public User $user;
    public Attribute $attribute;
    public string $value;

    public function __toString()
    {
        return sprintf('%s: %s', (string) $this->attribute, $this->value);
    }
}