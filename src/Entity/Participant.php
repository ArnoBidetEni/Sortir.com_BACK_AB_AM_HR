<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use App\Controller\DisableAUserController;
use App\Controller\EditParticipant;
use App\Controller\GetMeDatasController;
use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
#[ApiResource(operations: [
    new Post(
        name: 'disableUser', 
        uriTemplate: '/disableUser/{participantId}', 
        controller: DisableAUserController::class,
        read: false,
        security:"is_granted('ROLE_ADMIN')"
    ),
    new Get(
        name: 'getMe',
        uriTemplate: '/me', 
        controller: GetMeDatasController::class,
        read: false,
        security:"is_granted('ROLE_ADMIN') || is_granted('ROLE_USER')"
    ),
])]
#[Get(normalizationContext: ['groups' => ['participant']])]
#[GetCollection()]
#[Post(security:"is_granted('ROLE_ADMIN')")]
#[Put(security:"is_granted('ROLE_ADMIN')")]
#[Patch(
    name: 'editParticipant',
    uriTemplate: '/participants/{participantId}',
    controller: EditParticipant::class,
    // read: false,
    security:"is_granted('ROLE_ADMIN')"
)]
#[Delete(security:"is_granted('ROLE_ADMIN')")]
class Participant implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?int $participantId = null;

    #[ORM\Column(length: 100)]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?string $login = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 100)]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 10)]
    #[Assert\Regex('/^(0)[1-9](\d{2}){4}$/m')]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?string $mail = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?bool $administrator = null;

    #[ORM\Column]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?bool $active = null;

    #[ORM\OneToMany(mappedBy: 'organisator', targetEntity: Excursion::class)]
    #[ORM\JoinColumn(referencedColumnName:"id", nullable: false)]
    private Collection $organisatorExcursions;

    #[ORM\ManyToMany(mappedBy: 'participants', targetEntity: Excursion::class)]
    #[ORM\JoinTable(name: 'excursions_participants')]
    private Collection $excursions;

    #[ORM\ManyToOne(inversedBy: 'participants')]
    #[ORM\JoinColumn(referencedColumnName:"campus_id", nullable: false)]
    #[Groups(['excursion', 'excursions', 'participant'])]
    private ?Campus $campus = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('participant')]
    private ?string $picture = null;

    public function __construct()
    {
        $this->organisatorExcursions = new ArrayCollection();
        $this->excursions = new ArrayCollection();
    }

    public function getParticipantId(): ?int
    {
        return $this->participantId;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

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

    /**
     * @see PasswordAuthenticatedUserInterface
     */
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        
        if($this->isAdministrator())
        {
            $roles[] = 'ROLE_ADMIN';

        } else {
            // guarantee every user at least has ROLE_USER
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
