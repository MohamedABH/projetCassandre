<?php

namespace App\Entity;

use App\Repository\AuditTaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuditTaskRepository::class)]
class AuditTask
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_task = null;

    #[ORM\Column(length: 255)]
    private ?string $description_task = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTask(): ?string
    {
        return $this->name_task;
    }

    public function setNameTask(string $name_task): static
    {
        $this->name_task = $name_task;

        return $this;
    }

    public function getDescriptionTask(): ?string
    {
        return $this->description_task;
    }

    public function setDescriptionTask(string $description_task): static
    {
        $this->description_task = $description_task;

        return $this;
    }
}
