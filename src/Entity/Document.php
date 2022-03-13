<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
#[Vich\Uploadable]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomDocument;

    //Gestion des documents avec vich_uploader

    #[Vich\UploadableField(mapping: 'documents', fileNameProperty: 'documentName', size: 'imageSize')]
    private ?File $doumentFile;

    #[ORM\Column(type: 'string')]
    private ?string $documentName;

    #[ORM\Column(type: 'integer')]
    private ?int $documentSize = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: Dossier::class, inversedBy: 'pieceJointe')]
    #[ORM\JoinColumn(nullable: false)]
    private $dossier;

    // fin gestion

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDocument(): ?string
    {
        return $this->nomDocument;
    }

    public function setNomDocument(string $nomDocument): self
    {
        $this->nomDocument = $nomDocument;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|null $documentFile
     */
    public function setDocumentFile(?File $documentFile = null): void
    {
        $this->doumentFile = $documentFile;

        if (null !== $this->doumentFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getDoumentFile(): ?File
    {
        return $this->doumentFile;
    }

    public function setDocumentName(?string $documentName): void
    {
        $this->documentName = $documentName;
    }

    public function getDocumentName(): ?string
    {
        return $this->documentName;
    }

    public function setDocumentSize(?int $documentSize): void
    {
        $this->documentSize = $documentSize;
    }

    public function getDocumentSize(): ?int
    {
        return $this->documentSize;
    }

    // TODO metre en place l'uplad de fichier

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
