<?php

namespace App\Entity\Skyrim;

use App\Repository\Skyrim\EffectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'skyrim_effect')]
#[ORM\Entity(repositoryClass: EffectRepository::class)]
class Effect
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $nameFR;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $nameEN;

    public function __construct(string $nameFR, string $nameEN)
    {
        $this->nameFR = $nameFR;
        $this->nameEN = $nameEN;
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
}
