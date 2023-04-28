<?php


namespace App\Service;


use App\Entity\Feedback;
use App\Entity\Ratings;
use App\Repository\FeedbackRepository;
use App\Repository\RatingsRepository;

class FeedbackService
{
    /**
     * @var FeedbackRepository
     */
    private FeedbackRepository $feedbackRepository;

    /**
     * @var RatingsRepository
     */
    private RatingsRepository $ratingsRepository;

    public function __construct(FeedbackRepository $feedbackRepository, RatingsRepository $ratingsRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
        $this->ratingsRepository = $ratingsRepository;
    }

    /**
     * @return array
     */
    public function getFeedbacks(): array
    {
        return $this->feedbackRepository->findAll();
    }

    /**
     * @param Feedback $feedback
     * @return Feedback
     */
    public function createFeedback(Feedback $feedback): Feedback
    {
        return $this->feedbackRepository->save($feedback, true);
    }

    /**
     * @param int $id
     * @return Feedback|null
     */
    public function getFeedback(int $id): ?Feedback
    {
        return $this->feedbackRepository->findOneBy(['id' => $id]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function removeFeedback(int $id): void
    {
        $rating = $this->feedbackRepository->findOneBy(['id' => $id]);
        $this->feedbackRepository->remove($rating, true);
    }

}