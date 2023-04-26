<?php

namespace App\Entity;

use App\Repository\RatingQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: RatingQuestionRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class RatingQuestion implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ratingQuestions')]
    #[ORM\JoinColumn(name:"project", referencedColumnName: "id")]
    private ?Project $project = null;

    #[ORM\Column(length: 255)]
    private ?string $question_text = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'ratingQuestion', targetEntity: Ratings::class)]
    private Collection $ratings;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $deletedAt = null;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getQuestionText(): ?string
    {
        return $this->question_text;
    }

    public function setQuestionText(string $question_text): self
    {
        $this->question_text = $question_text;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return RatingQuestion
     */
    public function setCreatedAt(?\DateTime $createdAt): RatingQuestion
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Collection<int, Ratings>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Ratings $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
            $rating->setRatingQuestion($this);
        }

        return $this;
    }

    public function removeRating(Ratings $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getRatingQuestion() === $this) {
                $rating->setRatingQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime|null $deletedAt
     * @return RatingQuestion
     */
    public function setDeletedAt(?\DateTime $deletedAt): RatingQuestion
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'project' => $this->getProject()->getId(),
            'questionText' => $this->getQuestionText(),
        ];
    }
}
