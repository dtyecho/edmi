<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numCarteEtudiant;

    #[ORM\OneToOne(mappedBy: 'owner', targetEntity: Dossier::class, cascade: ['persist', 'remove'])]
    private $dossier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCarteEtudiant(): ?string
    {
        return $this->numCarteEtudiant;
    }

    public function setNumCarteEtudiant(?string $numCarteEtudiant): self
    {
        $this->numCarteEtudiant = $numCarteEtudiant;

        return $this;
    }

    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(Dossier $dossier): self
    {
        // set the owning side of the relation if necessary
        if ($dossier->getOwner() !== $this) {
            $dossier->setOwner($this);
        }

        $this->dossier = $dossier;

        return $this;
    }
}
