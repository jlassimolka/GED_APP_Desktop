<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $fullname;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $email;

      /**
     * @ORM\Column(type="json")
     */
    private $roles;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    
    private $image;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tel;

    /**
     * @ORM\ManyToMany(targetEntity=Departement::class, inversedBy="depuser")
     */
    private $departements;

    /**
     * @ORM\ManyToMany(targetEntity=Processus::class, mappedBy="userprocessus")
     */
    private $processuses;

 
    public function __construct()
    {
        $this->departements = new ArrayCollection();
        $this->processuses = new ArrayCollection();
    
    }
 
  

  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

 
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(?int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }
 
  public function __toString()
    {
        return $this->getEmail();
    }

  /**
   * @return Collection<int, Departement>
   */
  public function getDepartements(): Collection
  {
      return $this->departements;
  }

  public function addDepartement(Departement $departements): self
  {
      if (!$this->departements->contains($departements)) {
        
          $this->departements[] = $departements;
         
      }

      return $this;
  }

  public function removeDepartement(Departement $departement): self
  {
      if ($this->departements->removeElement($departement)) {
          $departement->removeDepuser($this);
      }

      return $this;
  }

  /**
   * @return Collection<int, Processus>
   */
  public function getProcessuses(): Collection
  {
      return $this->processuses;
  }

  public function addProcessus(Processus $processus): self
  {
      if (!$this->processuses->contains($processus)) {
          $this->processuses[] = $processus;
          $processus->addUserprocessu($this);
      }

      return $this;
  }

  public function removeProcessus(Processus $processus): self
  {
      if ($this->processuses->removeElement($processus)) {
          $processus->removeUserprocessu($this);
      }

      return $this;
  }

}
