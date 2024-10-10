<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     */
    private $datecreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $version;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Archivage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $validation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $approbation;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="docategorie")
     */
    private $categorie;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datevalidation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateapprobation;

   

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $createur;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datearchivage;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(?int $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getArchivage(): ?bool
    {
        return $this->Archivage;
    }

    public function setArchivage(?bool $Archivage): self
    {
        $this->Archivage = $Archivage;

        return $this;
    }

    public function getValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(?bool $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    public function getApprobation(): ?bool
    {
        return $this->approbation;
    }

    public function setApprobation(?bool $approbation): self
    {
        $this->approbation = $approbation;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function __toString()
    {
        return $this->getTitre();
    }

    public function getDatevalidation(): ?\DateTimeInterface
    {
        return $this->datevalidation;
    }

    public function setDatevalidation(?\DateTimeInterface $datevalidation): self
    {
        $this->datevalidation = $datevalidation;

        return $this;
    }

    public function getDateapprobation(): ?\DateTimeInterface
    {
        return $this->dateapprobation;
    }

    public function setDateapprobation(?\DateTimeInterface $dateapprobation): self
    {
        $this->dateapprobation = $dateapprobation;

        return $this;
    }

    

    public function getCreateur(): ?string
    {
        return $this->createur;
    }

    public function setCreateur(?string $createur): self
    {
        $this->createur = $createur;

        return $this;
    }

    public function getDatearchivage(): ?\DateTimeInterface
    {
        return $this->datearchivage;
    }

    public function setDatearchivage(?\DateTimeInterface $datearchivage): self
    {
        $this->datearchivage = $datearchivage;

        return $this;
    }

   
   
}
