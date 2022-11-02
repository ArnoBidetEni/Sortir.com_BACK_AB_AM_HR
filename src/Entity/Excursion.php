<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\RegisterForAnExcursion;
use App\Controller\WithdrawFromAnExcursion;
use App\Repository\ExcursionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ExcursionRepository::class)]
#[ApiResource(operations: [
    new Post(
        name: 'registerForAnExcursion',
        uriTemplate: '/excursion/{excursionId}/register/{participantId}',
        controller: RegisterForAnExcursion::class,
        read: false,
        openapiContext: [
            'summary' => 'Register for an excursion', 
            'description' => 'Register as a user for an excursion', 
            'requestBody' => [
                'content' => [
                    'application/json' => [
                        'schema' => [
                            'type' => 'object', 
                            'properties' => "{}"
                        ], 
                        'example' => "{}"
                    ]
                ]
            ]
        ]
    ),
    new Post(
        name: 'withdrawForAnExcursion',
        uriTemplate: '/excursion/{excursionId}/withdraw/{participantId}',
        controller: WithdrawFromAnExcursion::class,
        read: false,
        openapiContext: [
            'summary' => 'Withdraw for an excursion', 
            'description' => 'Withdrawing as a user from an excursion', 
            'requestBody' => [
                'content' => [
                    'application/json' => [
                        'schema' => [
                            'type' => 'object', 
                            'properties' => "{}"
                        ], 
                        'example' => "{}"
                    ]
                ]
            ]
        ]
    ),
])]
#[Get(normalizationContext: ['groups' => ['excursion']])]
#[GetCollection(normalizationContext: ['groups' => ['excursions']])]
#[Post()]
#[Delete(security:"is_granted('ROLE_ADMIN') or object.getOrganisator() == user")]
#[Put(security:"is_granted('ROLE_ADMIN') or object.getOrganisator() == user")]
#[Patch(security:"is_granted('ROLE_ADMIN') or object.getOrganisator() == user")]
class Excursion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['excursion', 'excursions'])]
    private ?int $excursionId = null;

    #[ORM\Column(length: 100)]
    #[Groups(['excursion', 'excursions'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['excursion', 'excursions'])]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column]
    #[Groups(['excursion', 'excursions'])]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['excursion', 'excursions'])]
    private ?\DateTimeInterface $limitDateRegistration = null;

    #[ORM\Column]
    #[Groups(['excursion', 'excursions'])]
    private ?int $maxRegistrationNumber = null;

    #[ORM\ManyToOne(inversedBy: 'excursions')]
    #[ORM\JoinColumn(referencedColumnName:"place_id", nullable: false)]
    #[Groups(['excursion', 'excursions'])]
    private ?Place $excursionPlace = null;

    #[ORM\ManyToOne(inversedBy: 'excursions')]
    #[ORM\JoinColumn(referencedColumnName:"status_id", nullable: false)]
    #[Groups('excursions')]
    private ?Status $status = null;

    #[ORM\ManyToOne(inversedBy: 'organisatorExcursions')]
    #[ORM\JoinColumn(referencedColumnName:"participant_id", nullable: false)]
    #[Groups(['excursion', 'excursions'])]
    private ?Participant $organisator = null;

    #[ORM\ManyToMany(targetEntity: Participant::class, inversedBy: 'excursions')]
    #[ORM\JoinTable(name: 'excursions_participants')]
    #[ORM\JoinColumn(name: 'excursion_id', referencedColumnName: 'excursion_id')]
    #[ORM\InverseJoinColumn(name: 'participant_id', referencedColumnName: 'participant_id')]
    #[Groups(['excursion', 'excursions'])]
    private Collection $participants;

    #[ORM\ManyToOne(inversedBy: 'excursions')]
    #[ORM\JoinColumn(referencedColumnName:"campus_id", nullable: false)]
    #[Groups(['excursion', 'excursions'])]
    private ?Campus $campus = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['excursion', 'excursions'])]
    private ?string $excursionData = null;

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

    public function getLimitDateRegistration(): ?\DateTimeInterface
    {
        return $this->limitDateRegistration;
    }

    public function setLimitDateRegistration(\DateTimeInterface $limitDateRegistration): self
    {
        $this->limitDateRegistration = $limitDateRegistration;

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

    public function getExcursionData(): ?string
    {
        return $this->excursionData;
    }

    public function setExcursionData(?string $excursionData): self
    {
        $this->excursionData = $excursionData;

        return $this;
    }
}
