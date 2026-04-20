<?php

namespace App\Controller\Front;

use App\Entity\StockProduit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client/produits')]
class ClientController extends AbstractController
{
    #[Route('', name: 'client_produit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $stocks = $entityManager->getRepository(StockProduit::class)->findAll();

        return $this->render('front/client/index.html.twig', [
            'stocks' => $stocks,
        ]);
    }

    #[Route('/{idProduit}', name: 'client_produit_show', methods: ['GET'])]
    public function show(StockProduit $stock): Response
    {
        return $this->render('front/client/details.html.twig', [
            'stock' => $stock,
            'consommations' => $stock->getConsommations(),
        ]);
    }
}
