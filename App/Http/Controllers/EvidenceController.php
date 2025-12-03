<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvidenceRequest;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\EvidenceServiceInterface;
use App\Services\Interfaces\MilestoneServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class EvidenceController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private EvidenceRequest $evidenceRequest,
                                private EvidenceServiceInterface $evidenceService,
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

        return $this->view(
            'staff/evidences/index',
            'staff.layouts',
            [
                'title' => 'QUẢN LÝ MINH CHỨNG',
                'evidences' => $data['evidences'],
                'current_page' => $data['current_page'],
                'total_pages' => $data['total_pages'],
                'result_per_page' => $data['result_per_page'],
                'standards' => $this->standardService->findAll(),
                'criterias' => $this->criteriaService->findAll(),
                'milestones' => $this->milestoneService->findAll()
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
        $request = $this->evidenceRequest->createRequest();

        $this->evidenceService->create($request);

        $this->redirect('/staff/evidences');
    }

    public function edit(string $evidence_id)
    {
        $evidences = $this->evidenceService->findById($evidence_id);
        
        return $this->view(
            'staff/evidences/edit',
            'staff.layouts',
            [
                'title' => 'Chỉnh sửa minh chứng',
                'evidence' => $evidences
            ]
        );
    }

    public function update(string $evidence_id)
    {
        $request = $this->evidenceRequest->updateRequest();

        $this->evidenceService->update($evidence_id, $request);

        $this->redirect('/staff/evidences');
    }

    public function destroy(string $evidence_id)
    {
        $this->evidenceService->delete($evidence_id);

        $this->redirect('/staff/evidences');
    }

    public function show(string $link)
    {
        return $this->view(
            'staff/evidences/show',
            'staff.layouts',
            ['link' => $link]
        );
    }
}
