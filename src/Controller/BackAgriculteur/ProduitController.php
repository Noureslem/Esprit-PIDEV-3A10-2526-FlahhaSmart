<?php

namespace App\Controller\BackAgriculteur;

use App\Entity\StockProduit;
use App\Entity\ConsommationProduit;
use App\Entity\Users;
use App\Form\StockProduitType;
use App\Form\ConsommationProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Service\QrCodeService;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/agriculteur/produits')]
#[IsGranted('ROLE_AGRICULTEUR')]
class ProduitController extends AbstractController
{
    private $qrCodeService;
    private $paginator;
    private $httpClient;

    public function __construct(
        HttpClientInterface $httpClient,
        QrCodeService $qrCodeService,
        PaginatorInterface $paginator
    ) {
        $this->httpClient = $httpClient;
        $this->qrCodeService = $qrCodeService;
        $this->paginator = $paginator;
    }

    #[Route('/stock', name: 'agriculteur_stock_index', methods: ['GET'])]
    public function indexStock(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $page = $request->query->getInt('page', 1);
        $search = $request->query->get('search', '');
        $sort = $request->query->get('sort', 'idProduit');
        $direction = $request->query->get('direction', 'asc');

        $qb = $entityManager->createQueryBuilder()
            ->select('s')
            ->from(StockProduit::class, 's')
            ->where('s.user = :user')
            ->setParameter('user', $user);

        if (!empty($search)) {
            $qb->andWhere('s.typeProduit LIKE :search OR s.variete LIKE :search')
               ->setParameter('search', '%' . $search . '%');
        }

        $allowedSorts = ['idProduit', 'typeProduit', 'variete', 'dateDebut', 'dateFinEstimee', 'statut'];
        if (in_array($sort, $allowedSorts, true)) {
            $qb->orderBy('s.' . $sort, $direction === 'asc' ? 'ASC' : 'DESC');
        } else {
            $qb->orderBy('s.idProduit', 'ASC');
        }

        $stocks = $this->paginator->paginate(
            $qb->getQuery(),
            $page,
            10
        );


        return $this->render('back_agriculteur/produit/stock/index.html.twig', [
            'stocks' => $stocks,
            'search' => $search,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }

    #[Route('/stock/nouveau', name: 'agriculteur_stock_new', methods: ['GET', 'POST'])]
    public function newStock(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stock = new StockProduit();

        $user = $this->getUser();
        if (!$user instanceof Users) {
            $this->addFlash('error', 'Vous devez être connecté pour ajouter un produit.');
            return $this->redirectToRoute('app_login');
        }

        $stock->setUser($user);

        

        $form = $this->createForm(StockProduitType::class, $stock, [
            'is_edit' => true, // on masque user, il est imposé par l'utilisateur connecté
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // sécurité : on remet toujours l'utilisateur connecté
            $stock->setUser($user);

            if ($form->isValid()) {
                $entityManager->persist($stock);
                $entityManager->flush();

                $qrContent = $this->generateUrl('client_produit_show', [
                    'idProduit' => $stock->getIdProduit()
                ], UrlGeneratorInterface::ABSOLUTE_URL);

                $qrFilename = 'produit_' . $stock->getIdProduit();
                $qrPath = $this->qrCodeService->generateQrCode($qrContent, $qrFilename);

                $stock->setCodeQr($qrPath);
                $entityManager->flush();

                $this->addFlash('success', 'Produit ajouté avec succès ! QR code généré.');
                return $this->redirectToRoute('agriculteur_stock_index');
            }
        }

        return $this->render('back_agriculteur/produit/stock/new.html.twig', [
            'stock' => $stock,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/stock/{idProduit}/edit', name: 'agriculteur_stock_edit', methods: ['GET', 'POST'])]
    public function editStock(
        Request $request,
        #[MapEntity(mapping: ['idProduit' => 'idProduit'])] StockProduit $stock,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();

        if (!$user instanceof Users) {
            $this->addFlash('error', 'Utilisateur non authentifié.');
            return $this->redirectToRoute('app_login');
        }

        // sécurité : un agriculteur ne peut modifier que son propre stock
        if ($stock->getUser()?->getIdUser() !== $user->getIdUser()) {
            throw $this->createAccessDeniedException('Accès refusé à ce stock.');
        }

        $existingUser = $stock->getUser();

        $form = $this->createForm(StockProduitType::class, $stock, [
            'is_edit' => true,
        ]);
        $form->handleRequest($request);

        // on force toujours le user existant
        $stock->setUser($existingUser);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Produit modifié avec succès.');
            return $this->redirectToRoute('agriculteur_stock_index');
        }

        return $this->render('back_agriculteur/produit/stock/edit.html.twig', [
            'stock' => $stock,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/stock/{idProduit}/delete', name: 'agriculteur_stock_delete', methods: ['POST'])]
    public function deleteStock(
        Request $request,
        #[MapEntity(mapping: ['idProduit' => 'idProduit'])] StockProduit $stock,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();

        if (!$user instanceof Users) {
            $this->addFlash('error', 'Utilisateur non authentifié.');
            return $this->redirectToRoute('app_login');
        }

        // sécurité : un agriculteur ne peut supprimer que son propre stock
        if ($stock->getUser()?->getIdUser() !== $user->getIdUser()) {
            throw $this->createAccessDeniedException('Accès refusé à ce stock.');
        }

        $token = $request->request->get('_token');

        if (!$this->isCsrfTokenValid('delete' . $stock->getIdProduit(), $token)) {
            $this->addFlash('error', 'Jeton CSRF invalide. Impossible de supprimer.');
            return $this->redirectToRoute('agriculteur_stock_index');
        }

        try {
            $entityManager->remove($stock);
            $entityManager->flush();

            $this->addFlash('success', 'Produit supprimé définitivement.');
        } catch (ForeignKeyConstraintViolationException $e) {
            $this->addFlash('error', 'Impossible de supprimer ce produit car il est lié à d’autres données.');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }

        return $this->redirectToRoute('agriculteur_stock_index');
    }


    #[Route('/consommation', name: 'agriculteur_consommation_index', methods: ['GET'])]
    public function indexConsommation(EntityManagerInterface $entityManager): Response
    {
        $consommations = $entityManager->getRepository(ConsommationProduit::class)->findAll();
        

        return $this->render('back_agriculteur/produit/consommation/index.html.twig', [
            'consommations' => $consommations,
        ]);
    }

    #[Route('/consommation/nouveau', name: 'agriculteur_consommation_new', methods: ['GET', 'POST'])]
    public function newConsommation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $consommation = new ConsommationProduit();
        
      
        
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
public function deleteConsommation(
    Request $request,
    #[MapEntity(mapping: ['idProduit' => 'idProduit'])] ConsommationProduit $consommation,
    EntityManagerInterface $entityManager
): Response {
    if ($this->isCsrfTokenValid('delete' . $consommation->getIdProduit(), $request->request->get('_token'))) {
        $entityManager->remove($consommation);
        $entityManager->flush();
        $this->addFlash('success', 'Consommation supprimée avec succès !');
    }

    return $this->redirectToRoute('agriculteur_consommation_index');
}
    
    
#[Route('/identifier-plante', name: 'agriculteur_identifier_plante', methods: ['GET', 'POST'])]
public function identifyPlant(Request $request, \App\Service\PlantNetService $plantNetService): Response
{
    $result = null;
    $error = null;

    if ($request->isMethod('POST')) {
        $imageFile = $request->files->get('image');
        
        if (!$imageFile) {
            $error = 'Veuillez sélectionner une image';
        } elseif (!in_array($imageFile->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
            $error = 'Format non supporté. Utilisez JPG ou PNG.';
        } elseif ($imageFile->getSize() > 10 * 1024 * 1024) {
            $error = 'Image trop volumineuse (max 10MB).';
        } else {
            try {
                $result = $plantNetService->identifyFromFile($imageFile);
            } catch (\Exception $e) {
                $error = 'Erreur API: ' . $e->getMessage();
            }
        }
    }

    return $this->render('back_agriculteur/produit/stock/identify_plant.html.twig', [
        'result' => $result,
        'error' => $error
    ]);
}
}