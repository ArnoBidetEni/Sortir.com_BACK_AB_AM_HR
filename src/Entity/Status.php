<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
#[ApiResource]
#[Get()]
#[GetCollection()]
#[Post(security:"is_granted('ROLE_ADMIN')")]
#[Delete(security:"is_granted('ROLE_ADMIN')")]
#[Put(security:"is_granted('ROLE_ADMIN')")]
#[Patch(security:"is_granted('ROLE_ADMIN')")]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('excursions')]
    private ?int $statusId = null;

    #[ORM\Column(length: 100)]
    #[Groups('excursions')]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: Excursion::class)]
    private Collection $excursions;

    public function __construct()
    {
        $this->excursions = new ArrayCollection();
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
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
            $excursion->setStatus($this);
        }

        return $this;
    }

    public function removeExcursion(Excursion $excursion): self
    {
        if ($this->excursions->removeElement($excursion)) {
            // set the owning side to null (unless already changed)
            if ($excursion->getStatus() === $this) {
                $excursion->setStatus(null);
            }
        }

        return $this;
    }
}
