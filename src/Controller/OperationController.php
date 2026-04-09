<?php

namespace App\Controller;

use App\Entity\Operation;
use App\Entity\Equipement;
use App\Entity\Users;
use App\Form\OperationType;
use App\Repository\OperationRepository;
use App\Service\BulkDeleteService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/operation')]
final class OperationController extends AbstractController
{
    #[Route(name: 'app_operation_index', methods: ['GET'])]
    public function index(Request $request, OperationRepository $operationRepository): Response
    {
        $user = $this->getAuthenticatedUser();

        // Get search and filter parameters from query string
        $type = $request->query->get('type');
        $statut = $request->query->get('statut');
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');

        // Use repository search method
        $operations = $operationRepository->search($type, $statut, $sort, $direction, $user->getIdUser());

        // Get all unique statuts for filter dropdown
        $allStatuts = $operationRepository->createQueryBuilder('o')
            ->select('DISTINCT o.statut')
            ->andWhere('o.id_user = :userId')
            ->setParameter('userId', $user->getIdUser())
            ->orderBy('o.statut', 'ASC')
            ->getQuery()
            ->getResult();

        $statuts = array_column($allStatuts, 'statut');

        return $this->render('frontend/operation/index.html.twig', [
            'operations' => $operations,
            'filters' => [
                'type' => $type,
                'statut' => $statut,
                'sort' => $sort,
                'direction' => $direction,
            ],
            'statuts' => $statuts,
        ]);
    }

    #[Route('/new', name: 'app_operation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getAuthenticatedUser();

        $operation = new Operation();
        $operation->setIdUser($user->getIdUser());
        $operation->setStatut('en cours');
        $form = $this->createForm(OperationType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $equipement = $operation->getEquipement();
            $equipement->setEtat('réservé');
            $entityManager->persist($operation);
            $entityManager->flush();

            return $this->redirectToRoute('app_operation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('frontend/operation/new.html.twig', [
            'operation' => $operation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_operation_show', methods: ['GET'], requirements: ['id' => '\\d+'])]
    public function show(Operation $operation): Response
    {
        $this->denyAccessUnlessOwner($operation, $this->getAuthenticatedUser());

        return $this->render('frontend/operation/show.html.twig', [
            'operation' => $operation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_operation_edit', methods: ['GET', 'POST'], requirements: ['id' => '\\d+'])]
    public function edit(Request $request, Operation $operation, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessOwner($operation, $this->getAuthenticatedUser());

        $form = $this->createForm(OperationType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_operation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('frontend/operation/edit.html.twig', [
            'operation' => $operation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/finish', name: 'app_operation_finish', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function finish(Request $request, Operation $operation, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessOwner($operation, $this->getAuthenticatedUser());

        if ($this->isCsrfTokenValid('finish'.$operation->getId(), $request->getPayload()->getString('_token'))) {
            $operation->setStatut('terminé');
            
            $equipement = $operation->getEquipement();
            if ($equipement instanceof Equipement) {
                $equipement->setEtat('libre');
                $entityManager->persist($equipement);
            }

            $entityManager->persist($operation);
            $entityManager->flush();
        }

        $referer = $request->headers->get('referer');
        if (\is_string($referer)) {
            $host = $request->getSchemeAndHttpHost();
            if (str_starts_with($referer, $host)) {
                return $this->redirect($referer, Response::HTTP_SEE_OTHER);
            }
        }

        return $this->redirectToRoute('app_operation_show', ['id' => $operation->getId()], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_operation_delete', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function delete(Request $request, Operation $operation, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessOwner($operation, $this->getAuthenticatedUser());

        if ($this->isCsrfTokenValid('delete'.$operation->getId(), $request->getPayload()->getString('_token'))) {
            $equipement = $operation->getEquipement();
            if ($equipement instanceof Equipement) {
                $equipement->setEtat('libre');
                $entityManager->persist($equipement);
            }

            $entityManager->remove($operation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_operation_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/bulk-delete', name: 'app_operation_bulk_delete', methods: ['POST'])]
    public function bulkDelete(Request $request, BulkDeleteService $bulkDeleteService, OperationRepository $operationRepository): Response
    {
        $user = $this->getAuthenticatedUser();

        $token = $request->getPayload()->getString('_token');
        if (!\is_string($token) || !$this->isCsrfTokenValid('bulk_delete_operation', $token)) {
            $this->addFlash('error', 'Jeton CSRF invalide.');

            return $this->redirectToRoute('app_operation_index', [], Response::HTTP_SEE_OTHER);
        }

        $rawIds = array_values(array_filter(array_map('intval', $request->getPayload()->all('ids')), static fn (int $id): bool => $id > 0));

        if ($rawIds === []) {
            $this->addFlash('warning', 'Aucune operation selectionnee.');

            return $this->redirectToRoute('app_operation_index', [], Response::HTTP_SEE_OTHER);
        }

        $ownedRows = $operationRepository->createQueryBuilder('o')
            ->select('o.id')
            ->andWhere('o.id IN (:ids)')
            ->andWhere('o.id_user = :userId')
            ->setParameter('ids', $rawIds)
            ->setParameter('userId', $user->getIdUser())
            ->getQuery()
            ->getScalarResult();

        $ownedIds = array_map('intval', array_column($ownedRows, 'id'));

        if (
            count($ownedIds) < count($rawIds)
            && !$this->isGranted('ROLE_ADMIN')
        ) {
            $this->addFlash('warning', 'Certaines operations ne vous appartiennent pas et n\'ont pas ete supprimees.');
        }

        $result = $bulkDeleteService->bulkDeleteOperations($ownedIds);

        if ($result->deletedCount() > 0) {
            $this->addFlash('success', sprintf('%d opération(s) supprimée(s).', $result->deletedCount()));
        }

        if ($result->notFoundCount() > 0) {
            $this->addFlash('warning', sprintf('%d élément(s) introuvable(s).', $result->notFoundCount()));
        }

        if ($result->failedCount() > 0) {
            $this->addFlash('error', sprintf('%d élément(s) non supprimé(s).', $result->failedCount()));
        }

        return $this->redirectToRoute('app_operation_index', [], Response::HTTP_SEE_OTHER);
    }

    private function getAuthenticatedUser(): Users
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        if (!$user instanceof Users || $user->getIdUser() === null) {
            throw $this->createAccessDeniedException('Utilisateur non authentifie.');
        }

        return $user;
    }

    private function denyAccessUnlessOwner(Operation $operation, Users $user): void
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return;
        }

        if ($operation->getIdUser() !== $user->getIdUser()) {
            throw $this->createAccessDeniedException('Acces refuse a cette operation.');
        }
    }
}
