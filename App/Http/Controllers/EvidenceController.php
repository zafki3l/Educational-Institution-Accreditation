<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvidenceRequest;
use App\Services\Interfaces\EvidenceServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class EvidenceController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private EvidenceRequest $evidenceRequest,
                                private EvidenceServiceInterface $evidenceService) {}

    public function index()
    {
        $search = $_GET['search'] ?? null;

        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $data = $this->evidenceService->listEvidences($search, $current_page);

        return $this->view(
            'staff/evidences/index',
            'staff.layouts',
            [
                'title' => 'QUẢN LÝ MINH CHỨNG',
                'evidences' => $data['evidences'],
                'current_page' => $data['current_page'],
                'total_pages' => $data['total_pages'],
                'result_per_page' => $data['result_per_page']
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

        $this->evidenceService->createEvidence($request);

        $this->redirect('/taff/evidences');
    }

    public function edit(string $evidence_id)
    {
        return $this->view(
            'staff/evidences/edit',
            'staff.layouts',
            [
                'title' => 'Chỉnh sửa minh chứng',
                'evidence' => $this->evidenceService->getEvidenceById($evidence_id)
            ]
        );
    }

    public function update(string $evidence_id)
    {
        $request = $this->evidenceRequest->updateRequest();
        
        $this->evidenceService->updateEvidence($evidence_id, $request);

        $this->redirect('/staff/evidences');
    }

    public function destroy(string $evidence_id)
    {
        $this->evidenceService->deleteEvidence($evidence_id);

        $this->redirect('/staff/evidences');
    }

    public function criterias(string $evidence_id)
    {
        // TODO
    }
}