<?php

namespace App\Entity;

use App\Repository\CertificationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CertificationTypeRepository::class)]
class CertificationType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $certificationTypeName = null;

    /**
     * @var Collection<int, Certification>
     */
    #[ORM\OneToMany(targetEntity: Certification::class, mappedBy: 'CertificationType')]
    private Collection $certifications;

    public function __construct()
    {
        $this->certifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCertificationTypeName(): ?string
    {
        return $this->certificationTypeName;
    }

    public function setCertificationTypeName(string $certificationTypeName): static
    {
        $this->certificationTypeName = $certificationTypeName;

        return $this;
    }

    /**
     * @return Collection<int, Certification>
     */
    public function getCertifications(): Collection
    {
        return $this->certifications;
    }

    public function addCertification(Certification $certification): static
    {
        if (!$this->certifications->contains($certification)) {
            $this->certifications->add($certification);
            $certification->setCertificationType($this);
        }

        return $this;
    }

    public function removeCertification(Certification $certification): static
    {
        if ($this->certifications->removeElement($certification)) {
            // set the owning side to null (unless already changed)
            if ($certification->getCertificationType() === $this) {
                $certification->setCertificationType(null);
            }
        }

        return $this;
    }
}
