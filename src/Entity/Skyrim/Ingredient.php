<?php

namespace App\Entity\Skyrim;

use App\Repository\Skyrim\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'skyrim_ingredient')]
#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $nameFR;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $nameEN;

    /**
     * @var Collection<int, Effect>
     */
    #[ORM\ManyToMany(targetEntity: Effect::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinTable(name: 'skyrim_ingredient_effect')]
    private Collection $effects;

    public function __construct(string $nameFR, string $nameEN)
    {
        $this->nameFR = $nameFR;
        $this->nameEN = $nameEN;

        $this->effects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameFR(): string
    {
        return $this->nameFR;
    }

    public function getNameEN(): string
    {
        return $this->nameEN;
    }

    public function addEffect(Effect $effect): self
    {
        $this->effects[] = $effect;

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        $this->effects->removeElement($effect);

        return $this;
    }

    /**
     * @return Collection<int, Effect>
     */
    public function getEffects(): Collection
    {
        return $this->effects;
    }

    public function hasEffect(Effect $effect): bool
    {
        return $this->effects->contains($effect);
    }
}
