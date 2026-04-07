<?php

namespace App\Controller;

use App\Service\GeminiChatService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;

#[Route('/api/chatbot', name: 'app_chatbot_')]
final class ChatbotController extends AbstractController
{
    #[Route('/ask', name: 'ask', methods: ['POST'])]
    public function ask(
        Request $request,
        GeminiChatService $chatService,
        LoggerInterface $logger
    ): JsonResponse {
        try {
            // Decode JSON request
            $data = json_decode($request->getContent(), associative: true);

            if (!is_array($data) || !isset($data['message'])) {
                return $this->json([
                    'success' => false,
                    'error' => 'Missing "message" field in request',
                ], Response::HTTP_BAD_REQUEST);
            }

            $message = trim((string)$data['message']);

            // Basic validation
            if (empty($message)) {
                return $this->json([
                    'success' => false,
                    'error' => 'Message cannot be empty',
                ], Response::HTTP_BAD_REQUEST);
            }

            if (strlen($message) > 2000) {
                return $this->json([
                    'success' => false,
                    'error' => 'Message is too long (max 2000 characters)',
                ], Response::HTTP_BAD_REQUEST);
            }

            // Get response from chatbot service
            $response = $chatService->ask($message);

            return $this->json([
                'success' => true,
                'response' => $response,
                'timestamp' => (new \DateTime())->format('Y-m-d H:i:s'),
            ]);
        } catch (\InvalidArgumentException $e) {
            $logger->warning('Invalid chatbot request', ['error' => $e->getMessage()]);

            return $this->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            $logger->error('Unexpected error in chatbot endpoint', [
                'exception' => $e::class,
                'message' => $e->getMessage(),
            ]);

            return $this->json([
                'success' => false,
                'error' => 'An unexpected error occurred. Please try again later.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Health check endpoint for chatbot
     */
    #[Route('/health', name: 'health', methods: ['GET'])]
    public function health(): JsonResponse
    {
        return $this->json([
            'status' => 'ok',
            'service' => 'gemini-chatbot',
        ]);
    }
}
