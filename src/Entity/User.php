<?php

declare(strict_types=1);

namespace Users\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class User
{
    public int $id;
    public string $name;
    private Collection $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    public function addAttribute(Attribute $attribute, string $value): self
    {
        $element = new UserHasAttribute($this, $attribute, $value);
        if (!$this->attributes->contains($element)) {
            $this->attributes->add($element);
        }

        return $this;
    }

    public function removeAttribute(UserHasAttribute $userHasAttribute)
    {
        if ($this->attributes->contains($userHasAttribute)) {
            $this->attributes->removeElement($userHasAttribute);
        }

        return $this;
    }

    public function getAttributes(): ArrayCollection
    {
        return $this->attributes;
    }
}