<?php

namespace App\Controller;

use App\Service\HomeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/home', name: 'home')]
class HomeController extends AbstractController
{

    /**
     * @var HomeService
     */
    private HomeService $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    #[Route('/{id<\d+>}', name: 'app_home_detail')]
    public function getHomeDetail(int $id):JsonResponse
    {
        $home = $this->homeService->getHomeDetail($id);

        return $this->json([
            'payload' => [
                'home' => $home
            ]],
        );
    }
}
