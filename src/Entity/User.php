<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Modele $refModele = null;

    /**
     * @var Collection<int, Conges>
     */
    #[ORM\OneToMany(targetEntity: Conges::class, mappedBy: 'refPilote')]
    private Collection $conges;

    /**
     * @var Collection<int, Conges>
     */
    #[ORM\OneToMany(targetEntity: Conges::class, mappedBy: 'refValidationAdmin')]
    private Collection $ValidationAdmin;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'refUser')]
    private Collection $reservations;

    /**
     * @var Collection<int, Vol>
     */
    #[ORM\OneToMany(targetEntity: Vol::class, mappedBy: 'refPilote')]
    private Collection $vols;

    public function __construct()
    {
        $this->conges = new ArrayCollection();
        $this->ValidationAdmin = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->vols = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTime
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTime $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getRefModele(): ?Modele
    {
        return $this->refModele;
    }

    public function setRefModele(?Modele $refModele): static
    {
        $this->refModele = $refModele;

        return $this;
    }

    /**
     * @return Collection<int, Conges>
     */
    public function getConges(): Collection
    {
        return $this->conges;
    }

    public function addConge(Conges $conge): static
    {
        if (!$this->conges->contains($conge)) {
            $this->conges->add($conge);
            $conge->setRefPilote($this);
        }

        return $this;
    }

    public function removeConge(Conges $conge): static
    {
        if ($this->conges->removeElement($conge)) {
            // set the owning side to null (unless already changed)
            if ($conge->getRefPilote() === $this) {
                $conge->setRefPilote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Conges>
     */
    public function getValidationAdmin(): Collection
    {
        return $this->ValidationAdmin;
    }

    public function addValidationAdmin(Conges $validationAdmin): static
    {
        if (!$this->ValidationAdmin->contains($validationAdmin)) {
            $this->ValidationAdmin->add($validationAdmin);
            $validationAdmin->setRefValidationAdmin($this);
        }

        return $this;
    }

    public function removeValidationAdmin(Conges $validationAdmin): static
    {
        if ($this->ValidationAdmin->removeElement($validationAdmin)) {
            // set the owning side to null (unless already changed)
            if ($validationAdmin->getRefValidationAdmin() === $this) {
                $validationAdmin->setRefValidationAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setRefUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRefUser() === $this) {
                $reservation->setRefUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vol>
     */
    public function getVols(): Collection
    {
        return $this->vols;
    }

    public function addVol(Vol $vol): static
    {
        if (!$this->vols->contains($vol)) {
            $this->vols->add($vol);
            $vol->setRefPilote($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): static
    {
        if ($this->vols->removeElement($vol)) {
            // set the owning side to null (unless already changed)
            if ($vol->getRefPilote() === $this) {
                $vol->setRefPilote(null);
            }
        }

        return $this;
    }
}
