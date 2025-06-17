<?php

namespace App\Controller\Skyrim;

use App\Entity\Skyrim\Effect;
use App\Entity\Skyrim\Ingredient;
use App\Repository\Skyrim\EffectRepository;
use App\Repository\Skyrim\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlchemyController extends AbstractController
{
    public function __construct(
        private readonly IngredientRepository $ingredientRepository,
        private readonly EffectRepository $effectRepository,
    ) {
    }

    #[Route(path: '/skyrim/alchemy', name: 'skyrim_alchemy', methods: ['GET'])]
    public function alchemy(): Response
    {
        return $this->render('skyrim/alchemy.html.twig', [
            'ingredients' => $this->ingredientRepository->findOrdered(),
            'effects' => $this->effectRepository->findOrdered(),
        ]);
    }

    #[Route(path: '/skyrim/ajax/ingredient/{ingredient}', name: 'skyrim_ingredient')]
    public function ingredient(Ingredient $ingredient): Response
    {
        $effects = [];
        foreach ($ingredient->getEffects() as $effect) {
            /** @var int $effectId */
            $effectId = $effect->getId();
            $effects[$effectId] = $this->ingredientRepository->findAllWithEffect($effectId);
        }

        return $this->render('skyrim/ingredient.html.twig', [
            'ingredient' => $ingredient,
            'effects' => $effects,
            'ingredients' => $this->ingredientRepository->findReactingWithIngredient($ingredient),
        ]);
    }

    #[Route(path: '/skyrim/ajax/effect/{effect}', name: 'skyrim_effect')]
    public function effect(Effect $effect): Response
    {
        /** @var int $effectId */
        $effectId = $effect->getId();

        return $this->render('skyrim/effect.html.twig', [
            'effect' => $effect,
            'ingredients' => $this->ingredientRepository->findAllWithEffect($effectId),
        ]);
    }
}
