<?php

namespace App\Entity;

use App\Repository\LaboratoireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LaboratoireRepository::class)]
class Laboratoire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\OneToOne(inversedBy: 'laboratoire', targetEntity: Professeur::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $responsable;

    #[ORM\OneToMany(mappedBy: 'laboRattache', targetEntity: FormationDoctorale::class)]
    private $formationDoctorales;

    public function __construct()
    {
        $this->formationDoctorales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getResponsable(): ?Professeur
    {
        return $this->responsable;
    }

    public function setResponsable(Professeur $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * @return Collection<int, FormationDoctorale>
     */
    public function getFormationDoctorales(): Collection
    {
        return $this->formationDoctorales;
    }

    public function addFormationDoctorale(FormationDoctorale $formationDoctorale): self
    {
        if (!$this->formationDoctorales->contains($formationDoctorale)) {
            $this->formationDoctorales[] = $formationDoctorale;
            $formationDoctorale->setLaboRattache($this);
        }

        return $this;
    }

    public function removeFormationDoctorale(FormationDoctorale $formationDoctorale): self
    {
        if ($this->formationDoctorales->removeElement($formationDoctorale)) {
            // set the owning side to null (unless already changed)
            if ($formationDoctorale->getLaboRattache() === $this) {
                $formationDoctorale->setLaboRattache(null);
            }
        }

        return $this;
    }
}
