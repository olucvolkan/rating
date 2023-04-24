<?php


namespace App\Service;


use App\Entity\Home;
use App\Repository\HomeRepository;

class HomeService
{
    /**
     * @var HomeRepository
     */
    private HomeRepository $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    /**
     * @param int $homeId
     * @return Home
     */
    public function getHomeDetail(int $homeId):Home
    {
        return $this->homeRepository->findOneBy(['id' =>$homeId]);
    }

}