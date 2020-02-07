<?php

declare(strict_types=1);

namespace Users\Entity;

final class UserHasAttribute
{
    public int $id;
    public User $user;
    public Attribute $attribute;
    public string $value;

    public function __construct(User $user, Attribute $attribute, string $value)
    {
        $this->user      = $user;
        $this->attribute = $attribute;
        $this->value     = $value;
    }
}