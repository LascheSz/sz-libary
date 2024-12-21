<?php

namespace App\Entity;

use App\Repository\InterpreterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterpreterRepository::class)]
class Interpreter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $interpreter_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInterpreterName(): ?string
    {
        return $this->interpreter_name;
    }

    public function setInterpreterName(string $interpreter_name): static
    {
        $this->interpreter_name = $interpreter_name;

        return $this;
    }
}
