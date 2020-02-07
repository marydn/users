<?php

declare(strict_types=1);

namespace Users\Repository;

use Doctrine\ORM\EntityRepository;

final class UserRepository extends EntityRepository
{
    public function findUsersByAttribute(string $search, ?int $limit = null): array
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c, a')
            ->innerJoin('c.attributes', 'a');

        $like = $qb->expr()->like('a.value', ':search');

        return $qb->andWhere($like)
            ->setMaxResults($limit)
            ->setParameter('search', "%$search%")
            ->getQuery()
            ->getResult();
    }
}