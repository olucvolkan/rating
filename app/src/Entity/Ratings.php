<?php

namespace App\Entity;

use Andante\SoftDeletableBundle\SoftDeletable\SoftDeletableInterface;
use Andante\SoftDeletableBundle\SoftDeletable\SoftDeletableTrait;
use App\Repository\RatingsRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: RatingsRepository::class)]
class Ratings implements \JsonSerializable, SoftDeletableInterface
{
    use SoftDeletableTrait;
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
    private ?\DateTime $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

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

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     * @return Ratings
     */
    public function setCreatedAt(?\DateTime $createdAt): Ratings
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    #[ArrayShape(['id' => "int|null", 'feedback' => "\App\Entity\Feedback|null", 'ratingQuestion' => "\App\Entity\RatingQuestion|null", 'score' => "float|null", 'createdAt' => "\DateTime|null"])] public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'feedback' => $this->getFeedback(),
            'ratingQuestion' => $this->getRatingQuestion(),
            'score' => $this->getScore(),
            'createdAt' => $this->getCreatedAt()
        ];
    }

}
