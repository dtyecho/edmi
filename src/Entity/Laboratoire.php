<?php

namespace App\Entity;

use App\Repository\LaboratoireRepository;
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
}
