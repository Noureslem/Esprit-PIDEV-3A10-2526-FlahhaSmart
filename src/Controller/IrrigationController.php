<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\IrrigationInput;
use App\Service\IrrigationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/irrigation', name: 'app_irrigation_')]
final class IrrigationController extends AbstractController
{
    public function __construct(private readonly IrrigationService $irrigationService)
    {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('frontend/irrigation/index.html.twig', [
            'cultures' => $this->irrigationService->getSupportedCultures(),
        ]);
    }

    #[Route('/analyse', name: 'analyse', methods: ['POST'])]
    public function analyse(Request $request): JsonResponse
    {
        try {
            $payload = json_decode((string) $request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $input = $this->buildInput($payload);
            $plan = $this->irrigationService->generateIrrigationPlan($input);

            return $this->json([
                'success' => true,
                'data' => $plan->toArray(),
            ]);
        } catch (\InvalidArgumentException $e) {
            return $this->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            return $this->json([
                'success' => false,
                'error' => 'Erreur pendant le calcul du plan d irrigation.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function buildInput(array $payload): IrrigationInput
    {
        $culture = (string) ($payload['culture'] ?? '');
        $surface = (float) ($payload['surface'] ?? 0);
        $soilMoisture = (int) ($payload['soilMoisture'] ?? 0);
        $lastWaterAmount = (float) ($payload['lastWaterAmount'] ?? 0);
        $location = trim((string) ($payload['location'] ?? ''));

        $lastIrrigationDateRaw = (string) ($payload['lastIrrigationDate'] ?? '');
        $lastIrrigationDate = \DateTimeImmutable::createFromFormat('Y-m-d', $lastIrrigationDateRaw);

        if (!$lastIrrigationDate instanceof \DateTimeImmutable) {
            throw new \InvalidArgumentException('Date de derniere irrigation invalide.');
        }

        if ($culture === '') {
            throw new \InvalidArgumentException('La culture est obligatoire.');
        }

        if ($surface <= 0) {
            throw new \InvalidArgumentException('La surface doit etre superieure a 0.');
        }

        if ($soilMoisture < 0 || $soilMoisture > 100) {
            throw new \InvalidArgumentException('Humidite du sol doit etre entre 0 et 100.');
        }

        if ($location === '') {
            throw new \InvalidArgumentException('La ville est obligatoire pour recuperer la meteo.');
        }

        return new IrrigationInput(
            culture: $culture,
            surface: $surface,
            soilMoisture: $soilMoisture,
            lastIrrigationDate: $lastIrrigationDate,
            lastWaterAmount: $lastWaterAmount,
            location: $location,
        );
    }
}
