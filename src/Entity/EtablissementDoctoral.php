<?php

namespace App\Entity;

use App\Repository\EtablissementDoctoralRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementDoctoralRepository::class)]
class EtablissementDoctoral
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomEtablissement;

    #[ORM\OneToOne(inversedBy: 'etablissementDoctoral', targetEntity: Professeur::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $chefEtablissement;

    #[ORM\ManyToOne(targetEntity: FormationDoctorale::class, inversedBy: 'ecoleRattache')]
    private $formationDoctorale;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nomEtablissement;
    }

    public function setNomEtablissement(string $nomEtablissement): self
    {
        $this->nomEtablissement = $nomEtablissement;

        return $this;
    }

    public function getChefEtablissement(): ?Professeur
    {
        return $this->chefEtablissement;
    }

    public function setChefEtablissement(Professeur $chefEtablissement): self
    {
        $this->chefEtablissement = $chefEtablissement;

        return $this;
    }

    public function getFormationDoctorale(): ?FormationDoctorale
    {
        return $this->formationDoctorale;
    }

    public function setFormationDoctorale(?FormationDoctorale $formationDoctorale): self
    {
        $this->formationDoctorale = $formationDoctorale;

        return $this;
    }
}
