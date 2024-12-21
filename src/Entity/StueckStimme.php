<?php

namespace App\Entity;

use App\Repository\StueckStimmeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StueckStimmeRepository::class)]
class StueckStimme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $stuck_id = null;

    #[ORM\Column]
    private ?int $stimme_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStuckId(): ?int
    {
        return $this->stuck_id;
    }

    public function setStuckId(int $stuck_id): static
    {
        $this->stuck_id = $stuck_id;

        return $this;
    }

    public function getStimmeId(): ?int
    {
        return $this->stimme_id;
    }

    public function setStimmeId(int $stimme_id): static
    {
        $this->stimme_id = $stimme_id;

        return $this;
    }
}
