<?php

namespace App\Controller\BackAdmin;
use App\Entity\Users;
use App\Entity\StockProduit;
use App\Entity\ConsommationProduit;
use App\Form\StockProduitType;
use App\Form\ConsommationProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/produits')]
#[IsGranted('ROLE_ADMIN')]

class ProduitController extends AbstractController
{
    // --- CRUD STOCK PRODUIT ---

    #[Route('/stock', name: 'admin_stock_index', methods: ['GET'])]
    public function indexStock(EntityManagerInterface $entityManager): Response
    {
        $stocks = $entityManager->getRepository(StockProduit::class)->findAll();

        return $this->render('back_admin/produit/stock/index.html.twig', [
            'stocks' => $stocks,
        ]);
    }

   #[Route('/stock/nouveau', name: 'admin_stock_new', methods: ['GET', 'POST'])]
public function newStock(Request $request, EntityManagerInterface $entityManager): Response
{
    $stock = new StockProduit();
    
    // Essayer de récupérer l'utilisateur connecté
    $user = $this->getUser();
    
    if ($user instanceof \App\Entity\Users) {
        $stock->setUser($user);
    } else {
        // Fallback: prendre le premier admin ou utilisateur actif
        $defaultUser = $entityManager->getRepository(\App\Entity\Users::class)->findOneBy(['roles' => 'ROLE_ADMIN']);
        if ($defaultUser) {
            $stock->setUser($defaultUser);
            $this->addFlash('warning', 'Aucun utilisateur connecté, utilisation du compte admin par défaut.');
        }
    }
    
    $form = $this->createForm(StockProduitType::class, $stock);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($stock);
        $entityManager->flush();

        $this->addFlash('success', 'Produit ajouté avec succès !');
        return $this->redirectToRoute('admin_stock_index');
    }

    return $this->render('back_admin/produit/stock/new.html.twig', [
        'stock' => $stock,
        'form' => $form->createView(),
    ]);
}
    #[Route('/stock/{idProduit}/edit', name: 'admin_stock_edit', methods: ['GET', 'POST'])]
    public function editStock(Request $request, StockProduit $stock, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StockProduitType::class, $stock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('admin_stock_index');
        }

        return $this->render('back_admin/produit/stock/edit.html.twig', [
            'stock' => $stock,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/stock/{idProduit}', name: 'admin_stock_delete', methods: ['POST'])]
    public function deleteStock(Request $request, StockProduit $stock, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $stock->getIdProduit(), $request->request->get('_token'))) {
            $entityManager->remove($stock);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_stock_index');
    }

    // --- CRUD CONSOMMATION PRODUIT ---

    #[Route('/consommation', name: 'admin_consommation_index', methods: ['GET'])]
    public function indexConsommation(EntityManagerInterface $entityManager): Response
    {
        $consommations = $entityManager->getRepository(ConsommationProduit::class)->findAll();

        return $this->render('back_admin/produit/consommation/index.html.twig', [
            'consommations' => $consommations,
        ]);
    }

    #[Route('/consommation/nouveau', name: 'admin_consommation_new', methods: ['GET', 'POST'])]
    public function newConsommation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $consommation = new ConsommationProduit();
        $form = $this->createForm(ConsommationProduitType::class, $consommation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($consommation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_consommation_index');
        }

        return $this->render('back_admin/produit/consommation/new.html.twig', [
            'consommation' => $consommation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/consommation/{idProduit}/edit', name: 'admin_consommation_edit', methods: ['GET', 'POST'])]
    public function editConsommation(Request $request, ConsommationProduit $consommation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConsommationProduitType::class, $consommation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('admin_consommation_index');
        }

        return $this->render('back_admin/produit/consommation/edit.html.twig', [
            'consommation' => $consommation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/consommation/{idProduit}', name: 'admin_consommation_delete', methods: ['POST'])]
    public function deleteConsommation(Request $request, ConsommationProduit $consommation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $consommation->getIdProduit(), $request->request->get('_token'))) {
            $entityManager->remove($consommation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_consommation_index');
    }
}
