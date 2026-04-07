<?php

namespace App\Controller;

use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Repository\EquipementRepository;
use App\Service\BulkDeleteService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/equipement')]
final class EquipementController extends AbstractController
{
    #[Route(name: 'app_equipement_index', methods: ['GET'])]
    public function index(Request $request, EquipementRepository $equipementRepository): Response
    {
        // Get search and filter parameters from query string
        $nom = $request->query->get('nom');
        $type = $request->query->get('type');
        $etat = $request->query->get('etat');
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');

        // Use repository search method
        $equipements = $equipementRepository->search($nom, $type, $etat, $sort, $direction);

        // Get all unique types and etats for filter dropdowns
        $allTypes = $equipementRepository->createQueryBuilder('e')
            ->select('DISTINCT e.type')
            ->orderBy('e.type', 'ASC')
            ->getQuery()
            ->getResult();

        $allEtats = $equipementRepository->createQueryBuilder('e')
            ->select('DISTINCT e.etat')
            ->orderBy('e.etat', 'ASC')
            ->getQuery()
            ->getResult();

        $types = array_column($allTypes, 'type');
        $etats = array_column($allEtats, 'etat');

        return $this->render('frontend/equipement/index.html.twig', [
            'equipements' => $equipements,
            'filters' => [
                'nom' => $nom,
                'type' => $type,
                'etat' => $etat,
                'sort' => $sort,
                'direction' => $direction,
            ],
            'types' => $types,
            'etats' => $etats,
        ]);
    }

    #[Route('/new', name: 'app_equipement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $equipement = new Equipement();
        $equipement->setEtat('libre');
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($equipement);
            $entityManager->flush();

            return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('frontend/equipement/new.html.twig', [
            'equipement' => $equipement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipement_show', methods: ['GET'], requirements: ['id' => '\\d+'])]
    public function show(Equipement $equipement): Response
    {
        return $this->render('frontend/equipement/show.html.twig', [
            'equipement' => $equipement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipement_edit', methods: ['GET', 'POST'], requirements: ['id' => '\\d+'])]
    public function edit(Request $request, Equipement $equipement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('frontend/equipement/edit.html.twig', [
            'equipement' => $equipement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipement_delete', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function delete(Request $request, Equipement $equipement, EntityManagerInterface $entityManager): Response
    {
        // Prevent deletion if equipement is reserved
        if (strtolower($equipement->getEtat()) === 'réservé') {
            $this->addFlash('error', 'Impossible de supprimer un équipement réservé. Veuillez d\'abord le libérer.');
            return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($this->isCsrfTokenValid('delete'.$equipement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($equipement);
            $entityManager->flush();
            $this->addFlash('success', 'Équipement supprimé avec succès.');
        }

        return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/bulk-delete', name: 'app_equipement_bulk_delete', methods: ['POST'])]
    public function bulkDelete(Request $request, BulkDeleteService $bulkDeleteService): Response
    {
        $token = $request->getPayload()->getString('_token');
        if (!\is_string($token) || !$this->isCsrfTokenValid('bulk_delete_equipement', $token)) {
            $this->addFlash('error', 'Jeton CSRF invalide.');

            return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        $rawIds = $request->getPayload()->all('ids');

        $result = $bulkDeleteService->bulkDeleteEquipements($rawIds);

        if ($result->deletedCount() > 0) {
            $this->addFlash('success', sprintf('%d équipement(s) supprimé(s).', $result->deletedCount()));
        }

        if ($result->notFoundCount() > 0) {
            $this->addFlash('warning', sprintf('%d élément(s) introuvable(s).', $result->notFoundCount()));
        }

        if ($result->failedCount() > 0) {
            $this->addFlash('error', sprintf('%d élément(s) non supprimé(s).', $result->failedCount()));
        }

        return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
    }
}
