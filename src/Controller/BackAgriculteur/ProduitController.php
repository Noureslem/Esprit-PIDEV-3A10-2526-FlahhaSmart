<?php

namespace App\Controller\BackAgriculteur;

use App\Entity\StockProduit;
use App\Entity\ConsommationProduit;
use App\Entity\Users;
use App\Form\StockProduitType;
use App\Form\ConsommationProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/agriculteur/produits')]
#[IsGranted('ROLE_AGRICULTEUR')]
class ProduitController extends AbstractController
{
    // --- CRUD STOCK PRODUIT ---

    #[Route('/stock', name: 'agriculteur_stock_index', methods: ['GET'])]
    public function indexStock(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $stocks = $entityManager->getRepository(StockProduit::class)->findBy(['user' => $user]);

        return $this->render('back_agriculteur/produit/stock/index.html.twig', [
            'stocks' => $stocks,
        ]);
    }

    #[Route('/stock/nouveau', name: 'agriculteur_stock_new', methods: ['GET', 'POST'])]
    public function newStock(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stock = new StockProduit();
        
        $user = $this->getUser();
        
        if ($user instanceof Users) {
            $stock->setUser($user);
        } else {
            $this->addFlash('error', 'Vous devez être connecté pour ajouter un produit.');
            return $this->redirectToRoute('app_login');
        }
        
        $form = $this->createForm(StockProduitType::class, $stock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($stock);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succès !');
            return $this->redirectToRoute('agriculteur_stock_index');
        }

        return $this->render('back_agriculteur/produit/stock/new.html.twig', [
            'stock' => $stock,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/stock/{idProduit}/edit', name: 'agriculteur_stock_edit', methods: ['GET', 'POST'])]
    public function editStock(Request $request, StockProduit $stock, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($stock->getUser() !== $user) {
            $this->addFlash('error', 'Vous ne pouvez modifier que vos propres produits.');
            return $this->redirectToRoute('agriculteur_stock_index');
        }
        
        $form = $this->createForm(StockProduitType::class, $stock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Produit modifié avec succès !');
            return $this->redirectToRoute('agriculteur_stock_index');
        }

        return $this->render('back_agriculteur/produit/stock/edit.html.twig', [
            'stock' => $stock,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/stock/{idProduit}', name: 'agriculteur_stock_delete', methods: ['POST'])]
    public function deleteStock(Request $request, StockProduit $stock, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($stock->getUser() !== $user) {
            $this->addFlash('error', 'Vous ne pouvez supprimer que vos propres produits.');
            return $this->redirectToRoute('agriculteur_stock_index');
        }
        
        if ($this->isCsrfTokenValid('delete' . $stock->getIdProduit(), $request->request->get('_token'))) {
            $entityManager->remove($stock);
            $entityManager->flush();
            $this->addFlash('success', 'Produit supprimé avec succès !');
        }

        return $this->redirectToRoute('agriculteur_stock_index');
    }

    // --- CRUD CONSOMMATION PRODUIT ---

    #[Route('/consommation', name: 'agriculteur_consommation_index', methods: ['GET'])]
    public function indexConsommation(EntityManagerInterface $entityManager): Response
    {
        // Si pas de relation user, afficher toutes les consommations
        $consommations = $entityManager->getRepository(ConsommationProduit::class)->findAll();

        return $this->render('back_agriculteur/produit/consommation/index.html.twig', [
            'consommations' => $consommations,
        ]);
    }

    #[Route('/consommation/nouveau', name: 'agriculteur_consommation_new', methods: ['GET', 'POST'])]
    public function newConsommation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $consommation = new ConsommationProduit();
        
        // NE PAS essayer de setUser si la propriété n'existe pas
        // $user = $this->getUser();
        // if ($user instanceof Users && method_exists($consommation, 'setUser')) {
        //     $consommation->setUser($user);
        // }
        
        $form = $this->createForm(ConsommationProduitType::class, $consommation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($consommation);
            $entityManager->flush();

            $this->addFlash('success', 'Consommation ajoutée avec succès !');
            return $this->redirectToRoute('agriculteur_consommation_index');
        }

        return $this->render('back_agriculteur/produit/consommation/new.html.twig', [
            'consommation' => $consommation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/consommation/{idProduit}/edit', name: 'agriculteur_consommation_edit', methods: ['GET', 'POST'])]
    public function editConsommation(Request $request, ConsommationProduit $consommation, EntityManagerInterface $entityManager): Response
    {
        // Enlever la vérification du user
        $form = $this->createForm(ConsommationProduitType::class, $consommation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Consommation modifiée avec succès !');
            return $this->redirectToRoute('agriculteur_consommation_index');
        }

        return $this->render('back_agriculteur/produit/consommation/edit.html.twig', [
            'consommation' => $consommation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/consommation/{idProduit}', name: 'agriculteur_consommation_delete', methods: ['POST'])]
    public function deleteConsommation(Request $request, ConsommationProduit $consommation, EntityManagerInterface $entityManager): Response
    {
        // Enlever la vérification du user
        if ($this->isCsrfTokenValid('delete' . $consommation->getIdProduit(), $request->request->get('_token'))) {
            $entityManager->remove($consommation);
            $entityManager->flush();
            $this->addFlash('success', 'Consommation supprimée avec succès !');
        }

        return $this->redirectToRoute('agriculteur_consommation_index');
    }
}