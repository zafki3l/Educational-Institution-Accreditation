<?php

namespace App\Business\Queries;

use App\Business\Ports\EvidenceRepositoryInterface;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByIdDTO;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceCollectionDTO;
use App\Domain\Exceptions\EvidenceException\EvidenceNotFoundException;
use App\Mappers\Evidence\EvidenceDTOMapper;
use App\Mappers\Evidence\ItemMappers\EvidenceItemType;

/**
 * Application service responsible for querying evidence's data
 */
class EvidenceQuery
{
    public function __construct(private EvidenceRepositoryInterface $repository,
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

    public function findOrFail(string $id): EvidenceByIdDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new EvidenceNotFoundException($id);
        }

        return $this->dtoMapper->mapOne($found[0], EvidenceItemType::BY_ID);
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