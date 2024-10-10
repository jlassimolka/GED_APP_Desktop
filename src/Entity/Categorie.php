<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $libcat;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="categorie")
     */
    private $docategorie;

    public function __construct()
    {
        $this->docategorie = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibcat(): ?string
    {
        return $this->libcat;
    }

    public function setLibcat(string $libcat): self
    {
        $this->libcat = $libcat;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
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

    /**
     * @return Collection<int, document>
     */
    public function getDocategorie(): Collection
    {
        return $this->docategorie;
    }

    public function addDocategorie(document $docategorie): self
    {
        if (!$this->docategorie->contains($docategorie)) {
            $this->docategorie[] = $docategorie;
            $docategorie->setCategorie($this);
        }

        return $this;
    }

    public function removeDocategorie(document $docategorie): self
    {
        if ($this->docategorie->removeElement($docategorie)) {
            // set the owning side to null (unless already changed)
            if ($docategorie->getCategorie() === $this) {
                $docategorie->setCategorie(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
   
}
