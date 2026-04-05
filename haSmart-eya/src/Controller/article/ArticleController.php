<?php
namespace App\Controller\article;

use App\Entity\article\Article;
use App\Form\article\ArticleType;
use App\Repository\article\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/article')]
#[IsGranted('ROLE_AGRICULTEUR')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $repository, Request $request): Response
    {
        $user = $this->getUser();
        $search = $request->query->get('search', '');
        $sort = $request->query->get('sort', 'id');

        // Build query builder to get only current user's articles
        $qb = $repository->createQueryBuilder('a')
            ->where('a.idUser = :userId')
            ->setParameter('userId', $user->getId());

        // Apply search filter on name if provided
        if ($search) {
            $qb->andWhere('LOWER(a.nom) LIKE LOWER(:search)')
               ->setParameter('search', '%' . $search . '%');
        }

        $articles = $qb->getQuery()->getResult();

        // Sorting logic (in memory)
        usort($articles, function($a, $b) use ($sort) {
            switch ($sort) {
                case 'price_asc': return $a->getPrix() <=> $b->getPrix();
                case 'price_desc': return $b->getPrix() <=> $a->getPrix();
                case 'date_desc': return $b->getDateAjout() <=> $a->getDateAjout();
                case 'date_asc': return $a->getDateAjout() <=> $b->getDateAjout();
                case 'name_asc': return strcasecmp($a->getNom(), $b->getNom());
                case 'name_desc': return strcasecmp($b->getNom(), $a->getNom());
                default: return $b->getId() <=> $a->getId();
            }
        });

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'search' => $search,
            'sort' => $sort,
        ]);
    }

    #[Route('/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();
        $article->setIdUser($this->getUser()->getId());

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();
            $this->addFlash('success', 'Article ajouté avec succès.');
            return $this->redirectToRoute('app_article_index');
        }

        return $this->render('article/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $em): Response
    {
        if ($article->getIdUser() !== $this->getUser()->getId() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Article modifié avec succès.');
            return $this->redirectToRoute('app_article_index');
        }

        return $this->render('article/edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $em): Response
    {
        if ($article->getIdUser() !== $this->getUser()->getId() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $em->remove($article);
            $em->flush();
            $this->addFlash('success', 'Article supprimé avec succès.');
        }

        return $this->redirectToRoute('app_article_index');
    }

    #[Route('/statistiques/prix', name: 'app_article_stats_price', methods: ['GET'])]
    public function statsPrice(ArticleRepository $repository): Response
    {
        $user = $this->getUser();
        $articles = $repository->findBy(['idUser' => $user->getId()]);

        $max = 0;
        $min = PHP_INT_MAX;
        $sum = 0;
        foreach ($articles as $a) {
            $p = $a->getPrix();
            if ($p > $max) $max = $p;
            if ($p < $min) $min = $p;
            $sum += $p;
        }
        $avg = count($articles) ? $sum / count($articles) : 0;
        usort($articles, fn($a, $b) => $a->getPrix() <=> $b->getPrix());

        return $this->render('article/stats_price.html.twig', [
            'articles' => $articles,
            'max' => $max,
            'min' => $min,
            'avg' => $avg,
        ]);
    }

    #[Route('/statistiques/poids', name: 'app_article_stats_weight', methods: ['GET'])]
    public function statsWeight(ArticleRepository $repository): Response
    {
        $user = $this->getUser();
        $articles = $repository->findBy(['idUser' => $user->getId()]);

        $max = 0;
        $min = PHP_INT_MAX;
        $sum = 0;
        foreach ($articles as $a) {
            $p = $a->getPoids() ?? 0;
            if ($p > $max) $max = $p;
            if ($p < $min) $min = $p;
            $sum += $p;
        }
        $avg = count($articles) ? $sum / count($articles) : 0;
        $total = $sum;

        $ranges = [
            '0-1 kg' => 0,
            '1-5 kg' => 0,
            '5-10 kg' => 0,
            '10-20 kg' => 0,
            '20+ kg' => 0,
        ];
        foreach ($articles as $a) {
            $w = $a->getPoids() ?? 0;
            if ($w <= 1) $ranges['0-1 kg']++;
            elseif ($w <= 5) $ranges['1-5 kg']++;
            elseif ($w <= 10) $ranges['5-10 kg']++;
            elseif ($w <= 20) $ranges['10-20 kg']++;
            else $ranges['20+ kg']++;
        }

        return $this->render('article/stats_weight.html.twig', [
            'articles' => $articles,
            'max' => $max,
            'min' => $min,
            'avg' => $avg,
            'total' => $total,
            'ranges' => $ranges,
        ]);
    }
}