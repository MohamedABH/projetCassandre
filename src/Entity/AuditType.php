<?php

namespace App\Entity;

use App\Repository\AuditTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuditTypeRepository::class)]
class AuditType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $auditTypeName = null;

    /**
     * @var Collection<int, Audit>
     */
    #[ORM\OneToMany(targetEntity: Audit::class, mappedBy: 'auditType')]
    private Collection $audits;

    /**
     * @var Collection<int, AuditTask>
     */
    #[ORM\ManyToMany(targetEntity: AuditTask::class)]
    private Collection $auditTasks;

    public function __construct()
    {
        $this->audits = new ArrayCollection();
        $this->auditTasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuditTypeName(): ?string
    {
        return $this->auditTypeName;
    }

    public function setAuditTypeName(string $auditTypeName): static
    {
        $this->auditTypeName = $auditTypeName;

        return $this;
    }

    /**
     * @return Collection<int, Audit>
     */
    public function getAudits(): Collection
    {
        return $this->audits;
    }

    public function addAudit(Audit $audit): static
    {
        if (!$this->audits->contains($audit)) {
            $this->audits->add($audit);
            $audit->setAuditType($this);
        }

        return $this;
    }

    public function removeAudit(Audit $audit): static
    {
        if ($this->audits->removeElement($audit)) {
            // set the owning side to null (unless already changed)
            if ($audit->getAuditType() === $this) {
                $audit->setAuditType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AuditTask>
     */
    public function getAuditTasks(): Collection
    {
        return $this->auditTasks;
    }

    public function addAuditTask(AuditTask $auditTask): static
    {
        if (!$this->auditTasks->contains($auditTask)) {
            $this->auditTasks->add($auditTask);
        }

        return $this;
    }

    public function removeAuditTask(AuditTask $auditTask): static
    {
        $this->auditTasks->removeElement($auditTask);

        return $this;
    }
}
