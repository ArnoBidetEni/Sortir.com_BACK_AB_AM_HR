<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ExcursionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExcursionRepository::class)]
#[ApiResource]
class Excursion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $excursionId = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $limiteDateRegistration = null;

    #[ORM\Column]
    private ?int $maxRegistrationNumber = null;

    #[ORM\ManyToOne(inversedBy: 'excursions')]
    #[ORM\JoinColumn(referencedColumnName:"placeId", nullable: false)]
    private ?Place $excursionPlace = null;

    #[ORM\ManyToOne(inversedBy: 'excursions')]
    #[ORM\JoinColumn(referencedColumnName:"statusId", nullable: false)]
    private ?Status $status = null;

    #[ORM\ManyToOne(inversedBy: 'excursions')]
    #[ORM\JoinColumn(referencedColumnName:"participantId", nullable: false)]
    private ?Participant $organisator = null;

    #[ORM\ManyToMany(targetEntity: Participant::class, inversedBy: 'excursions')]
    private Collection $participants;

    #[ORM\ManyToOne(inversedBy: 'excursions')]
    #[ORM\JoinColumn(referencedColumnName:"campusId", nullable: false)]
    private ?Campus $campus = null;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getExcursionId(): ?int
    {
        return $this->excursionId;
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

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getLimiteDateRegistration(): ?\DateTimeInterface
    {
        return $this->limiteDateRegistration;
    }

    public function setLimiteDateRegistration(\DateTimeInterface $limiteDateRegistration): self
    {
        $this->limiteDateRegistration = $limiteDateRegistration;

        return $this;
    }

    public function getMaxRegistrationNumber(): ?int
    {
        return $this->maxRegistrationNumber;
    }

    public function setMaxRegistrationNumber(int $maxRegistrationNumber): self
    {
        $this->maxRegistrationNumber = $maxRegistrationNumber;

        return $this;
    }

    public function getExcursionPlace(): ?Place
    {
        return $this->excursionPlace;
    }

    public function setExcursionPlace(?Place $excursionPlace): self
    {
        $this->excursionPlace = $excursionPlace;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOrganisator(): ?Participant
    {
        return $this->organisator;
    }

    public function setOrganisator(?Participant $organisator): self
    {
        $this->organisator = $organisator;

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
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        $this->participants->removeElement($participant);

        return $this;
    }

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function setCampus(?Campus $campus): self
    {
        $this->campus = $campus;

        return $this;
    }
}
