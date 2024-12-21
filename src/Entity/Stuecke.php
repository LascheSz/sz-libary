<?php

namespace App\Entity;

use App\Repository\StueckeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: StueckeRepository::class)]
class Stuecke
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $stueck_art = null;

    #[ORM\Column]
    private ?bool $jugenzug_stueck = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $anschaffungsdatum = null;

    #[ORM\Column]
    private ?int $interpreter_id = null;

    #[ORM\Column]
    private ?int $bearbeiter_id = null;

    #[ORM\OneToMany(mappedBy: 'stueck', targetEntity: StueckStimme::class)]
    private Collection $stueckStimmen;

    public function __construct()
    {
        $this->stueckStimmen = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isStueckArt(): ?bool
    {
        return $this->stueck_art;
    }

    public function setStueckArt(bool $stueck_art): static
    {
        $this->stueck_art = $stueck_art;

        return $this;
    }

    public function isJugenzugStueck(): ?bool
    {
        return $this->jugenzug_stueck;
    }

    public function setJugenzugStueck(bool $jugenzug_stueck): static
    {
        $this->jugenzug_stueck = $jugenzug_stueck;

        return $this;
    }

    public function getAnschaffungsdatum(): ?\DateTimeInterface
    {
        return $this->anschaffungsdatum;
    }

    public function setAnschaffungsdatum(\DateTimeInterface $anschaffungsdatum): static
    {
        $this->anschaffungsdatum = $anschaffungsdatum;

        return $this;
    }

    public function getInterpreterId(): ?int
    {
        return $this->interpreter_id;
    }

    public function setInterpreterId(int $interpreter_id): static
    {
        $this->interpreter_id = $interpreter_id;

        return $this;
    }

    public function getBearbeiterId(): ?int
    {
        return $this->bearbeiter_id;
    }

    public function setBearbeiterId(int $bearbeiter_id): static
    {
        $this->bearbeiter_id = $bearbeiter_id;

        return $this;
    }

    public function getStueckStimmen(): Collection
    {
        return $this->stueckStimmen;
    }
}
