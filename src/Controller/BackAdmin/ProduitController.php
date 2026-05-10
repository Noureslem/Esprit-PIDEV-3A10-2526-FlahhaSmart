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
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Service\QrCodeService;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
  use Symfony\Bridge\Doctrine\Attribute\MapEntity;

#[Route('/admin/produits')]
#[IsGranted('ROLE_ADMIN')]
class ProduitController extends AbstractController
{
    private $qrCodeService;
    private $paginator;
    private $csrfTokenManager;

    public function __construct(
        QrCodeService $qrCodeService,
        PaginatorInterface $paginator,
        CsrfTokenManagerInterface $csrfTokenManager
    ) {
        $this->qrCodeService = $qrCodeService;
        $this->paginator = $paginator;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    // --- STOCK : liste paginée avec recherche ---
    #[Route('/stock', name: 'admin_stock_index', methods: ['GET'])]
    public function indexStock(Request $request, EntityManagerInterface $entityManager): Response
    {
        $search = $request->query->get('search', '');
        $page = $request->query->getInt('page', 1);

        $qb = $entityManager->createQueryBuilder()
            ->select('s')
            ->from(StockProduit::class, 's')
            ->leftJoin('s.user', 'u');

        if ($search !== '') {
            $qb->andWhere('s.typeProduit LIKE :search OR s.variete LIKE :search OR u.nom LIKE :search')
               ->setParameter('search', '%' . $search . '%');
        }

        $qb->orderBy('s.idProduit', 'DESC');

        $stocks = $this->paginator->paginate($qb->getQuery(), $page, 10);

        return $this->render('back_admin/produit/stock/index.html.twig', [
            'stocks' => $stocks,
            'currentSearch' => $search,
        ]);
    }

    // --- Création avec QR code ---
    #[Route('/stock/nouveau', name: 'admin_stock_new', methods: ['GET', 'POST'])]
    public function newStock(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stock = new StockProduit();
        
        $user = $this->getUser();
        if ($user instanceof Users) {
            $stock->setUser($user);
        } else {
            $defaultUser = $entityManager->getRepository(Users::class)->findOneBy(['roles' => 'ROLE_ADMIN']);
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

            // Génération du QR code
            $qrContent = $this->generateUrl('client_produit_show', [
                'idProduit' => $stock->getIdProduit()
            ], UrlGeneratorInterface::ABSOLUTE_URL);
            
            $qrFilename = 'produit_' . $stock->getIdProduit();
            $qrPath = $this->qrCodeService->generateQrCode($qrContent, $qrFilename);
            $stock->setCodeQr($qrPath);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succès ! QR code généré.');
            return $this->redirectToRoute('admin_stock_index');
        }

        return $this->render('back_admin/produit/stock/new.html.twig', [
            'stock' => $stock,
            'form' => $form->createView(),
        ]);
    }

#[Route('/stock/{idProduit}/edit', name: 'admin_stock_edit', methods: ['GET', 'POST'])]
public function editStock(
    Request $request,
    #[MapEntity(mapping: ['idProduit' => 'idProduit'])] StockProduit $stock,
    EntityManagerInterface $entityManager
): Response
     {   $existingUser = $stock->getUser();

        $form = $this->createForm(StockProduitType::class, $stock);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // sécurité : même si quelqu’un modifie le HTML, on remet le user original
            $stock->setUser($existingUser);

            if ($form->isValid()) {
                $entityManager->flush();

                $this->addFlash('success', 'Produit modifié avec succès.');
                return $this->redirectToRoute('admin_stock_index');
            }
        }

        return $this->render('back_admin/produit/stock/edit.html.twig', [
            'stock' => $stock,
            'form' => $form->createView(),
        ]);
    }  #[Route('/stock/{idProduit}/delete', name: 'admin_stock_delete', methods: ['POST'])]
    public function deleteStock(
        Request $request,
        #[MapEntity(mapping: ['idProduit' => 'idProduit'])] StockProduit $stock,
        EntityManagerInterface $entityManager
    ): Response {
        $token = $request->request->get('_token');

        if (!$this->isCsrfTokenValid('delete'.$stock->getIdProduit(), $token)) {
            $this->addFlash('error', 'Jeton CSRF invalide. Impossible de supprimer.');
            return $this->redirectToRoute('admin_stock_index');
        }

        try {
            $entityManager->remove($stock);
            $entityManager->flush();

            $this->addFlash('success', 'Produit supprimé définitivement.');
        } catch (ForeignKeyConstraintViolationException $e) {
            $this->addFlash('error', 'Impossible de supprimer ce produit car il est lié à d’autres données.');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Erreur lors de la suppression : '.$e->getMessage());
        }

        return $this->redirectToRoute('admin_stock_index');
    }

    // --- Gestion des consommations (inchangée mais avec CSRF corrigée) ---
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
            $this->addFlash('success', 'Consommation ajoutée.');
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
            $this->addFlash('success', 'Consommation modifiée.');
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
        $tokenId = 'deleteConsommation' . $consommation->getIdProduit();
        if ($this->csrfTokenManager->isTokenValid(new CsrfToken($tokenId, $request->request->get('_token')))) {
            $entityManager->remove($consommation);
            $entityManager->flush();
            $this->addFlash('success', 'Consommation supprimée.');
        } else {
            $this->addFlash('error', 'Jeton CSRF invalide.');
        }
        return $this->redirectToRoute('admin_consommation_index');
    }
}