<?php 

namespace App\Http\Requests;

class CriteriaRequest
{
    public function createRequest(): array
    {
        return [
            'id' => trim($_POST['id']),
            'standard_id' => trim($_POST['standard_id']),  
            'name' => trim($_POST['name']),
        ];
    }
}