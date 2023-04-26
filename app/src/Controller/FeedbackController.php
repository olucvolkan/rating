<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Entity\Ratings;
use App\Form\FeedbackType;
use App\Form\RatingType;
use App\Service\FeedbackService;
use App\Service\RatingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[Route('/feedback', name: 'app_feedback')]
class FeedbackController extends AbstractController
{

    /**
     * @var FeedbackService
     */
    private FeedbackService $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    #[Route('/', name: 'create_feedback', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid()) {
            $feedback = $this->feedbackService->createFeedback($form->getData());
            return $this->json([
                'code' => Response::HTTP_OK,
                'payload' => [
                    'feedback' => $feedback
                ]
            ]);
        }

        return $this->json([
            'code' => Response::HTTP_BAD_REQUEST,
            'error' => $form->getErrors()
        ]);

    }

    #[Route('/{id<\d+>}', name: 'update_feedback', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $feedback = $this->feedbackService->getFeedback($id);
        $form = $this->createForm(FeedbackType::class, $feedback);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid()) {
            $feedback = $this->feedbackService->createFeedback($form->getData());

            return $this->json([
                'code' => Response::HTTP_OK,
                'payload' => [
                    'feedback' => $feedback
                ]
            ]);
        }

        return $this->json([
            'code' => Response::HTTP_BAD_REQUEST,
            'error' => $form->getErrors()
        ]);

    }

    #[Route('/', name: 'get_feedback', methods: ['GET'])]
    public function getFeedbacks(): JsonResponse
    {
        return $this->json([
            'code' => Response::HTTP_OK,
            'payload' => [
                'feedbacks' => $this->feedbackService->getFeedbacks()
            ]
        ]);
    }

    #[Route('/{id<\d+>}', name: 'delete_feedback', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->feedbackService->removeFeedback($id);
        return $this->json([
            'code' => Response::HTTP_OK,
        ]);
    }
}
