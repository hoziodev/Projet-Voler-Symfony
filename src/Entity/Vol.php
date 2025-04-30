<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: VolRepository::class)]
class Vol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'La ville de départ est obligatoire')]
    #[ORM\Column(length: 255)]
    private ?string $villeDepart = null;

    #[Assert\NotBlank(message: "La ville d'arrivée est obligatoire")]
    #[ORM\Column(length: 255)]
    private ?string $villeArrive = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateDepart = null;

    #[Assert\Positive(message: 'Le prix doit être positif')]
    #[ORM\Column]
    private ?float $prixBilletInitiale = null;

    #[ORM\ManyToOne(inversedBy: 'vols')]
    private ?Avion $refAvion = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'refVol')]
    private Collection $reservations;


    #[Assert\GreaterThan('now', message: "L'heure de départ doit être ultérieure")]
    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $heureDepart = null;

    #[ORM\ManyToOne(inversedBy: 'vols')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $refPilote = null;


    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleDepart(): ?string
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(string $villeDepart): static
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    public function getVilleArrive(): ?string
    {
        return $this->villeArrive;
    }

    public function setVilleArrive(string $villeArrive): static
    {
        $this->villeArrive = $villeArrive;

        return $this;
    }

    public function getDateDepart(): ?\DateTime
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTime $dateDepart): static
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getPrixBilletInitiale(): ?float
    {
        return $this->prixBilletInitiale;
    }

    public function setPrixBilletInitiale(float $prixBilletInitiale): static
    {
        $this->prixBilletInitiale = $prixBilletInitiale;

        return $this;
    }


    public function setRefAvion(?Avion $refAvion): static
    {
        $this->refAvion = $refAvion;

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
            $reservation->setRefVol($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRefVol() === $this) {
                $reservation->setRefVol(null);
            }
        }

        return $this;
    }

    public function getRefPilote(): ?user
    {
        return $this->refPilote;
    }

    public function setRefPilote(?user $refPilote): static
    {
        $this->refPilote = $refPilote;

        return $this;
    }

    public function getRefAvion(): ?Avion
    {
        return $this->refAvion;
    }

    public function getHeureDepart(): ?\DateTime
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(\DateTime $heureDepart): static
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }
}
