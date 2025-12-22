<?php

namespace App\Services\Implementations\Evidence\Query;

use App\Entities\DataTransferObjects\EvidenceDTO\EvidenceCollectionDTO;
use App\Exceptions\EvidenceException\EvidenceNotFoundException;
use App\Repositories\Sql\Implementations\Evidence\MySqlEvidenceRepository;
use App\Services\Implementations\Evidence\Mapping\EvidenceDTOMapper;
use App\Services\Implementations\Evidence\Mapping\ItemMappers\EvidenceItemType;

/**
 * Application service responsible for querying evidence's data
 */
class EvidenceQuery
{
    public function __construct(private MySqlEvidenceRepository $repository,
                                private EvidenceDTOMapper $dtoMapper) {}

    public function findAll(int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        $evidences = $this->repository->all($start_from, $result_per_page);

        return $this->dtoMapper->map($evidences, EvidenceItemType::LIST);
    }

    public function find(string $search, int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        $evidences = $this->repository->search($search, $start_from, $result_per_page);

        return $this->dtoMapper->map($evidences, EvidenceItemType::LIST);
    }

    public function findAllWithoutMilestone(): EvidenceCollectionDTO
    {
        $evidences = $this->repository->evidenceWithoutMilestone();

        return $this->dtoMapper->map($evidences, EvidenceItemType::WITHOUT_MILESTONE);
    }

    public function filterEvidences(int $start_from, int $result_per_page, array $filter): EvidenceCollectionDTO
    {
        $evidences = $this->repository->filter($start_from, $result_per_page, $filter);

        return $this->dtoMapper->map($evidences, EvidenceItemType::LIST);
    }

    public function findOrFail(string $id): EvidenceCollectionDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new EvidenceNotFoundException($id);
        }

        return $this->dtoMapper->map($found, EvidenceItemType::BY_ID);
    }

    public function evidenceByMilestone(string $id): EvidenceCollectionDTO
    {
        $evidences = $this->repository->evidenceManyToManyMilestone($id);

        if (!$evidences) {
            throw new EvidenceNotFoundException($id);
        }

        return $this->dtoMapper->map($evidences, EvidenceItemType::BY_MILESTONE);
    }

    public function count(?string $search = null): int
    {
        return $search 
            ? $this->repository->countSearch($search) 
            : $this->repository->countAll();
    }
}