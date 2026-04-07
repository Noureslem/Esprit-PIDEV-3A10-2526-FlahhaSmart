<?php

namespace App\Service;

use App\Entity\Operation;
use App\Entity\Equipement;
use App\Repository\OperationRepository;
use Doctrine\ORM\EntityManagerInterface;

class OperationService
{
    public function __construct(
        private OperationRepository $operationRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    /**
     * Terminate an operation and set its equipment to free
     * 
     * @throws \Exception if operation not found or already terminated
     */
    public function terminateOperation(int $operationId): Operation
    {
        $operation = $this->operationRepository->find($operationId);

        if (!$operation) {
            throw new \Exception('Opération non trouvée');
        }

        if (strtolower($operation->getStatut()) === 'terminé') {
            throw new \Exception('Cette opération est déjà terminée');
        }

        // Update operation status
        $operation->setStatut('terminé');

        // Set equipment to free
        $equipement = $operation->getEquipement();
        if ($equipement instanceof Equipement) {
            $equipement->setEtat('libre');
            $this->entityManager->persist($equipement);
        }

        $this->entityManager->persist($operation);
        $this->entityManager->flush();

        return $operation;
    }

    /**
     * Get the 3 closest upcoming operations
     * Ordered by date_fin ascending
     */
    public function getUpcomingOperations(int $limit = 3): array
    {
        return $this->operationRepository->findUpcomingOperations($limit);
    }

    /**
     * Calculate days remaining until operation ends
     */
    public function getDaysRemaining(\DateTime $dateFin): int
    {
        $today = new \DateTime('today');
        $diff = $dateFin->diff($today);
        
        // If the operation date is in the past, return 0
        if ($diff->invert === 0 && $diff->days > 0) {
            return 0;
        }

        return $diff->days;
    }

    /**
     * Calculate days remaining for multiple operations
     */
    public function calculateDaysForOperations(array $operations): array
    {
        $results = [];

        foreach ($operations as $operation) {
            $results[] = [
                'operation' => $operation,
                'daysRemaining' => $this->getDaysRemaining($operation->getDateFin()),
            ];
        }

        return $results;
    }
}
