<?php 

namespace App\Http\Requests;

class CriteriaRequest
{
    public function createRequest(): array
    {
        return [
            'criteria_id' => trim($_POST['criteria_id']),
            'evidence_name' => trim($_POST['evidence_name']),
            'milestone_id' => trim($_POST['milestone_id']),  
            'decision' => trim($_POST['decision']),
            'document_date' => trim($_POST['document_date']),
            'issue_place' => trim($_POST['issue_place']),
            'link' => trim($_POST['link'])
        ];
    }

    public function updateRequest(): array
    {
        return [
            'evidence_name' => trim($_POST['evidence_name']),
            'milestone_id' => trim($_POST['milestone_id']),  
            'decision' => trim($_POST['decision']),
            'document_date' => trim($_POST['document_date']),
            'issue_place' => trim($_POST['issue_place']),
            'link' => trim($_POST['link'])
        ];
    }
}