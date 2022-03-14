<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur extends User
{
    #[ORM\OneToOne(mappedBy: 'responsable', targetEntity: Laboratoire::class, cascade: ['persist', 'remove'])]
    private $laboratoire;

    #[ORM\OneToOne(mappedBy: 'responsable', targetEntity: FormationDoctorale::class, cascade: ['persist', 'remove'])]
    private $formationDoctorale;

    #[ORM\OneToOne(mappedBy: 'chefEtablissement', targetEntity: EtablissementDoctoral::class, cascade: ['persist', 'remove'])]
    private $etablissementDoctoral;

    #[ORM\ManyToOne(targetEntity: FormationDoctorale::class, inversedBy: 'chefEtablissementRattache')]
    private $ecoleRattacheFormation;

    #[ORM\Column(type: 'string', length: 255)]
    private $grade;

    #[ORM\OneToMany(mappedBy: 'directeurThese', targetEntity: Dossier::class)]
    private $dossiers;

    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
    }

    public function getLaboratoire(): ?Laboratoire
    {
        return $this->laboratoire;
    }

    public function setLaboratoire(Laboratoire $laboratoire): self
    {
        // set the owning side of the relation if necessary
        if ($laboratoire->getResponsable() !== $this) {
            $laboratoire->setResponsable($this);
        }

        $this->laboratoire = $laboratoire;

        return $this;
    }

    public function getFormationDoctorale(): ?FormationDoctorale
    {
        return $this->formationDoctorale;
    }

    public function setFormationDoctorale(FormationDoctorale $formationDoctorale): self
    {
        // set the owning side of the relation if necessary
        if ($formationDoctorale->getResponsable() !== $this) {
            $formationDoctorale->setResponsable($this);
        }

        $this->formationDoctorale = $formationDoctorale;

        return $this;
    }

    public function getEtablissementDoctoral(): ?EtablissementDoctoral
    {
        return $this->etablissementDoctoral;
    }

    public function setEtablissementDoctoral(EtablissementDoctoral $etablissementDoctoral): self
    {
        // set the owning side of the relation if necessary
        if ($etablissementDoctoral->getChefEtablissement() !== $this) {
            $etablissementDoctoral->setChefEtablissement($this);
        }

        $this->etablissementDoctoral = $etablissementDoctoral;

        return $this;
    }

    public function getEcoleRattacheFormation(): ?FormationDoctorale
    {
        return $this->ecoleRattacheFormation;
    }

    public function setEcoleRattacheFormation(?FormationDoctorale $ecoleRattacheFormation): self
    {
        $this->ecoleRattacheFormation = $ecoleRattacheFormation;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName()." ".$this->getFirstname();
    }

    /**
     * @return Collection<int, Dossier>
     */
    public function getDossiers(): Collection
    {
        return $this->dossiers;
    }

    public function addDossier(Dossier $dossier): self
    {
        if (!$this->dossiers->contains($dossier)) {
            $this->dossiers[] = $dossier;
            $dossier->setDirecteurThese($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getDirecteurThese() === $this) {
                $dossier->setDirecteurThese(null);
            }
        }

        return $this;
    }


}
