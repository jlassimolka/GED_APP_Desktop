<?php

namespace App\Entity;

use App\Repository\ProcessusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=ProcessusRepository::class)
 * @UniqueEntity(
 *     fields={"nom"},
 *     errorPath="nom",
 *     message="This processus is already "
 * )
 */
class Processus
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
    private $nom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecreation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libprocessus;

    

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="processuses")
     */
    private $userprocessus;

    public function __construct()
    {
        $this->userprocessus = new ArrayCollection();
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

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(?\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getLibprocessus(): ?string
    {
        return $this->libprocessus;
    }

    public function setLibprocessus(?string $libprocessus): self
    {
        $this->libprocessus = $libprocessus;

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

    /**
     * @return Collection<int, user>
     */
    public function getUserprocessus(): Collection
    {
        return $this->userprocessus;
    }

    public function addUserprocessu(user $userprocessu): self
    {
        if (!$this->userprocessus->contains($userprocessu)) {
            $this->userprocessus[] = $userprocessu;
        }

        return $this;
    }

    public function removeUserprocessu(user $userprocessu): self
    {
        $this->userprocessus->removeElement($userprocessu);

        return $this;
    }
}
