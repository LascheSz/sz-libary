<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Stuecke
{
    public const STUECK_ART = [
        'Musical',
        'Operette',
        'Oper'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $stueck_art = null;

    #[ORM\Column(type: 'boolean')]
    private bool $jugendzug_stueck = false;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $anschaffungsdatum = null;

    #[ORM\ManyToOne(targetEntity: Interpreter::class, inversedBy: 'stuecke')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Interpreter $interpreter = null;

    #[ORM\ManyToOne(targetEntity: Bearbeiter::class, inversedBy: 'stuecke')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Bearbeiter $bearbeiter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getStueckArt(): ?string
    {
        return $this->stueck_art;
    }

    public function setStueckArt(?string $stueck_art): self
    {
        $this->stueck_art = $stueck_art;
        return $this;
    }

    public function isJugendzugStueck(): bool
    {
        return $this->jugendzug_stueck;
    }

    public function setJugendzugStueck(bool $jugendzug_stueck): self
    {
        $this->jugendzug_stueck = $jugendzug_stueck;
        return $this;
    }

    public function getAnschaffungsdatum(): ?\DateTimeInterface
    {
        return $this->anschaffungsdatum;
    }

    public function setAnschaffungsdatum(?\DateTimeInterface $anschaffungsdatum): self
    {
        $this->anschaffungsdatum = $anschaffungsdatum;
        return $this;
    }

    public function getInterpreter(): ?Interpreter
    {
        return $this->interpreter;
    }

    public function setInterpreter(?Interpreter $interpreter): self
    {
        $this->interpreter = $interpreter;
        return $this;
    }

    public function getBearbeiter(): ?Bearbeiter
    {
        return $this->bearbeiter;
    }

    public function setBearbeiter(?Bearbeiter $bearbeiter): self
    {
        $this->bearbeiter = $bearbeiter;
        return $this;
    }
}