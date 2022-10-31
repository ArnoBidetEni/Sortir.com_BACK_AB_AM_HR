<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
#[ApiResource]
#[Get()]
#[GetCollection()]
#[Post(security:"is_granted('ROLE_ADMIN')")]
#[Delete(security:"is_granted('ROLE_ADMIN')")]
#[Put(security:"is_granted('ROLE_ADMIN')")]
#[Patch(security:"is_granted('ROLE_ADMIN')")]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['excursion', 'excursions'])]
    private ?int $placeId = null;

    #[ORM\Column(length: 100)]
    #[Groups(['excursion', 'excursions'])]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    #[Groups(['excursion', 'excursions'])]
    private ?string $street = null;

    #[ORM\Column]
    #[Groups(['excursion', 'excursions'])]
    private ?float $latitude = null;

    #[ORM\Column]
    #[Groups(['excursion', 'excursions'])]
    private ?float $longitude = null;

    #[ORM\OneToMany(mappedBy: 'excursionPlace', targetEntity: Excursion::class)]
    private Collection $excursions;

    #[ORM\ManyToOne(inversedBy: 'places')]
    #[ORM\JoinColumn(name:"cityId", referencedColumnName:"city_id", nullable: false)]
    #[Groups(['excursion', 'excursions'])]
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
