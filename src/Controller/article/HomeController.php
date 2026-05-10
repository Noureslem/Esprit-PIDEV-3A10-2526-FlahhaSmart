<?php
namespace App\Controller\article;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $features = [
            [
                'icon' => 'bi-tools',
                'title' => 'Gestion des équipements',
                'text' => 'Suivez les machines, la maintenance et la disponibilité depuis un seul tableau de bord.',
            ],
            [
                'icon' => 'bi-clipboard-check',
                'title' => 'Suivi des opérations',
                'text' => 'Planifiez, assignez et suivez les opérations terrain avec une traçabilité complète.',
            ],
            [
                'icon' => 'bi-cart-check',
                'title' => 'Commandes simplifiées',
                'text' => 'Passez, suivez et gérez les commandes clients en toute simplicité.',
            ],
            [
                'icon' => 'bi-newspaper',
                'title' => 'Articles & contenus',
                'text' => 'Publiez et consultez des articles utiles pour les agriculteurs et les clients.',
            ],
            [
                'icon' => 'bi-chat-dots',
                'title' => 'Forum communautaire',
                'text' => 'Partagez des retours d’expérience et échangez avec la communauté.',
            ],
            [
                'icon' => 'bi-graph-up-arrow',
                'title' => 'Agriculture intelligente',
                'text' => 'Transformez les données terrain en recommandations et tendances actionnables.',
            ],
        ];

        $stats = [
            [
                'value' => '12k+',
                'label' => 'équipements gérés',
                'note' => 'Sur des fermes et coopératives',
            ],
            [
                'value' => '48k+',
                'label' => 'opérations suivies',
                'note' => 'Workflows saisonniers optimisés',
            ],
            [
                'value' => '22%',
                'label' => 'économies de ressources',
                'note' => 'Optimisation moyenne des intrants',
            ],
        ];

        return $this->render('landing/index.html.twig', [
            'features' => $features,
            'stats' => $stats,
        ]);
    }
}

