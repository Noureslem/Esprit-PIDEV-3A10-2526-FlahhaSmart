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
        $articles = $articleRepository->findAll();

        foreach ($articles as $article) {
            $dateAjout = $article->getDateAjout();
            $events[] = [
                'title'       => '📦 ' . $article->getNom(),
                'start'       => $dateAjout->format('Y-m-d'),
                'allDay'      => true,
                'color'       => '#2e7d32',
                'textColor'   => 'white',
                'description' => sprintf(
                    'Prix: %.2f € | Stock: %d | Catégorie: %s',
                    (float) $article->getPrix(),
                    $article->getStock(),
                    $article->getCategorie() ?? '—'
                ),
            ];
        }

        return $this->json($events);
    }
}