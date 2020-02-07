<?php

declare(strict_types=1);

namespace Users\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class User
{
    public int $id;
    public string $name;
    public Collection $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    public function addAttribute(UserHasAttribute $userHasAttribute): self
    {
        $userHasAttribute->user = $this;
        if (!$this->attributes->contains($userHasAttribute)) {
            $this->attributes->add($userHasAttribute);
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

    public function getAttributes(): Collection
    {
        return $this->attributes;
    }
}