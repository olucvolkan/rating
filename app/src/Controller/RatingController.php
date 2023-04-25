<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rating', name: 'app_rating')]
class RatingController extends AbstractController
{
    #[Route('/', name: 'create_rating',methods: ['POST'])]
    public function create(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RatingController.php',
        ]);
    }

    #[Route('/', name: 'update_rating',methods: ['PUT'])]
    public function update(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RatingController.php',
        ]);
    }

    #[Route('/', name: 'get_rating',methods: ['GET'])]
    public function get(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RatingController.php',
        ]);
    }

    #[Route('/', name: 'delete_rating',methods: ['DELETE'])]
    public function delete(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RatingController.php',
        ]);
    }
}
