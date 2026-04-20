<?php

namespace App\Controller\article;

use App\Repository\article\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/calendar', name: 'app_calendar')]
    public function index(): Response
    {
        return $this->render('calendar/index.html.twig');
    }

    #[Route('/calendar/events', name: 'app_calendar_events')]
    public function events(ArticleRepository $articleRepository): JsonResponse
    {
        $events = [];

        // Get all articles and add their date_ajout as events
        $articles = $articleRepository->findAll();
        foreach ($articles as $article) {
            $dateAjout = $article->getDateAjout();
            if ($dateAjout) {
                $events[] = [
                    'title'       => '📦 ' . $article->getNom(),
                    'start'       => $dateAjout->format('Y-m-d'),
                    'allDay'      => true,
                    'color'       => '#2e7d32',       // green matching your theme
                    'textColor'   => 'white',
                    'description' => sprintf(
                        'Prix: %.2f € | Stock: %d | Catégorie: %s',
                        $article->getPrix(),
                        $article->getStock(),
                        $article->getCategorie() ?? '—'
                    ),
                ];
            }
        }

        // You can easily add more event sources here (orders, todos, stock products, etc.)
        // Example for orders (if you have an Order entity):
        // $orders = $orderRepository->findAll();
        // foreach ($orders as $order) {
        //     $events[] = [
        //         'title' => '💰 Commande ' . $order->getReference(),
        //         'start' => $order->getDateCommande()->format('Y-m-d'),
        //         'allDay' => true,
        //         'color' => '#f39c12',
        //     ];
        // }

        return $this->json($events);
    }
}