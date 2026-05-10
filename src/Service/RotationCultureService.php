<?php

namespace App\Service;

use App\Model\Parcelle;
use App\Model\PlanRotation;
use App\Model\RecommandationCulture;

/**
 * Service de recommandation et génération de plans de rotation des cultures
 * Contient toute la logique métier
 */
final class RotationCultureService
{
    private const BASE_CONNAISSANCE = [
        'cultures' => [
            'ble' => [
                'famille' => 'cereales',
                'besoins_azote' => 7,
                'besoins_phosphore' => 6,
                'besoins_potassium' => 5,
                'ph_optimal' => 6.5,
                'ph_min' => 6.0,
                'ph_max' => 7.5,
                'types_sol' => ['argileux', 'limoneux'],
                'periode_plantation' => 'septembre-octobre',
            ],
            'riz' => [
                'famille' => 'cereales',
                'besoins_azote' => 8,
                'besoins_phosphore' => 5,
                'besoins_potassium' => 6,
                'ph_optimal' => 6.5,
                'ph_min' => 5.5,
                'ph_max' => 7.5,
                'types_sol' => ['limoneux', 'argileux'],
                'periode_plantation' => 'avril-mai',
            ],
            'tomate' => [
                'famille' => 'solanacees',
                'besoins_azote' => 6,
                'besoins_phosphore' => 7,
                'besoins_potassium' => 8,
                'ph_optimal' => 6.8,
                'ph_min' => 6.0,
                'ph_max' => 7.0,
                'types_sol' => ['limoneux', 'sableux'],
                'periode_plantation' => 'mars-avril',
            ],
            'lentille' => [
                'famille' => 'legumineuses',
                'besoins_azote' => 2,
                'besoins_phosphore' => 5,
                'besoins_potassium' => 5,
                'ph_optimal' => 6.5,
                'ph_min' => 6.0,
                'ph_max' => 7.5,
                'types_sol' => ['argileux', 'limoneux'],
                'periode_plantation' => 'decembre-janvier',
            ],
            'pois' => [
                'famille' => 'legumineuses',
                'besoins_azote' => 2,
                'besoins_phosphore' => 5,
                'besoins_potassium' => 6,
                'ph_optimal' => 6.5,
                'ph_min' => 6.0,
                'ph_max' => 7.4,
                'types_sol' => ['limoneux', 'sableux'],
                'periode_plantation' => 'octobre-novembre',
            ],
            'mais' => [
                'famille' => 'cereales',
                'besoins_azote' => 9,
                'besoins_phosphore' => 7,
                'besoins_potassium' => 6,
                'ph_optimal' => 6.5,
                'ph_min' => 5.5,
                'ph_max' => 7.5,
                'types_sol' => ['limoneux', 'sableux'],
                'periode_plantation' => 'avril-mai',
            ],
            'patate' => [
                'famille' => 'solanacees',
                'besoins_azote' => 7,
                'besoins_phosphore' => 6,
                'besoins_potassium' => 8,
                'ph_optimal' => 6.0,
                'ph_min' => 5.0,
                'ph_max' => 7.0,
                'types_sol' => ['sableux', 'limoneux'],
                'periode_plantation' => 'fevrier-mars',
            ],
            'betterave' => [
                'famille' => 'chenopodiees',
                'besoins_azote' => 6,
                'besoins_phosphore' => 6,
                'besoins_potassium' => 7,
                'ph_optimal' => 6.8,
                'ph_min' => 6.0,
                'ph_max' => 7.5,
                'types_sol' => ['limoneux', 'argileux'],
                'periode_plantation' => 'mars-avril',
            ],
            'oignon' => [
                'famille' => 'alliacees',
                'besoins_azote' => 6,
                'besoins_phosphore' => 5,
                'besoins_potassium' => 5,
                'ph_optimal' => 6.5,
                'ph_min' => 6.0,
                'ph_max' => 7.5,
                'types_sol' => ['sableux', 'limoneux'],
                'periode_plantation' => 'novembre-fevrier',
            ],
            'carotte' => [
                'famille' => 'apiacees',
                'besoins_azote' => 5,
                'besoins_phosphore' => 5,
                'besoins_potassium' => 6,
                'ph_optimal' => 6.5,
                'ph_min' => 6.0,
                'ph_max' => 7.0,
                'types_sol' => ['sableux', 'limoneux'],
                'periode_plantation' => 'fevrier-avril',
            ],
            'jachère' => [
                'famille' => 'jachère',
                'besoins_azote' => -3,
                'besoins_phosphore' => 0,
                'besoins_potassium' => 0,
                'ph_optimal' => 6.5,
                'ph_min' => 5.0,
                'ph_max' => 8.0,
                'types_sol' => ['tout'],
                'periode_plantation' => 'annuel',
            ],
        ],
        'incompatibilites' => [
            'tomate' => ['patate', 'aubergine'],
            'ble' => ['seigle'],
            'pois' => ['feve'],
            'mais' => ['sorgho'],
        ],
        'successions_benefiques' => [
            'legumineuses' => ['cereales', 'solanacees', 'chenopodiees'],
            'cereales' => ['legumineuses', 'solanacees'],
            'solanacees' => ['legumineuses', 'apiacees'],
            'alliacees' => ['legumineuses', 'cereales'],
            'apiacees' => ['cereales', 'legumineuses'],
        ],
    ];

    public function genererRecommandations(Parcelle $parcelle): array
    {
        $recommendations = [];

        foreach (self::BASE_CONNAISSANCE['cultures'] as $culture => $data) {
            if ($culture === 'jachère') {
                continue;
            }

            $score = $this->calculerScoreCulture($parcelle, $culture, $data);

            if ($score > 0) {
                $recommendations[] = new RecommandationCulture(
                    culture: $culture,
                    famille: $data['famille'],
                    scoreCompatibilite: $score,
                    raisonRecommandation: $this->genererRaison($parcelle, $culture, $data),
                    beneficesSol: $this->genererBenefices($culture, $data),
                    periodeOptimale: $data['periode_plantation'],
                    impactNutrients: [
                        'azote' => $data['besoins_azote'],
                        'phosphore' => $data['besoins_phosphore'],
                        'potassium' => $data['besoins_potassium'],
                    ],
                );
            }
        }

        // Jachère recommandée si sol épuisé
        if ($parcelle->isSolEpuise() && $parcelle->getAnneesDepuisJachere() > 2) {
            $recommendations[] = new RecommandationCulture(
                culture: 'jachère',
                famille: 'jachère',
                scoreCompatibilite: 90,
                raisonRecommandation: 'Votre sol est épuisé. Une jachère restaurera la fertilité.',
                beneficesSol: 'Restauration complète des nutriments et de la structure du sol',
                periodeOptimale: 'annuel',
                impactNutrients: ['azote' => 0, 'phosphore' => 0, 'potassium' => 0],
            );
        }

        // Trier par score décroissant
        usort($recommendations, fn ($a, $b) => $b->getScoreCompatibilite() <=> $a->getScoreCompatibilite());

        return $recommendations;
    }

    public function genererPlanRotation(Parcelle $parcelle, int $annees = 5): PlanRotation
    {
        $meilleurPlan = null;
        $meilleurScore = -1;

        $iterations = min(200, max(100, $annees * 50));

        for ($i = 0; $i < $iterations; $i++) {
            $plan = $this->simulerPlanRotation($parcelle, $annees);
            $score = $this->evaluerPlan($plan, $parcelle);

            if ($score > $meilleurScore) {
                $meilleurScore = $score;
                $meilleurPlan = $plan;
            }
        }

        return $meilleurPlan ?? $this->creerPlanParDefaut($parcelle, $annees);
    }

    /**
     * Simule un plan de rotation aléatoire
     */
    private function simulerPlanRotation(Parcelle $parcelle, int $annees): PlanRotation
    {
        $plan = [];
        $nutrientsActuels = [
            'azote' => $parcelle->getNiveauAzote(),
            'phosphore' => $parcelle->getNiveauPhosphore(),
            'potassium' => $parcelle->getNiveauPotassium(),
        ];

        $dernieresCultures = $parcelle->getDerniereCulture() ? [$parcelle->getDerniereCulture()] : [];

        for ($annee = 0; $annee < $annees; $annee++) {
            $candidates = [];

            foreach (self::BASE_CONNAISSANCE['cultures'] as $culture => $data) {
                if ($this->peutEtrePlantee($culture, $dernieresCultures, $nutrientsActuels, $parcelle)) {
                    $score = $this->calculerScoreCulture($parcelle, $culture, $data);
                    if ($score > 20) {
                        $candidates[$culture] = max(1, $score);
                    }
                }
            }

            if (empty($candidates)) {
                $candidates['jachère'] = 50;
            }

            // Sélection aléatoire pondérée
            $cultureSiege = $this->selectionnerAleatoirePointee($candidates);
            $plan[$annee] = $cultureSiege;

            // Mise à jour de l'historique
            $dernieresCultures = array_slice([$cultureSiege] + $dernieresCultures, 0, 2);

            // Mise à jour des nutriments
            if (isset(self::BASE_CONNAISSANCE['cultures'][$cultureSiege])) {
                $nutrientsActuels['azote'] -= self::BASE_CONNAISSANCE['cultures'][$cultureSiege]['besoins_azote'];
                $nutrientsActuels['phosphore'] -= self::BASE_CONNAISSANCE['cultures'][$cultureSiege]['besoins_phosphore'];
                $nutrientsActuels['potassium'] -= self::BASE_CONNAISSANCE['cultures'][$cultureSiege]['besoins_potassium'];

                // Limite entre 0 et 10
                foreach ($nutrientsActuels as &$niveau) {
                    $niveau = max(0, min(10, $niveau));
                }
            }
        }

        return new PlanRotation($plan, 50);
    }

    /**
     * Évalue la qualité d'un plan de rotation
     */
    private function evaluerPlan(PlanRotation $plan, Parcelle $parcelle): int
    {
        $score = 50;

        // Bonus diversité
        $diversite = $plan->getDiversite();
        $nbAnnees = $plan->getDuree();
        $score += ($diversite / $nbAnnees) * 30;

        // Pénalité répétition
        $annees = $plan->getAnnees();
        for ($i = 0; $i < count($annees) - 1; $i++) {
            if ($annees[$i] === $annees[$i + 1]) {
                $score -= 10;
            }
        }

        // Bonus pour successions bénéfiques
        for ($i = 0; $i < count($annees) - 1; $i++) {
            $culture1 = $annees[$i];
            $culture2 = $annees[$i + 1];

            $famille1 = self::BASE_CONNAISSANCE['cultures'][$culture1]['famille'] ?? null;
            $famille2 = self::BASE_CONNAISSANCE['cultures'][$culture2]['famille'] ?? null;

            if ($famille1 && $famille2 && isset(self::BASE_CONNAISSANCE['successions_benefiques'][$famille1])) {
                if (in_array($famille2, self::BASE_CONNAISSANCE['successions_benefiques'][$famille1])) {
                    $score += 15;
                }
            }
        }

        // Pénalité incompatibilités
        for ($i = 0; $i < count($annees) - 1; $i++) {
            if ($this->sontIncompatibles($annees[$i], $annees[$i + 1])) {
                $score -= 30;
            }
        }

        return max(0, min(100, $score));
    }

    /**
     * Calcule le score de compatibilité d'une culture
     */
    private function calculerScoreCulture(Parcelle $parcelle, string $culture, array $data): int
    {
        $score = 50;

        // Incompatibilité avec culture précédente
        if ($parcelle->getDerniereCulture() && $this->sontIncompatibles($parcelle->getDerniereCulture(), $culture)) {
            return 0;
        }

        if ($parcelle->getDerniereCulture() && $parcelle->getDerniereCulture() === $culture) {
            $score -= 20;
        }

        if ($parcelle->getAvantDerniereCulture() && $parcelle->getAvantDerniereCulture() === $culture) {
            $score -= 10;
        }

        // Compatibilité sol
        if (!in_array('tout', $data['types_sol']) && !in_array($parcelle->getTypeSol(), $data['types_sol'])) {
            $score -= 25;
        } else {
            $score += 10;
        }

        // Compatibilité pH
        $phDiff = abs($parcelle->getPH() - $data['ph_optimal']);
        if ($phDiff > 1) {
            $score -= 15;
        } elseif ($phDiff < 0.5) {
            $score += 15;
        }

        // Adéquation nutriments
        $scoreNutrients = $this->calculerScoreNutriments(
            $parcelle,
            $data['besoins_azote'],
            $data['besoins_phosphore'],
            $data['besoins_potassium']
        );
        $score += $scoreNutrients;

        // Bonus légumineuses pour sol pauvre
        if ($data['famille'] === 'legumineuses' && $parcelle->isAzotePauvre()) {
            $score += 20;
        }

        // Bonus jachère pour sol épuisé
        if ($culture === 'jachère' && $parcelle->isSolEpuise()) {
            $score += 25;
        }

        // Succession bénéfique
        if ($parcelle->getDerniereCulture()) {
            $famillePrecedente = self::BASE_CONNAISSANCE['cultures'][$parcelle->getDerniereCulture()]['famille'] ?? null;
            if ($famillePrecedente && isset(self::BASE_CONNAISSANCE['successions_benefiques'][$famillePrecedente])) {
                if (in_array($data['famille'], self::BASE_CONNAISSANCE['successions_benefiques'][$famillePrecedente])) {
                    $score += 25;
                }
            }
        }

        return max(0, min(100, $score));
    }

    /**
     * Calcule le score basé sur les nutriments
     */
    private function calculerScoreNutriments(Parcelle $parcelle, int $besoinsN, int $besoinsP, int $besoinsK): int
    {
        $score = 0;

        // Azote
        if ($parcelle->getNiveauAzote() >= $besoinsN) {
            $score += 10;
        } elseif ($parcelle->getNiveauAzote() >= $besoinsN - 2) {
            $score += 5;
        } else {
            $score -= 15;
        }

        // Phosphore
        if ($parcelle->getNiveauPhosphore() >= $besoinsP) {
            $score += 10;
        } elseif ($parcelle->getNiveauPhosphore() >= $besoinsP - 2) {
            $score += 5;
        } else {
            $score -= 10;
        }

        // Potassium
        if ($parcelle->getNiveauPotassium() >= $besoinsK) {
            $score += 10;
        } elseif ($parcelle->getNiveauPotassium() >= $besoinsK - 2) {
            $score += 5;
        } else {
            $score -= 10;
        }

        return $score;
    }

    /**
     * Génère une raison textuelle
     */
    private function genererRaison(Parcelle $parcelle, string $culture, array $data): string
    {
        $raisons = [];

        if (in_array($parcelle->getTypeSol(), $data['types_sol'])) {
            $raisons[] = "Très compatible avec votre type de sol ({$parcelle->getTypeSol()})";
        }

        $phDiff = abs($parcelle->getPH() - $data['ph_optimal']);
        if ($phDiff < 0.5) {
            $raisons[] = "pH optimal pour cette culture";
        }

        if ($data['famille'] === 'legumineuses' && $parcelle->isAzotePauvre()) {
            $raisons[] = "Excellent pour enrichir votre sol en azote";
        }

        if ($parcelle->getDerniereCulture()) {
            $famillePrecedente = self::BASE_CONNAISSANCE['cultures'][$parcelle->getDerniereCulture()]['famille'] ?? null;
            if ($famillePrecedente && isset(self::BASE_CONNAISSANCE['successions_benefiques'][$famillePrecedente])) {
                if (in_array($data['famille'], self::BASE_CONNAISSANCE['successions_benefiques'][$famillePrecedente])) {
                    $raisons[] = "Excellente succession après {$parcelle->getDerniereCulture()}";
                }
            }
        }

        return !empty($raisons) ? implode('. ', $raisons) . '.' : 'Cette culture est adaptée à votre parcelle.';
    }

    /**
     * Génère les bénéfices pour le sol
     */
    private function genererBenefices(string $culture, array $data): string
    {
        if ($data['famille'] === 'legumineuses') {
            return 'Enrichit le sol en azote grâce à la fixation biologique';
        }

        if ($culture === 'jachère') {
            return 'Repose et restaure la fertilité du sol';
        }

        return 'Diversifie la rotation et prévient l\'épuisement du sol';
    }

    /**
     * Vérifie si deux cultures sont incompatibles
     */
    private function sontIncompatibles(string $culture1, string $culture2): bool
    {
        return isset(self::BASE_CONNAISSANCE['incompatibilites'][$culture1]) &&
               in_array($culture2, self::BASE_CONNAISSANCE['incompatibilites'][$culture1]);
    }

    /**
     * Vérifie si une culture peut être plantée
     */
    private function peutEtrePlantee(string $culture, array $dernieresCultures, array $nutrients, Parcelle $parcelle): bool
    {
        // Ne pas continuer la même culture
        if (in_array($culture, $dernieresCultures)) {
            return false;
        }

        // Vérifier incompatibilités
        if (in_array($dernieresCultures[0] ?? null, array_keys(self::BASE_CONNAISSANCE['incompatibilites']))) {
            if (in_array($culture, self::BASE_CONNAISSANCE['incompatibilites'][$dernieresCultures[0]])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Sélection aléatoire pondérée
     */
    private function selectionnerAleatoirePointee(array $candidates): string
    {
        $total = array_sum($candidates);
        $aleatoire = rand(1, $total);

        $cumul = 0;
        foreach ($candidates as $culture => $poids) {
            $cumul += $poids;
            if ($aleatoire <= $cumul) {
                return $culture;
            }
        }

        return array_key_last($candidates);
    }

    /**
     * Crée un plan par défaut basé sur les recommandations
     */
    private function creerPlanParDefaut(Parcelle $parcelle, int $annees): PlanRotation
    {
        $recommendations = $this->genererRecommandations($parcelle);
        $plan = [];

        for ($i = 0; $i < $annees; $i++) {
            $plan[$i] = $recommendations[($i % count($recommendations))]->getCulture();
        }

        return new PlanRotation($plan, 60);
    }
}
