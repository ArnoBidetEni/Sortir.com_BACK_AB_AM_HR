<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CampusRepository::class)]
#[ApiResource]
#[Get()]
#[GetCollection()]
#[Post(security:"is_granted('ROLE_ADMIN')")]
#[Put(security:"is_granted('ROLE_ADMIN')")]
#[Patch(security:"is_granted('ROLE_ADMIN')")]
#[Delete(security:"is_granted('ROLE_ADMIN')")]
class Campus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['excursion', 'excursions'])]
    private ?int $campusId = null;

    #[ORM\Column(length: 100)]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'campus', targetEntity: Excursion::class)]
    private Collection $excursions;

    #[ORM\OneToMany(mappedBy: 'campus', targetEntity: Participant::class)]
    private Collection $participants;

    public function __construct()
    {
        $this->excursions = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }

    public function getCampusId(): ?int
    {
        return $this->campusId;
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
            $excursion->setCampus($this);
        }

        return $this;
    }

    public function removeExcursion(Excursion $excursion): self
    {
        if ($this->excursions->removeElement($excursion)) {
            // set the owning side to null (unless already changed)
            if ($excursion->getCampus() === $this) {
                $excursion->setCampus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Participant>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->setCampus($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getCampus() === $this) {
                $participant->setCampus(null);
            }
        }

        return $this;
    }
}
