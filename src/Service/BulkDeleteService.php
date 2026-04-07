<?php

namespace App\Service;

use App\DTO\BulkDeleteResultDTO;
use App\Entity\Equipement;
use App\Entity\Operation;
use App\Repository\EquipementRepository;
use App\Repository\OperationRepository;
use Doctrine\ORM\EntityManagerInterface;

final class BulkDeleteService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly OperationRepository $operationRepository,
        private readonly EquipementRepository $equipementRepository,
    ) {
    }

    public function bulkDeleteOperations(array $rawIds): BulkDeleteResultDTO
    {
        $ids = $this->normalizeIds($rawIds);
        if ($ids === []) {
            return new BulkDeleteResultDTO();
        }

        // JOIN FETCH equipement to avoid lazy-load/N+1 when updating its state.
        $operations = $this->operationRepository->findWithEquipementsByIds($ids);

        return $this->bulkDeleteEntities(
            ids: $ids,
            entities: $operations,
            getId: static fn(Operation $o): int => (int) $o->getId(),
            canDelete: static fn(Operation $o): ?string => null,
            preRemove: function (Operation $o): void {
                $equipement = $o->getEquipement();
                if ($equipement instanceof Equipement) {
                    $equipement->setEtat('libre');
                    $this->entityManager->persist($equipement);
                }
            },
            removeOneByIdFallback: fn(int $id): ?Operation => $this->operationRepository->findWithEquipement($id),
        );
    }

    /**
     * @param array<int, mixed> $rawIds
     */
    public function bulkDeleteEquipements(array $rawIds): BulkDeleteResultDTO
    {
        $ids = $this->normalizeIds($rawIds);
        if ($ids === []) {
            return new BulkDeleteResultDTO();
        }

        $equipements = $this->equipementRepository->findBy(['id' => $ids]);

        return $this->bulkDeleteEntities(
            ids: $ids,
            entities: $equipements,
            getId: static fn(Equipement $e): int => (int) $e->getId(),
            canDelete: static function (Equipement $e): ?string {
                if (strtolower((string) $e->getEtat()) === 'réservé') {
                    return 'Équipement réservé';
                }

                return null;
            },
            preRemove: static function (Equipement $e): void {
            },
            removeOneByIdFallback: fn(int $id): ?Equipement => $this->equipementRepository->find($id),
        );
    }

    /**
     * @template TEntity of object
     * @param list<int> $ids
     * @param list<TEntity> $entities
     * @param callable(TEntity): int $getId
     * @param callable(TEntity): (string|null) $canDelete Returns reason if NOT deletable
     * @param callable(TEntity): void $preRemove
     * @param callable(int): (?TEntity) $removeOneByIdFallback Refetch entity for per-id fallback deletes
     */
    private function bulkDeleteEntities(
        array $ids,
        array $entities,
        callable $getId,
        callable $canDelete,
        callable $preRemove,
        callable $removeOneByIdFallback,
    ): BulkDeleteResultDTO {
        $foundIds = [];
        foreach ($entities as $entity) {
            $foundIds[] = $getId($entity);
        }

        $foundIdSet = array_fill_keys($foundIds, true);
        $notFound = [];
        foreach ($ids as $id) {
            if (!isset($foundIdSet[$id])) {
                $notFound[] = $id;
            }
        }

        $toDelete = [];
        $failed = [];
        foreach ($entities as $entity) {
            $reason = $canDelete($entity);
            if ($reason !== null) {
                $failed[$getId($entity)] = $reason;
                continue;
            }

            $preRemove($entity);
            $this->entityManager->remove($entity);
            $toDelete[] = $getId($entity);
        }

        if ($toDelete === []) {
            return new BulkDeleteResultDTO([], $notFound, $failed);
        }

        // Fast-path: delete in one flush.
        try {
            $this->entityManager->flush();

            return new BulkDeleteResultDTO($toDelete, $notFound, $failed);
        } catch (\Throwable $e) {
            // Fallback: try per-entity deletion to allow partial success.
        }

        // The UnitOfWork may be in a bad state after a failed flush.
        $this->entityManager->clear();

        $deleted = [];
        foreach ($toDelete as $id) {
            // If it already failed pre-check, skip.
            if (isset($failed[$id])) {
                continue;
            }

            $entity = $removeOneByIdFallback($id);
            if ($entity === null) {
                $notFound[] = $id;
                continue;
            }

            $reason = $canDelete($entity);
            if ($reason !== null) {
                $failed[$id] = $reason;
                continue;
            }

            try {
                $preRemove($entity);
                $this->entityManager->remove($entity);
                $this->entityManager->flush();
                $deleted[] = $id;
            } catch (\Throwable $e) {
                $failed[$id] = $this->formatDeleteError($e);
                $this->entityManager->clear();
            }
        }

        $notFound = $this->uniqueSorted($notFound);
        $deleted = $this->uniqueSorted($deleted);

        return new BulkDeleteResultDTO($deleted, $notFound, $failed);
    }

    /**
     * @param array<int, mixed> $rawIds
     * @return list<int>
     */
    private function normalizeIds(array $rawIds): array
    {
        $ids = [];
        foreach ($rawIds as $rawId) {
            if (is_string($rawId) && ctype_digit($rawId)) {
                $id = (int) $rawId;
            } elseif (is_int($rawId)) {
                $id = $rawId;
            } else {
                continue;
            }

            if ($id > 0) {
                $ids[] = $id;
            }
        }

        return $this->uniqueSorted($ids);
    }

    /**
     * @param list<int> $ids
     * @return list<int>
     */
    private function uniqueSorted(array $ids): array
    {
        $ids = array_values(array_unique($ids));
        sort($ids);

        return $ids;
    }

    private function formatDeleteError(\Throwable $e): string
    {
        // Keep message short & user-friendly; avoid leaking SQL.
        $message = $e->getMessage();
        if ($message === '') {
            return 'Erreur lors de la suppression';
        }

        // Truncate to avoid huge DBAL messages.
        if (\function_exists('mb_substr')) {
            $message = mb_substr($message, 0, 200);
        } else {
            $message = substr($message, 0, 200);
        }

        return $message;
    }
}
