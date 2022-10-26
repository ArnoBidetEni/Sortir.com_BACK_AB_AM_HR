<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
#[ApiResource]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $placeId = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $street = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\OneToMany(mappedBy: 'excursionPlace', targetEntity: Excursion::class)]
    private Collection $excursions;

    #[ORM\ManyToOne(inversedBy: 'places')]
    #[ORM\JoinColumn(name:"cityId", referencedColumnName:"city_id", nullable: false)]
    private ?City $city = null;

    public function __construct()
    {
        $this->excursions = new ArrayCollection();
    }

    public function getPlaceId(): ?int
    {
        return $this->placeId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection<int, Excursion>
     */
    public function getExcursions(): Collection
    {
        return $this->excursions;
    }

    public function addExcursion(Excursion $excursion): self
    {
        if (!$this->excursions->contains($excursion)) {
            $this->excursions->add($excursion);
            $excursion->setExcursionPlace($this);
        }

        return $this;
    }

    public function removeExcursion(Excursion $excursion): self
    {
        if ($this->excursions->removeElement($excursion)) {
            // set the owning side to null (unless already changed)
            if ($excursion->getExcursionPlace() === $this) {
                $excursion->setExcursionPlace(null);
            }
        }

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
