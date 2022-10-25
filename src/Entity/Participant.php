<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
#[ApiResource]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $participantId = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $administrator = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\OneToMany(mappedBy: 'organisator', targetEntity: Excursion::class)]
    private Collection $organisatorExcursions;

    #[ORM\ManyToMany(mappedBy: 'participant', targetEntity: Excursion::class)]
    #[ORM\JoinTable(name: 'excursions_participants')]
    #[ORM\JoinColumn(name: "participant_id", referencedColumnName: "participant_id")]
    #[ORM\InverseJoinColumn(name: 'excursion_id', referencedColumnName: 'excursionId')]
    private Collection $excursions;


    public function __construct()
    {
        $this->organisatorExcursions = new ArrayCollection();
        $this->excursions = new ArrayCollection();
    }

    public function getParticipantId(): ?int
    {
        return $this->participantId;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function isAdministrator(): ?bool
    {
        return $this->administrator;
    }

    public function setAdministrator(bool $administrator): self
    {
        $this->administrator = $administrator;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, Excursion>
     */
    public function getOrganisatorExcursions(): Collection
    {
        return $this->organisatorExcursions;
    }

    public function addOrganisatorExcursion(Excursion $excursion): self
    {
        if (!$this->organisatorExcursions->contains($excursion)) {
            $this->organisatorExcursions->add($excursion);
            $excursion->setOrganisator($this);
        }

        return $this;
    }

    public function removeOrganisatorExcursion(Excursion $excursion): self
    {
        if ($this->organisatorExcursions->removeElement($excursion)) {
            // set the owning side to null (unless already changed)
            if ($excursion->getOrganisator() === $this) {
                $excursion->setOrganisator(null);
            }
        }

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
        }

        return $this;
    }

    public function removeExcursion(Excursion $excursion): self
    {
        $this->organisatorExcursions->removeElement($excursion);

        return $this;
    }
}
