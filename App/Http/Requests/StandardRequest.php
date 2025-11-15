<?php 

namespace App\Http\Requests;

class StandardRequest
{
    public function createRequest(): array
    {
        return [
            'id' => trim($_POST['id']),
            'name' => trim($_POST['name'])
        ];
    }
}