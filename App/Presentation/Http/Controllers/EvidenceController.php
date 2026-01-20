<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Facades\CriteriaFacade;
use App\Business\Facades\EvidenceFacade;
use App\Business\Facades\MilestoneFacade;
use App\Presentation\Http\Requests\Evidence\AddMilestoneRequest;
use App\Presentation\Http\Requests\Evidence\CreateEvidenceRequest;
use App\Presentation\Http\Requests\Evidence\UpdateEvidenceRequest;
use App\Business\Facades\StandardFacade;
use App\Presentation\Http\Traits\HttpResponse;
use Core\Controller;

class EvidenceController extends Controller
{
    use HttpResponse;

    public function __construct(
        private EvidenceFacade $evidenceFacade,
        private StandardFacade $standardService,
        private CriteriaFacade $criteriaService,
        private MilestoneFacade $milestoneService
    ) {}

    public function index()
    {
        $filter = [
            'standard_id' => $_GET['standard_id'] ?? null,
            'criteria_id' => $_GET['criteria_id'] ?? null,
            'milestone_id' => $_GET['milestone_id'] ?? null
        ];

        $search = $_GET['search'] ?? null;

        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $data = $this->evidenceFacade->list($search, $current_page, $filter);

        $evidences = $data['evidences'];
        $evidencesWithoutMilestone = $this->evidenceFacade->findAllWithoutMilestone();

        return $this->view(
            'staff/evidences/index',
            'staff.layouts',
            [
                'title' => 'QUẢN LÝ MINH CHỨNG',
                'evidences' => $evidences->toArray(),
                'current_page' => $data['current_page'],
                'total_pages' => $data['total_pages'],
                'result_per_page' => $data['result_per_page'],
                'standards' => $this->standardService->findAll()->toArray(),
                'criterias' => $this->criteriaService->findAll()->toArray(),
                'milestones' => $this->milestoneService->findAll()->toArray(),
                'evidencesWithoutMilestone' => $evidencesWithoutMilestone->toArray()
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

        $this->evidenceFacade->create($request);

        $this->redirect('/staff/evidences');
    }

    public function edit(string $evidence_id): mixed
    {
        $evidences = $this->evidenceFacade->findOrFail($evidence_id);

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

        $this->evidenceFacade->update($evidence_id, $request);

        $this->redirect('/staff/evidences');
    }

    public function destroy(string $evidence_id): void
    {
        $this->evidenceFacade->delete($evidence_id);

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
        $evidences = $this->evidenceFacade->evidenceByMilestone($evidence_id);
        $milestones = $this->milestoneService->findAll()->toArray();

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

        $this->evidenceFacade->addMilestone($evidence_id, $request->getMilestoneId());

        $this->redirect("/staff/evidences/{$evidence_id}/milestones");
    }
}
