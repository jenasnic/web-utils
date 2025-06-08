<?php

namespace App\Repository\Skyrim;

use App\Entity\Skyrim\Effect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Effect>
 */
class EffectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Effect::class);
    }

    /**
     * @return array<Effect>
     */
    public function findOrdered(): array
    {
        $queryBuilder = $this
            ->createQueryBuilder('effect')
            ->addOrderBy('effect.nameFR')
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
