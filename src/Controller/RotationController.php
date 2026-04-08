<?php

namespace App\Controller;

use App\Model\Parcelle;
use App\Service\RotationCultureService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/rotation', name: 'app_rotation_')]
final class RotationController extends AbstractController
{
    public function __construct(
        private readonly RotationCultureService $rotationService,
    ) {}

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('frontend/rotation/index.html.twig', $this->getRotationViewData());
    }

    #[Route('/embed', name: 'embed', methods: ['GET'])]
    public function embed(): Response
    {
        return $this->render('frontend/rotation/embed.html.twig', $this->getRotationViewData());
    }

    private function getRotationViewData(): array
    {
        return [
            'types_sol' => [
                'sableux' => 'Sableux',
                'limoneux' => 'Limoneux',
                'argileux' => 'Argileux',
                'tourbeux' => 'Tourbeux',
            ],
            'cultures' => [
                'ble' => 'Blé',
                'riz' => 'Riz',
                'tomate' => 'Tomate',
                'lentille' => 'Lentille',
                'pois' => 'Pois',
                'mais' => 'Maïs',
                'patate' => 'Patate',
                'betterave' => 'Betterave',
                'oignon' => 'Oignon',
                'carotte' => 'Carotte',
            ],
        ];
    }

    #[Route('/analyser', name: 'analyser', methods: ['POST'])]
    public function analyser(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            // Validation
            if (!$this->validerDonnees($data)) {
                return new JsonResponse(['error' => 'Données invalides'], Response::HTTP_BAD_REQUEST);
            }

            // Créer la parcelle
            $parcelle = new Parcelle(
                surface: (float) $data['surface'],
                typeSol: $data['type_sol'],
                derniereCulture: $data['derniere_culture'] ?? null,
                avantDerniereCulture: $data['avant_derniere_culture'] ?? null,
                niveauAzote: (int) $data['azote'],
                niveauPhosphore: (int) $data['phosphore'],
                niveauPotassium: (int) $data['potassium'],
                ph: (float) $data['ph'],
                anneesDepuisJachere: (int) ($data['annees_jachaire'] ?? 0),
            );

            // Générer recommandations
            $recommendations = $this->rotationService->genererRecommandations($parcelle);

            // Générer plan
            $plan = $this->rotationService->genererPlanRotation($parcelle, (int) ($data['duree_plan'] ?? 5));

            return new JsonResponse([
                'success' => true,
                'recommendations' => array_map($this->serializeRecommandation(...), array_slice($recommendations, 0, 5)),
                'plan' => $this->serializePlan($plan),
                'resume' => [
                    'surface' => $parcelle->getSurface(),
                    'type_sol' => $parcelle->getTypeSol(),
                    'nutrients' => [
                        'azote' => $parcelle->getNiveauAzote(),
                        'phosphore' => $parcelle->getNiveauPhosphore(),
                        'potassium' => $parcelle->getNiveauPotassium(),
                        'total' => $parcelle->getNiveauNutrientsTotal(),
                    ],
                    'ph' => $parcelle->getPH(),
                    'etat_sol' => $parcelle->isSolEpuise() ? 'Épuisé' : 'Bon',
                ],
            ]);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['error' => 'Une erreur est survenue : ' . $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * API JSON pour utilisation externe
     */
    #[Route('/api', name: 'api', methods: ['POST'])]
    public function api(Request $request): JsonResponse
    {
        return $this->analyser($request);
    }

    /**
     * Valide les données du formulaire
     */
    private function validerDonnees(?array $data): bool
    {
        return $data &&
               isset($data['surface']) && is_numeric($data['surface']) && $data['surface'] > 0 &&
               isset($data['type_sol']) && is_string($data['type_sol']) &&
               isset($data['azote']) && is_numeric($data['azote']) && $data['azote'] >= 0 && $data['azote'] <= 10 &&
               isset($data['phosphore']) && is_numeric($data['phosphore']) && $data['phosphore'] >= 0 && $data['phosphore'] <= 10 &&
               isset($data['potassium']) && is_numeric($data['potassium']) && $data['potassium'] >= 0 && $data['potassium'] <= 10 &&
               isset($data['ph']) && is_numeric($data['ph']) && $data['ph'] > 0 && $data['ph'] < 14;
    }

    /**
     * Sérialise une recommandation pour JSON
     */
    private function serializeRecommandation($rec): array
    {
        return [
            'culture' => $rec->getCulture(),
            'famille' => $rec->getFamille(),
            'score' => $rec->getScoreCompatibilite(),
            'label' => $rec->getScoreLabel(),
            'couleur' => $rec->getScoreColor(),
            'raison' => $rec->getRaisonRecommandation(),
            'benefices' => $rec->getBeneficesSol(),
            'periode' => $rec->getPeriodeOptimale(),
            'impact' => $rec->getImpactNutrients(),
        ];
    }

    /**
     * Sérialise un plan de rotation pour JSON
     */
    private function serializePlan($plan): array
    {
        return [
            'annees' => $plan->getAnnees(),
            'score' => $plan->getScoreGlobal(),
            'duree' => $plan->getDuree(),
            'diversite' => $plan->getDiversite(),
        ];
    }
}
