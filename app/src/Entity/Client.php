<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\UniqueConstraint;



#[ORM\Table(name: "client")]
#[UniqueConstraint(name: "UNIQ_70E4FA78F85E0677", columns: ["username"])]
#[Index(fields: ["username"], name: "username_idx")]
#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Column(name: "username", type: "string", length: 128, nullable: false, options: [
        "comment" => "Email as the username"
    ])]
    private $username;

    #[Column(name: "password", type: "string", length: 96, nullable: false, options: [
        "comment" => "Use password hash with BCRYPT"
    ])]
    private $password;

    #[Column(name: "created", type: "datetime", nullable: false)]
    private $created;

    #[Column(name: "first_name", type: "string", length: 96, nullable: false)]
    private $firstName;


    #[Column(name: "last_name", type: "string", length: 96, nullable: false)]
    private $lastName;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Feedback::class)]
    private Collection $feedback;

    public function __construct()
    {
        $this->feedback = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection<int, Feedback>
     */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    public function addFeedback(Feedback $feedback): self
    {
        if (!$this->feedback->contains($feedback)) {
            $this->feedback->add($feedback);
            $feedback->setClient($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): self
    {
        if ($this->feedback->removeElement($feedback)) {
            // set the owning side to null (unless already changed)
            if ($feedback->getClient() === $this) {
                $feedback->setClient(null);
            }
        }

        return $this;
    }


}
