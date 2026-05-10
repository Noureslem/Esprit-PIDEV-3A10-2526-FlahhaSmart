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
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $repository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $sort = $request->query->get('sort', 'id');
        $page = max(1, $request->query->getInt('page', 1));
        $limit = 10;

        $result = $repository->findPaginated($search, $sort, $page, $limit);
        $articles = $result['items'];
        $total = $result['total'];

        usort($articles, function($a, $b) use ($sort) {
            switch ($sort) {
                case 'price_asc': return (float)$a->getPrix() <=> (float)$b->getPrix();
                case 'price_desc': return (float)$b->getPrix() <=> (float)$a->getPrix();
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
            'page' => $page,
            'limit' => $limit,
            'total' => $total,
            'nbPages' => (int) ceil($total / $limit),
        ]);
    }

    #[Route('/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        $article = new Article();
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

    #[Route('/{id}', name: 'app_article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $em): Response
    {
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
        $token = $request->request->get('_token');
        if ($this->isCsrfTokenValid('delete'.(string)$article->getId(), is_scalar($token) ? (string) $token : '')) {
            $em->remove($article);
            $em->flush();
            $this->addFlash('success', 'Article supprimé avec succès.');
        }
        return $this->redirectToRoute('app_article_index');
    }

    #[Route('/statistiques/prix', name: 'app_article_stats_price', methods: ['GET'])]
    public function statsPrice(ArticleRepository $repository): Response
    {
        // Agrégats SQL pour éviter de parcourir tous les articles en PHP
        $stats = $repository->createQueryBuilder('a')
            ->select('MIN(a.prix) as min_price, MAX(a.prix) as max_price, AVG(a.prix) as avg_price')
            ->getQuery()
            ->getSingleResult();

        $max = (float) $stats['max_price'];
        $min = (float) $stats['min_price'];
        $avg = (float) $stats['avg_price'];

        // Chargement de tous les articles pour le graphique (tri en PHP conservé)
        $articles = $repository->findAll();
        usort($articles, fn($a, $b) => (float)$a->getPrix() <=> (float)$b->getPrix());

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
        $stats = $repository->createQueryBuilder('a')
            ->select('MIN(a.poids) as min_weight, MAX(a.poids) as max_weight, AVG(a.poids) as avg_weight, SUM(a.poids) as total_weight')
            ->getQuery()
            ->getSingleResult();

        $max = (float) ($stats['max_weight'] ?? 0);
        $min = (float) ($stats['min_weight'] ?? 0);
        $avg = (float) ($stats['avg_weight'] ?? 0);
        $total = (float) ($stats['total_weight'] ?? 0);

        $articles = $repository->findAll();
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