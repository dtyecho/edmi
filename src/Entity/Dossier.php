<?php

namespace App\Entity;

use App\Repository\DossierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DossierRepository::class)]
class Dossier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'dossier', targetEntity: Etudiant::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $owner;

    #[ORM\Column(type: 'string', length: 255)]
    private $diplomeAcces;

    #[ORM\Column(type: 'string', length: 255)]
    private $specialite;

    #[ORM\Column(type: 'string', length: 255)]
    private $UnivDelivreDiplome;

    #[ORM\Column(type: 'string', length: 255)]
    private $pays;

    #[ORM\Column(type: 'string', length: 255)]
    private $lieuObtentionDiplome;

    #[ORM\Column(type: 'string', length: 255)]
    private $dateObtentionDiplome;


    #[ORM\Column(type: 'string', length: 255)]
    private $themeRecherche;

    #[ORM\Column(type: 'string', length: 255)]
    private $mention;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avisDirecteurTheses;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avisResponsableLabo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avisResponsableDoctorat;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avisDirecteurEcoleDoctoral;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avisChefEcoleRattache;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?Etudiant
    {
        return $this->owner;
    }

    public function setOwner(Etudiant $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getDiplomeAcces(): ?string
    {
        return $this->diplomeAcces;
    }

    public function setDiplomeAcces(string $diplomeAcces): self
    {
        $this->diplomeAcces = $diplomeAcces;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getUnivDelivreDiplome(): ?string
    {
        return $this->UnivDelivreDiplome;
    }

    public function setUnivDelivreDiplome(string $UnivDelivreDiplome): self
    {
        $this->UnivDelivreDiplome = $UnivDelivreDiplome;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getLieuObtentionDiplome(): ?string
    {
        return $this->lieuObtentionDiplome;
    }

    public function setLieuObtentionDiplome(string $lieuObtentionDiplome): self
    {
        $this->lieuObtentionDiplome = $lieuObtentionDiplome;

        return $this;
    }

    public function getDateObtentionDiplome(): ?string
    {
        return $this->dateObtentionDiplome;
    }

    public function setDateObtentionDiplome(string $dateObtentionDiplome): self
    {
        $this->dateObtentionDiplome = $dateObtentionDiplome;

        return $this;
    }

    public function getIntituleDoctorat(): ?string
    {
        return $this->intituleDoctorat;
    }

    public function setIntituleDoctorat(string $intituleDoctorat): self
    {
        $this->intituleDoctorat = $intituleDoctorat;

        return $this;
    }

    public function getThemeRecherche(): ?string
    {
        return $this->themeRecherche;
    }

    public function setThemeRecherche(string $themeRecherche): self
    {
        $this->themeRecherche = $themeRecherche;

        return $this;
    }

    public function getMention(): ?string
    {
        return $this->mention;
    }

    public function setMention(string $mention): self
    {
        $this->mention = $mention;

        return $this;
    }

    public function getAvisDirecteurTheses(): ?string
    {
        return $this->avisDirecteurTheses;
    }

    public function setAvisDirecteurTheses(?string $avisDirecteurTheses): self
    {
        $this->avisDirecteurTheses = $avisDirecteurTheses;

        return $this;
    }

    public function getAvisResponsableLabo(): ?string
    {
        return $this->avisResponsableLabo;
    }

    public function setAvisResponsableLabo(?string $avisResponsableLabo): self
    {
        $this->avisResponsableLabo = $avisResponsableLabo;

        return $this;
    }

    public function getAvisResponsableDoctorat(): ?string
    {
        return $this->avisResponsableDoctorat;
    }

    public function setAvisResponsableDoctorat(?string $avisResponsableDoctorat): self
    {
        $this->avisResponsableDoctorat = $avisResponsableDoctorat;

        return $this;
    }

    public function getAvisDirecteurEcoleDoctoral(): ?string
    {
        return $this->avisDirecteurEcoleDoctoral;
    }

    public function setAvisDirecteurEcoleDoctoral(?string $avisDirecteurEcoleDoctoral): self
    {
        $this->avisDirecteurEcoleDoctoral = $avisDirecteurEcoleDoctoral;

        return $this;
    }

    public function getAvisChefEcoleRattache(): ?string
    {
        return $this->avisChefEcoleRattache;
    }

    public function setAvisChefEcoleRattache(?string $avisChefEcoleRattache): self
    {
        $this->avisChefEcoleRattache = $avisChefEcoleRattache;

        return $this;
    }

    
}
