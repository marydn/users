<?php

declare(strict_types=1);

namespace Users\Service;

use Doctrine\ORM\EntityManagerInterface;
use Users\Entity\User;

final class UserManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findUsersByAttribute($attribute): array
    {
        return $this->entityManager->getRepository(User::class)
            ->findUsersByAttribute($attribute);
    }

    public function addUser(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}