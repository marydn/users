<?php

declare(strict_types=1);

namespace Users\Repository;

use Doctrine\ORM\EntityRepository;

final class UserRepository extends EntityRepository
{
    public function findUsersByAttributeName(string $search): array
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.attributes', 'a');

        $like = $qb->expr()->like('a.value', ':search');

        return $qb->andWhere($like)
            ->setParameter('search', "%$search%")
            ->getQuery()
            ->getResult();
    }
}