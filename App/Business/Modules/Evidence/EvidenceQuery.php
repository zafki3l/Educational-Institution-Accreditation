<?php

namespace App\Business\Modules\Evidence;

use App\Business\Modules\Evidence\Evidence\EvidenceDTOMapper;
use App\Business\Modules\Evidence\Evidence\ItemMappers\EvidenceItemType;
use App\Business\Ports\EvidenceRepositoryInterface;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceByIdDTO;
use App\Domain\Entities\DataTransferObjects\EvidenceDTO\EvidenceCollectionDTO;
use App\Domain\Exceptions\EvidenceException\EvidenceNotFoundException;

/**
 * Application service responsible for querying evidence's data
 */
class EvidenceQuery
{
    public function __construct(
        private EvidenceRepositoryInterface $repository,
        private EvidenceDTOMapper $dtoMapper
    ) {}

    /**
     * @param int $start_from
     * @param int $result_per_page
     * @return EvidenceCollectionDTO
     */
    public function findAll(int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        $evidences = $this->repository->all($start_from, $result_per_page);

        return $this->dtoMapper->map($evidences, EvidenceItemType::LIST);
    }

    /**
     * @param string $search
     * @param int $start_from
     * @param int $result_per_page
     * @return EvidenceCollectionDTO
     */
    public function find(string $search, int $start_from, int $result_per_page): EvidenceCollectionDTO
    {
        $evidences = $this->repository->search($search, $start_from, $result_per_page);

        return $this->dtoMapper->map($evidences, EvidenceItemType::LIST);
    }

    /**
     * @return EvidenceCollectionDTO
     */
    public function findAllWithoutMilestone(): EvidenceCollectionDTO
    {
        $evidences = $this->repository->evidenceWithoutMilestone();

        return $this->dtoMapper->map($evidences, EvidenceItemType::WITHOUT_MILESTONE);
    }

    /**
     * @param int $start_from
     * @param int $result_per_page
     * @param array $filter
     * @return EvidenceCollectionDTO
     */
    public function filterEvidences(int $start_from, int $result_per_page, array $filter): EvidenceCollectionDTO
    {
        $evidences = $this->repository->filter($start_from, $result_per_page, $filter);

        return $this->dtoMapper->map($evidences, EvidenceItemType::LIST);
    }

    /**
     * @param string $id
     * @throws EvidenceNotFoundException
     * @return \App\Domain\Entities\DataTransferObjects\EvidenceDTO\BaseEvidenceDTO
     */
    public function findOrFail(string $id): EvidenceByIdDTO
    {
        $found = $this->repository->findById($id);

        if (!$found) {
            throw new EvidenceNotFoundException($id);
        }

        return $this->dtoMapper->mapOne($found[0], EvidenceItemType::BY_ID);
    }

    /**
     * @param string $id
     * @throws EvidenceNotFoundException
     * @return EvidenceCollectionDTO
     */
    public function evidenceByMilestone(string $id): EvidenceCollectionDTO
    {
        $evidences = $this->repository->evidenceManyToManyMilestone($id);

        if (!$evidences) {
            throw new EvidenceNotFoundException($id);
        }

        return $this->dtoMapper->map($evidences, EvidenceItemType::BY_MILESTONE);
    }

    /**
     * @param mixed $search
     * @return int
     */
    public function count(?string $search = null): int
    {
        return $search
            ? $this->repository->countSearch($search)
            : $this->repository->countAll();
    }

    /**
     * @return EvidenceCollectionDTO
     */
    public function byCriteria(): EvidenceCollectionDTO
    {
        $evidences = $this->repository->byCriteria();

        return $this->dtoMapper->map($evidences, EvidenceItemType::BY_CRITERIA);
    }
}
