<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SpeciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpeciesRepository::class)]
#[ApiResource]
class Species
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $language = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $skinColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lifespan = null;

    #[ORM\ManyToMany(targetEntity: People::class, mappedBy: 'species')]
    private Collection $peoples;

    public function __construct()
    {
        $this->peoples = new ArrayCollection();
    }

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

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getSkinColor(): ?string
    {
        return $this->skinColor;
    }

    public function setSkinColor(?string $skinColor): self
    {
        $this->skinColor = $skinColor;

        return $this;
    }

    public function getLifespan(): ?string
    {
        return $this->lifespan;
    }

    public function setLifespan(?string $lifespan): self
    {
        $this->lifespan = $lifespan;

        return $this;
    }

    /**
     * @return Collection<int, People>
     */
    public function getPeoples(): Collection
    {
        return $this->peoples;
    }

    public function addPeople(People $people): self
    {
        if (!$this->peoples->contains($people)) {
            $this->peoples->add($people);
            $people->addSpecies($this);
        }

        return $this;
    }

    public function removePeople(People $people): self
    {
        if ($this->peoples->removeElement($people)) {
            $people->removeSpecies($this);
        }

        return $this;
    }
}
