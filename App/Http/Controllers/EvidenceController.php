<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvidenceRequest;
use App\Models\Evidence;
use Core\Controller;
use Core\Paginator;
use Traits\HttpResponseTrait;

class EvidenceController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private Evidence $evidence) {}

    public function index()
    {
        $evidence = $this->evidence;

        $isSearching = isset($_GET['search']);
        $search = $isSearching ? $_GET['search'] : null;

        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $total_records = $isSearching ? $evidence->countSearchEvidence() : $evidence->countAllEvidence();

        $pagination = Paginator::paginate($total_records, Paginator::RESULT_PER_PAGE, $current_page); // Calculate the total pages and the start page

        $evidences = $isSearching ? $evidence->searchEvidence($search, $pagination['start_from'], Paginator::RESULT_PER_PAGE) : $evidence->getAllEvidence($pagination['start_from'], Paginator::RESULT_PER_PAGE);

        return $this->view(
            'staff/evidences/index',
            'staff.layouts',
            [
                'title' => 'QUẢN LÝ MINH CHỨNG',
                'evidences' => $evidences,
                'current_page' => $current_page,
                'total_pages' => $pagination['total_pages'],
                'result_per_page' => Paginator::RESULT_PER_PAGE
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

    public function store(EvidenceRequest $evidenceRequest = new EvidenceRequest()): void
    {
        $evidence = $this->evidence;

        $request = $evidenceRequest->createRequest();

        $evidence->setId($request['evidence_id']);
        $evidence->setName($request['evidence_name']);
        $evidence->setMilestoneId($request['milestone_id']);
        $evidence->setDecision($request['decision']);
        $evidence->setDocumentDate($request['document_date']);
        $evidence->setIssuePlace($request['issue_place']);
        $evidence->setLink($request['link']);

        $evidence->createEvidence();

        $this->redirect('/staff/evidences');
    }

    public function edit(string $evidence_id)
    {
        $evidence = $this->evidence->getEvidenceById($evidence_id);

        return $this->view(
            'staff/evidences/edit',
            'staff.layouts',
            [
                'title' => 'Chỉnh sửa minh chứng',
                'evidence' => $evidence
            ]
        );
    }

    public function update(string $evidence_id)
    {
        // TODO:
    }

    public function destroy(string $evidence_id)
    {
        // TODO:
    }
}