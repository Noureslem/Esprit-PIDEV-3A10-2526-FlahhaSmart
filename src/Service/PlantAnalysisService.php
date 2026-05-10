<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\DiseaseDiagnosisDTO;
use App\DTO\PlantNetAnalysisResultDTO;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class PlantAnalysisService
{
    public function __construct(
        private readonly PlantNetService $plantNetService,
        private readonly DiseaseAiClient $diseaseAiClient,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function analyze(
        UploadedFile $image,
        string $organ,
        string $language,
        bool $includeDiseases,
        ?string $requestId = null,
    ): PlantNetAnalysisResultDTO {
        $plantIdentification = $this->plantNetService->identify(
            image: $image,
            organ: $organ,
            language: $language,
        );

        if (!$includeDiseases) {
            return $plantIdentification;
        }

        try {
            $payload = $this->diseaseAiClient->predictDisease($image, $requestId);
            $diseases = $this->mapDiseasePayloadToDtos($payload);

            return new PlantNetAnalysisResultDTO(
                bestMatch: $plantIdentification->bestMatch,
                suggestions: $plantIdentification->suggestions,
                diseases: $diseases,
                remainingRequests: $plantIdentification->remainingRequests,
                apiVersion: $plantIdentification->apiVersion,
            );
        } catch (\Throwable $e) {
            $this->logger->warning('Disease AI microservice unavailable.', [
                'exception' => $e::class,
                'message' => $e->getMessage(),
            ]);

            return $plantIdentification;
        }
    }

    /**
     * @param array<string, mixed> $payload
     * @return list<DiseaseDiagnosisDTO>
     */
    private function mapDiseasePayloadToDtos(array $payload): array
    {
        $predictions = $payload['predictions'] ?? null;
        if (!is_array($predictions)) {
            $top = $payload['top_prediction'] ?? null;
            if (is_array($top)) {
                $predictions = [$top];
            } else {
                return [];
            }
        }

        $items = [];
        foreach (array_slice($predictions, 0, 3) as $item) {
            if (!is_array($item)) {
                continue;
            }

            $name = trim((string) ($item['disease'] ?? ''));
            if ($name === '') {
                $name = 'Diagnostic inconnu';
            }

            $confidence = (float) ($item['confidence'] ?? 0.0);
            $severity = isset($item['severity']) ? trim((string) $item['severity']) : null;
            if ($severity === '') {
                $severity = null;
            }

            $recommendations = [];
            $rawRecommendations = $item['recommendations'] ?? null;
            if (is_array($rawRecommendations)) {
                foreach ($rawRecommendations as $rec) {
                    if (!is_string($rec)) {
                        continue;
                    }
                    $rec = trim($rec);
                    if ($rec !== '') {
                        $recommendations[] = $rec;
                    }
                }
            }

            $items[] = new DiseaseDiagnosisDTO(
                name: $name,
                confidence: $confidence,
                severity: $severity,
                recommendations: $recommendations,
            );
        }

        return $items;
    }
}
