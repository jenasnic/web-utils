<?php

namespace App\Repository\Skyrim;

use App\Entity\Skyrim\Effect;
use App\Entity\Skyrim\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ingredient>
 */
class IngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingredient::class);
    }

    /**
     * @return array<Ingredient>
     */
    public function findOrdered(): array
    {
        $queryBuilder = $this
            ->createQueryBuilder('ingredient')
            ->addOrderBy('ingredient.nameFR')
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return array<Ingredient>
     */
    public function findAllWithEffect(int $effectId): array
    {
        $queryBuilder = $this
            ->createQueryBuilder('ingredient')
            ->innerJoin('ingredient.effects', 'effect', Join::WITH, 'effect.id = :effectId')
            ->setParameter('effectId', $effectId)
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * Allows to get all ingredients reacting with specified ingredient (i.e. with common effects).
     *
     * @return array<Ingredient>
     */
    public function findReactingWithIngredient(Ingredient $ingredient): array
    {
        $effectIds = array_map(fn (Effect $effect) => $effect->getId(), $ingredient->getEffects()->toArray());

        $queryBuilder = $this->createQueryBuilder('ingredient');

        $queryBuilder
            ->innerJoin('ingredient.effects', 'effect')
            ->andWhere($queryBuilder->expr()->in('effect.id', $effectIds))
            ->andWhere($queryBuilder->expr()->neq('ingredient.id', $ingredient->getId()))
            ->orderBy('ingredient.nameFR')
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
