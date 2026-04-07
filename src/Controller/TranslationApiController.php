<?php

namespace App\Controller;

use App\Service\TranslatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TranslationApiController extends AbstractController
{
    #[Route('/api/translate', name: 'app_api_translate', methods: ['POST'])]
    public function translate(Request $request, TranslatorService $translatorService): JsonResponse
    {
        // Accept JSON or form payload.
        $payload = [];
        try {
            $payload = $request->toArray();
        } catch (\Throwable) {
            $payload = $request->getPayload()->all();
        }

        $text = isset($payload['text']) && is_string($payload['text']) ? $payload['text'] : '';
        $to = isset($payload['to']) && is_string($payload['to']) ? $payload['to'] : '';
        $from = isset($payload['from']) && is_string($payload['from']) ? $payload['from'] : null;

        // CSRF token can be sent in payload or header.
        $token = null;
        if (isset($payload['_token']) && is_string($payload['_token'])) {
            $token = $payload['_token'];
        } elseif (is_string($request->headers->get('X-CSRF-TOKEN'))) {
            $token = $request->headers->get('X-CSRF-TOKEN');
        }

        if (!is_string($token) || !$this->isCsrfTokenValid('ajax_translate', $token)) {
            return new JsonResponse(['error' => 'invalid_csrf'], Response::HTTP_FORBIDDEN);
        }

        try {
            $translated = $translatorService->translate($text, $to, $from);

            return new JsonResponse([
                'text' => $text,
                'translated' => $translated,
                'to' => $to,
                'from' => $from,
            ]);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => 'bad_request', 'message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\RuntimeException $e) {
            return new JsonResponse(['error' => 'service_unavailable', 'message' => $e->getMessage()], Response::HTTP_SERVICE_UNAVAILABLE);
        } catch (\Throwable) {
            return new JsonResponse(['error' => 'server_error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
