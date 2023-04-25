<?php

namespace App\Entity;

use App\Repository\RatingQuestionRepository;
use App\Repository\VicoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;


#[ORM\Entity(repositoryClass: VicoRepository::class)]
#[Index(columns: ["name"], name: "name_idx")]
class Vico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "name", length: 64, nullable: false)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $created = null;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }


}
