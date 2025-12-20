<?php

namespace App\Services\Implementations\Evidence;

use App\DTO\EvidenceDTO\EvidenceCollectionDTO;
use App\Exceptions\EvidenceException\EvidenceNotFoundException;
use App\Repositories\Sql\Interfaces\EvidenceRepositoryInterface;
use App\Services\Interfaces\Evidence\EvidenceDTOMapperServiceInterface;
use App\Services\Interfaces\Evidence\EvidenceQueryServiceInterface;

/**
 * Application service responsible for querying evidence's data
 */
class EvidenceQueryService implements EvidenceQueryServiceInterface
{
    public function __construct(private EvidenceRepositoryInterface $evidenceRepository,
                                private EvidenceDTOMapperServiceInterface $evidenceDTOMapper) {}

    public function findAll(int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        $evidences = $this->evidenceRepository->all($start_from, $result_per_page);

        return $this->evidenceDTOMapper->map($evidences, new EvidenceListItemMapperService());
    }

    public function find(string $search, int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        $evidences = $this->evidenceRepository->search($search, $start_from, $result_per_page);

        return $this->evidenceDTOMapper->map($evidences, new EvidenceListItemMapperService());
    }

    public function findAllWithoutMilestone(): EvidenceCollectionDTO
    {
        $evidences = $this->evidenceRepository->evidenceWithoutMilestone();

        return $this->evidenceDTOMapper->map($evidences, new EvidenceWithoutMilestoneItemMapperService());
    }

    public function filterEvidences(int $start_from, int $result_per_page, array $filter): EvidenceCollectionDTO
    {
        $evidences = $this->evidenceRepository->filter($start_from, $result_per_page, $filter);

        return $this->evidenceDTOMapper->map($evidences, new EvidenceListItemMapperService());
    }

    public function findOrFail(string $id): EvidenceCollectionDTO
    {
        $found = $this->evidenceRepository->findById($id);

        if (!$found) {
            throw new EvidenceNotFoundException($id);
        }

        return $this->evidenceDTOMapper->map($found, new EvidenceByIdItemMapperService());
    }

    public function evidenceByMilestone(string $id): EvidenceCollectionDTO
    {
        $evidences = $this->evidenceRepository->evidenceManyToManyMilestone($id);

        if (!$evidences) {
            throw new EvidenceNotFoundException($id);
        }

        return $this->evidenceDTOMapper->map($evidences, new EvidenceByMilestoneItemMapperService());
    }

    public function count(?string $search = null): int
    {
        return $search 
            ? $this->evidenceRepository->countSearch($search) 
            : $this->evidenceRepository->countAll();
    }
}