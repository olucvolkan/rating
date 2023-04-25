<?php

namespace App\Entity;

use App\Entity\Client;
use App\Repository\FeedbackRepository;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Vico;
use Doctrine\ORM\Mapping\Index;


#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[Index(columns: ["vico_id"], name: "IDX_2FB3D0EE19F89217")]
#[Index(columns: ["creator_id"], name: "creator_idx")]
#[Index(columns: ["created"], name: "created_idx")]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $created = null;


    #[ORM\Column(name: "title", length: 255, nullable: false)]
    private $title;


    #[ORM\ManyToOne(targetEntity: Vico::class)]
    #[ORM\JoinColumn(name:"vico_id", referencedColumnName: "id")]
    private $vico;


    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(name:"creator_id", referencedColumnName: "id")]
    private $creator;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: RatingQuestion::class)]
    private Collection $ratingQuestions;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Feedback::class)]
    private Collection $feedback;

    public function __construct()
    {
        $this->ratingQuestions = new ArrayCollection();
        $this->feedback = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Project
     */
    public function setId(int $id): Project
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return Project
     */
    public function setCreated(\DateTime $created): Project
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Project
     */
    public function setTitle(string $title): Project
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return \App\Entity\Vico
     */
    public function getVico(): \App\Entity\Vico
    {
        return $this->vico;
    }

    /**
     * @param \App\Entity\Vico $vico
     * @return Project
     */
    public function setVico(\App\Entity\Vico $vico): Project
    {
        $this->vico = $vico;
        return $this;
    }

    /**
     * @return \App\Entity\Client
     */
    public function getCreator(): \App\Entity\Client
    {
        return $this->creator;
    }

    /**
     * @param \App\Entity\Client $creator
     * @return Project
     */
    public function setCreator(\App\Entity\Client $creator): Project
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * @return Collection<int, RatingQuestion>
     */
    public function getRatingQuestions(): Collection
    {
        return $this->ratingQuestions;
    }

    public function addRatingQuestion(RatingQuestion $ratingQuestion): self
    {
        if (!$this->ratingQuestions->contains($ratingQuestion)) {
            $this->ratingQuestions->add($ratingQuestion);
            $ratingQuestion->setProject($this);
        }

        return $this;
    }

    public function removeRatingQuestion(RatingQuestion $ratingQuestion): self
    {
        if ($this->ratingQuestions->removeElement($ratingQuestion)) {
            // set the owning side to null (unless already changed)
            if ($ratingQuestion->getProject() === $this) {
                $ratingQuestion->setProject(null);
            }
        }

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
            $feedback->setProject($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): self
    {
        if ($this->feedback->removeElement($feedback)) {
            // set the owning side to null (unless already changed)
            if ($feedback->getProject() === $this) {
                $feedback->setProject(null);
            }
        }

        return $this;
    }

}
