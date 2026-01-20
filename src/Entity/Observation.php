<?php

namespace App\Entity;

use App\Repository\ObservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObservationRepository::class)]
class Observation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description_observation = null;

    #[ORM\ManyToOne(inversedBy: 'observations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Audit $audit = null;

    #[ORM\ManyToOne(inversedBy: 'observations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AuditTask $task = null;

    #[ORM\ManyToOne(inversedBy: 'observations')]
    private ?Collaborator $observator = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionObservation(): ?string
    {
        return $this->description_observation;
    }

    public function setDescriptionObservation(?string $description_observation): static
    {
        $this->description_observation = $description_observation;

        return $this;
    }

    public function getAudit(): ?Audit
    {
        return $this->audit;
    }

    public function setAudit(?Audit $audit): static
    {
        $this->audit = $audit;

        return $this;
    }

    public function getTask(): ?AuditTask
    {
        return $this->task;
    }

    public function setTask(?AuditTask $task): static
    {
        $this->task = $task;

        return $this;
    }

    public function getObservator(): ?Collaborator
    {
        return $this->observator;
    }

    public function setObservator(?Collaborator $observator): static
    {
        $this->observator = $observator;

        return $this;
    }
}
