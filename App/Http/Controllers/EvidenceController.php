<?php

namespace App\Http\Controllers;

use App\Http\Requests\Evidence\AddMilestoneRequest;
use App\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Http\Requests\Evidence\UpdateEvidenceRequest;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\Evidence\EvidenceFacadeServiceInterface;
use App\Services\Interfaces\MilestoneServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class EvidenceController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private EvidenceFacadeServiceInterface $evidenceService,
                                private StandardServiceInterface $standardService,
                                private CriteriaServiceInterface $criteriaService,
                                private MilestoneServiceInterface $milestoneService) {}

    public function index()
    {
        $filter = [
            'standard_id' => $_GET['standard_id'] ?? null,
            'criteria_id' => $_GET['criteria_id'] ?? null,
            'milestone_id' => $_GET['milestone_id'] ?? null
        ];

        $search = $_GET['search'] ?? null;

        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $data = $this->evidenceService->list($search, $current_page, $filter);

        $evidences = $data['evidences'];
        $evidencesWithoutMilestone = $this->evidenceService->findAllWithoutMilestone();

        return $this->view(
            'staff/evidences/index',
            'staff.layouts',
            [
                'title' => 'QUẢN LÝ MINH CHỨNG',
                'evidences' => $evidences->toArray(),
                'current_page' => $data['current_page'],
                'total_pages' => $data['total_pages'],
                'result_per_page' => $data['result_per_page'],
                'standards' => $this->standardService->findAll(),
                'criterias' => $this->criteriaService->findAll(),
                'milestones' => $this->milestoneService->findAll(),
                'evidencesWithoutMilestone' => $evidencesWithoutMilestone
            ]
        );
    }

    public function create()
    {
        return $this->view(
            'staff/evidences/add',
            'staff.layouts',
            [
                'title' => 'Thêm minh chứng'
            ]
        );
    }

    public function store(): void
    {
        $request = new CreateEvidenceRequest($_POST);

        $this->evidenceService->create($request);

        $this->redirect('/staff/evidences');
    }

    public function edit(string $evidence_id): mixed
    {
        $evidences = $this->evidenceService->findOrFail($evidence_id);
        
        return $this->view(
            'staff/evidences/edit',
            'staff.layouts',
            [
                'title' => 'Chỉnh sửa minh chứng',
                'evidence' => $evidences->toArray()
            ]
        );
    }

    public function update(string $evidence_id): void
    {
        $request = new UpdateEvidenceRequest($_POST);

        $this->evidenceService->update($evidence_id, $request);

        $this->redirect('/staff/evidences');
    }

    public function destroy(string $evidence_id): void
    {
        $this->evidenceService->delete($evidence_id);

        $this->redirect('/staff/evidences');
    }

    public function show(string $link): mixed
    {
        return $this->view(
            'staff/evidences/show',
            'staff.layouts',
            ['link' => $link]
        );
    }

    public function milestones(string $evidence_id): mixed
    {
        $evidences = $this->evidenceService->evidenceByMilestone($evidence_id);
        $milestones = $this->milestoneService->findAll();

        return $this->view(
            'staff/evidences/milestones',
            'staff.layouts',
            [
                'evidences' => $evidences->toArray(),
                'evidence_id' => $evidence_id,
                'milestones' => $milestones
            ]
        );
    }

    public function storeMilestones(string $evidence_id): void
    {
        $request = new AddMilestoneRequest($_POST);

        $this->evidenceService->addMilestone($evidence_id, $request->getMilestoneId());

        $this->redirect("/staff/evidences/{$evidence_id}/milestones");
    }
}
