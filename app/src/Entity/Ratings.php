<?php

namespace App\Entity;

use App\Repository\RatingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatingsRepository::class)]
class Ratings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ratings')]
    #[ORM\JoinColumn(name:"feedback", referencedColumnName: "id")]
    private ?Feedback $feedback = null;

    #[ORM\ManyToOne(inversedBy: 'ratings')]
    #[ORM\JoinColumn(name:"rating_question", referencedColumnName: "id")]
    private ?RatingQuestion $ratingQuestion = null;

    #[ORM\Column]
    private ?float $score = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeedback(): ?Feedback
    {
        return $this->feedback;
    }

    public function setFeedback(?Feedback $feedback): self
    {
        $this->feedback = $feedback;

        return $this;
    }

    public function getRatingQuestion(): ?RatingQuestion
    {
        return $this->ratingQuestion;
    }

    public function setRatingQuestion(?RatingQuestion $ratingQuestion): self
    {
        $this->ratingQuestion = $ratingQuestion;

        return $this;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(float $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
