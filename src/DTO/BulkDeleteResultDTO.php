<?php

namespace App\DTO;

final class BulkDeleteResultDTO
{
    /** @var list<int> */
    public array $deletedIds;

    /** @var list<int> */
    public array $notFoundIds;

    /** @var array<int, string> */
    public array $failed;

    /**
     * @param list<int> $deletedIds
     * @param list<int> $notFoundIds
     * @param array<int, string> $failed Map[id => reason]
     */
    public function __construct(array $deletedIds = [], array $notFoundIds = [], array $failed = [])
    {
        $this->deletedIds = $deletedIds;
        $this->notFoundIds = $notFoundIds;
        $this->failed = $failed;
    }

    public function deletedCount(): int
    {
        return \count($this->deletedIds);
    }

    public function notFoundCount(): int
    {
        return \count($this->notFoundIds);
    }

    public function failedCount(): int
    {
        return \count($this->failed);
    }

    public function requestedCount(): int
    {
        return $this->deletedCount() + $this->notFoundCount() + $this->failedCount();
    }
}
