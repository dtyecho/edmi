<?php

namespace App\Entity;

use App\Repository\FormationDoctoraleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationDoctoraleRepository::class)]
class FormationDoctorale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomFormation;

    #[ORM\OneToOne(inversedBy: 'formationDoctorale', targetEntity: Professeur::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $responsable;

    #[ORM\OneToMany(mappedBy: 'formationDoctorale', targetEntity: EtablissementDoctoral::class)]
    private $ecoleRattache;

    public function __construct()
    {
        $this->ecoleRattache = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFormation(): ?string
    {
        return $this->nomFormation;
    }

    public function setNomFormation(string $nomFormation): self
    {
        $this->nomFormation = $nomFormation;

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
     * @return Collection<int, EtablissementDoctoral>
     */
    public function getEcoleRattache(): Collection
    {
        return $this->ecoleRattache;
    }

    public function addEcoleRattache(EtablissementDoctoral $ecoleRattache): self
    {
        if (!$this->ecoleRattache->contains($ecoleRattache)) {
            $this->ecoleRattache[] = $ecoleRattache;
            $ecoleRattache->setFormationDoctorale($this);
        }

        return $this;
    }

    public function removeEcoleRattache(EtablissementDoctoral $ecoleRattache): self
    {
        if ($this->ecoleRattache->removeElement($ecoleRattache)) {
            // set the owning side to null (unless already changed)
            if ($ecoleRattache->getFormationDoctorale() === $this) {
                $ecoleRattache->setFormationDoctorale(null);
            }
        }

        return $this;
    }


}
