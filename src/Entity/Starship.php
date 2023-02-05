<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StarshipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StarshipRepository::class)]
#[ApiResource]
class Starship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $capacity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hyperdriveRating = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getHyperdriveRating(): ?string
    {
        return $this->hyperdriveRating;
    }

    public function setHyperdriveRating(?string $hyperdriveRating): self
    {
        $this->hyperdriveRating = $hyperdriveRating;

        return $this;
    }
}
