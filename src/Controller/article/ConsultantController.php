<?php
namespace App\Controller\article;

use App\Service\article\ConsultantBotService;  // <-- FIXED: added "article" subfolder

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultantController extends AbstractController
{
    #[Route('/consultant', name: 'app_consultant', methods: ['GET', 'POST'])]
    public function index(Request $request, ConsultantBotService $bot): Response
    {
        $answer = null;
        $question = null;
        $error = null;

        if ($request->isMethod('POST')) {
            $question = $request->request->get('question');
            if ($question) {
                $answer = $bot->ask($question);
                if ($answer === null) {
                    $error = 'Erreur de connexion à l\'IA. Vérifiez que Ollama est démarré sur localhost:11434.';
                }
            }
        }

        return $this->render('consultant/index.html.twig', [
            'question' => $question,
            'answer' => $answer,
            'error' => $error,
        ]);
    }
}