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

    #[ORM\ManyToOne(targetEntity: Laboratoire::class, inversedBy: 'formationDoctorales')]
    #[ORM\JoinColumn(nullable: false)]
    private $laboRattache;

    #[ORM\OneToMany(mappedBy: 'formationDoctorale', targetEntity: EtablissementDoctoral::class)]
    private $ecoleRattache;

    #[ORM\ManyToOne(targetEntity: Dossier::class, inversedBy: 'formationDoctorale')]
    private $dossier;

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

    public function getLaboRattache(): ?Laboratoire
    {
        return $this->laboRattache;
    }

    public function setLaboRattache(?Laboratoire $laboRattache): self
    {
        $this->laboRattache = $laboRattache;

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

    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(?Dossier $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }


}
