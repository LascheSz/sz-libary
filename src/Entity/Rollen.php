<?php

namespace App\Entity;

use App\Repository\RollenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RollenRepository::class)]
class Rollen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $rollen_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRollenName(): ?string
    {
        return $this->rollen_name;
    }

    public function setRollenName(string $rollen_name): static
    {
        $this->rollen_name = $rollen_name;

        return $this;
    }
}
