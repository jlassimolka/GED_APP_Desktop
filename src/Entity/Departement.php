<?php

namespace App\Entity;
use App\Entity\User;
use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
  * @UniqueEntity(
 *     fields={"nom"},
 *     errorPath="nom",
 *     message="This nom is already "
 * )
 */
class Departement
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
     * @ORM\Column(type="string", length=255)
     */
    private $lib_dep;

  
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecreation;

    /**
     * @ORM\ManyToMany(targetEntity=user::class, mappedBy="departements")
     */
    private $depuser;

    public function __construct()
    {
        $this->depuser = new ArrayCollection();
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

    public function getLibDep(): ?string
    {
        return $this->lib_dep;
    }

    public function setLibDep(string $lib_dep): self
    {
        $this->lib_dep = $lib_dep;

        return $this;
    }

 
    public function __toString()
    {
        return $this->getNom();
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

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(?\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getDepuser(): Collection
    {
        return $this->depuser;
    }

    public function addDepuser(user $depuser): self
    {
        if (!$this->depuser->contains($depuser)) {
            $this->depuser[] = $depuser;
            $depuser->addDepartement($this);
        }

        return $this;
    }

    public function removeDepuser(user $depuser): self
    {
        $this->depuser->removeElement($depuser);

        return $this;
    }
}
