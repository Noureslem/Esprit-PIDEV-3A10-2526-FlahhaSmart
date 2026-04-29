<?php
namespace App\Controller\article;

use App\Repository\article\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/shop', name: 'app_shop_index')]
    public function index(ArticleRepository $articleRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $sort = $request->query->get('sort', 'date_desc');
        $page = max(1, $request->query->getInt('page', 1));
        $limit = 12; // Vous pouvez mettre 12 articles par page pour l'affichage boutique
    
        $result = $articleRepository->findPaginated($search, $sort, $page, $limit);
        $articles = $result['items'];
        $total = $result['total'];
    
        // Tri (comme avant)
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
    
        return $this->render('shop/index.html.twig', [
            'articles' => $articles,
            'search' => $search,
            'sort' => $sort,
            'page' => $page,
            'limit' => $limit,
            'total' => $total,
            'nbPages' => (int) ceil($total / $limit),
        ]);
    }

    #[Route('/shop/article/{id}', name: 'app_shop_show')]
    public function show(int $id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException('Article non trouvé');
        }
        return $this->render('shop/show.html.twig', [
            'article' => $article,
        ]);
    }
}