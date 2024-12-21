<?php

namespace App\Entity;

use App\Repository\StimmeRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: StimmeRepository::class)]
class Stimme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $stimme_name = null;

    #[ORM\Column(length: 255)]
    private ?int $special_stimme = 0;

    #[ORM\OneToMany(mappedBy: 'stimme', targetEntity: StueckStimme::class)]
    private Collection $stueckStimmen;

    public function __construct()
    {
        $this->stueckStimmen = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStimmeName(): ?string
    {
        return $this->stimme_name;
    }

    public function setStimmeName(string $stimme_name): static
    {
        $this->stimme_name = $stimme_name;

        return $this;
    }

    public function getSpecialStimme(): ?string
    {
        return $this->special_stimme;
    }

    public function setSpecialStimme(string $special_stimme): static
    {
        $this->special_stimme = $special_stimme;

        return $this;
    }

    public function getStueckStimmen(): Collection
    {
        return $this->stueckStimmen;
    }
}
