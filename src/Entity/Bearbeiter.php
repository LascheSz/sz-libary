<?php

namespace App\Entity;

use App\Repository\BearbeiterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BearbeiterRepository::class)]
class Bearbeiter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $bearbeiter_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBearbeiterName(): ?string
    {
        return $this->bearbeiter_name;
    }

    public function setBearbeiterName(string $bearbeiter_name): static
    {
        $this->bearbeiter_name = $bearbeiter_name;

        return $this;
    }
}
