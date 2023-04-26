<?php


namespace App\Service;


use App\Entity\Ratings;
use App\Repository\RatingsRepository;

class RatingService
{
    /**
     * @var RatingsRepository
     */
    private RatingsRepository $ratingsRepository;

    public function __construct(RatingsRepository $ratingsRepository)
    {
        $this->ratingsRepository = $ratingsRepository;
    }

    /**
     * @return array
     */
    public function getRatings(): array
    {
        return $this->ratingsRepository->findAll();
    }

    /**
     * @param Ratings $ratings
     * @return Ratings
     */
    public function createRating(Ratings $ratings): Ratings
    {
       return $this->ratingsRepository->save($ratings, true);
    }

    /**
     * @param int $id
     * @return Ratings|null
     */
    public function getRating(int $id): ?Ratings
    {
        return $this->ratingsRepository->findOneBy(['id' => $id]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function removeRating(int $id): void
    {
        $rating = $this->ratingsRepository->findOneBy(['id' => $id]);
        $this->ratingsRepository->remove($rating,true);
    }

}