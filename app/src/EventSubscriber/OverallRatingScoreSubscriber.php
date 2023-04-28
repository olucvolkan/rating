<?php

namespace App\EventSubscriber;

use App\Entity\Feedback;
use App\Entity\Ratings;
use App\Repository\RatingsRepository;
use App\Service\FeedbackService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;


class OverallRatingScoreSubscriber implements EventSubscriberInterface
{

    /**
     * @var EntityManager $entityManager
     */
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::preRemove,
        ];
    }

    public function postPersist(Ratings $ratings)
    {
        $this->updateOverallRating($ratings->getFeedback());
    }

    public function updateOverallRating(Feedback $feedback)
    {
        $ratingRepository = $this->entityManager->getRepository(Ratings::class);
        $feedbackRepository = $this->entityManager->getRepository(Feedback::class);
        $totalRatingScore = $ratingRepository->getTotalRatingScoreCount($feedback);
        $totalRatingCount = $ratingRepository->getRatingCount($feedback);

        if ($totalRatingCount !== null && $totalRatingScore !== null) {
            $overallRating = $totalRatingScore['totalScoreCount'] / $totalRatingCount['totalCount'];
            $feedback->setOverallRating($overallRating);
        }

        $feedbackRepository->save($feedback, true);
    }

    public function postUpdate(Ratings $ratings)
    {
        $this->updateOverallRating($ratings->getFeedback());
    }

    public function preRemove(Ratings $ratings)
    {
        $this->updateOverallRating($ratings->getFeedback());

    }
}
