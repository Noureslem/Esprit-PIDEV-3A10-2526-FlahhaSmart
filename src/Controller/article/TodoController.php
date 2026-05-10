<?php
namespace App\Controller\article;

use App\Entity\article\Todo;
use App\Form\article\TodoType;
use App\Repository\article\TodoRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todo')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo_index', methods: ['GET'])]
    public function index(TodoRepository $repository): Response
    {
        $todos = $repository->findAllOrdered();
        return $this->render('todo/index.html.twig', [
            'todos' => $todos,
        ]);
    }

    #[Route('/new', name: 'app_todo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em, TodoRepository $repo): Response
    {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On s'assure que les chaînes ne sont pas null (normalement le formulaire les fournit)
            $nomTache = (string) $todo->getNomTache();
            $tache = (string) $todo->getTache();
            $existing = $repo->findByNomTacheAndTache($nomTache, $tache);
            if ($existing) {
                $this->addFlash('error', 'Cette tâche existe déjà pour ce consultant.');
                return $this->redirectToRoute('app_todo_new');
            }
            $em->persist($todo);
            $em->flush();
            $this->addFlash('success', 'Tâche ajoutée avec succès.');
            return $this->redirectToRoute('app_todo_index');
        }

        return $this->render('todo/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{nomTache}/{tache}/edit', name: 'app_todo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, string $nomTache, string $tache, TodoRepository $repo, EntityManagerInterface $em): Response
    {
        // Cast pour satisfaire PHPStan (même si ce sont déjà des string)
        $nomTache = (string) $nomTache;
        $tache = (string) $tache;

        $todo = $repo->findByNomTacheAndTache($nomTache, $tache);
        if (!$todo) {
            throw $this->createNotFoundException('Tâche non trouvée');
        }

        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newNom = (string) $todo->getNomTache();
            $newTache = (string) $todo->getTache();
            if ($newNom !== $nomTache || $newTache !== $tache) {
                $existing = $repo->findByNomTacheAndTache($newNom, $newTache);
                if ($existing && $existing !== $todo) {
                    $this->addFlash('error', 'Cette combinaison consultant/tâche existe déjà.');
                    return $this->redirectToRoute('app_todo_edit', ['nomTache' => $nomTache, 'tache' => $tache]);
                }
                // Suppression de l'ancienne entité (clé composite modifiée)
                $em->remove($todo);
                $newTodo = new Todo();
                $newTodo->setNomTache($newNom);
                $newTodo->setTache($newTache);
                $newTodo->setStatut((string) $todo->getStatut());
                $em->persist($newTodo);
                $em->flush();
                $this->addFlash('success', 'Tâche modifiée avec succès.');
                return $this->redirectToRoute('app_todo_index');
            } else {
                $em->flush();
                $this->addFlash('success', 'Tâche modifiée avec succès.');
                return $this->redirectToRoute('app_todo_index');
            }
        }

        return $this->render('todo/edit.html.twig', [
            'form' => $form->createView(),
            'todo' => $todo,
        ]);
    }

    #[Route('/{nomTache}/{tache}/delete', name: 'app_todo_delete', methods: ['POST'])]
    public function delete(Request $request, string $nomTache, string $tache, TodoRepository $repo, EntityManagerInterface $em): Response
    {
        $nomTache = (string) $nomTache;
        $tache = (string) $tache;
        $todo = $repo->findByNomTacheAndTache($nomTache, $tache);
        $token = $request->request->get('_token');
        if ($todo && $this->isCsrfTokenValid('delete' . $nomTache . $tache, is_scalar($token) ? (string) $token : '')) {
            $em->remove($todo);
            $em->flush();
            $this->addFlash('success', 'Tâche supprimée avec succès.');
        }
        return $this->redirectToRoute('app_todo_index');
    }
}