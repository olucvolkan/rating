<?php

namespace App\Controller;

use App\Entity\Ratings;
use App\Form\RatingType;
use App\Service\RatingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/rating', name: 'app_rating')]
class RatingController extends AbstractController
{

    /**
     * @var RatingService
     */
    private RatingService $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    #[Route('/', name: 'create_rating', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $rating = new Ratings();
        $form = $this->createForm(RatingType::class, $rating);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid()) {
            $rating = $this->ratingService->createRating($form->getData());

            return $this->json([
                'code' => Response::HTTP_OK,
                'payload' => [
                    'ratings' => $rating
                ]
            ]);
        }

        return $this->json([
            'code' => Response::HTTP_BAD_REQUEST,
            'error' => $form->getErrors()
        ]);

    }

    #[Route('/{id<\d+>}', name: 'update_rating', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {

        $rating = $this->ratingService->getRating($id);
        $form = $this->createForm(RatingType::class, $rating);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid()) {
            $rating = $this->ratingService->createRating($form->getData());

            return $this->json([
                'code' => Response::HTTP_OK,
                'payload' => [
                    'ratings' => $rating
                ]
            ]);
        }

        return $this->json([
            'code' => Response::HTTP_BAD_REQUEST,
            'error' => $form->getErrors()
        ]);

    }

    #[Route('/', name: 'get_rating', methods: ['GET'])]
    public function getRating(): JsonResponse
    {
        return $this->json([
            'code' => Response::HTTP_OK,
            'payload' => [
                'ratings' => $this->ratingService->getRatings()
            ]
        ]);
    }

    #[Route('/{id<\d+>}', name: 'delete_rating', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->ratingService->removeRating($id);
        return $this->json([
            'code' => Response::HTTP_OK,
        ]);
    }
}
