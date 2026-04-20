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

        if ($search) {
            $articles = $articleRepository->searchByName($search);
        } else {
            $articles = $articleRepository->findAll();
        }

        // Tri
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

        return $this->render('shop/index.html.twig', [
            'articles' => $articles,
            'search' => $search,
            'sort' => $sort,
        ]);
    }

    #[Route('/shop/article/{id}', name: 'app_shop_show')]
    public function show($id, ArticleRepository $articleRepository): Response
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
