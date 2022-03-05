<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
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

    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

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

    
}
