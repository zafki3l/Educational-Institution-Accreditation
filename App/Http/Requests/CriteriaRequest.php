<?php 

namespace App\Http\Requests;

class CriteriaRequest
{
    public function createRequest(): array
    {
        return [
            'criteria_id' => trim($_POST['criteria_id']),
            'criteria_name' => trim($_POST['criteria_name']),
            'standard_id' => trim($_POST['standard_id']),  
            'created_at' => trim($_POST['created_at']),
            'updated_at' => trim($_POST['updated_at'])
        ];
    }

    public function updateRequest(): array
    {
        return [
            'criteria_id' => trim($_POST['criteria_id']),
            'criteria_name' => trim($_POST['criteria_name']),
            'standard_id' => trim($_POST['standard_id']),  
            'created_at' => trim($_POST['created_at']),
            'updated_at' => trim($_POST['updated_at'])
        ];
    }
}