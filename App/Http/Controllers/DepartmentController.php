<?php

namespace App\Http\Controllers;

use App\Services\Implementations\Department\DepartmentService;
use Core\Controller;
use Traits\HttpResponseTrait;

class DepartmentController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private DepartmentService $departmentService) {}
	
    public function index()
    {
        return $this->view(
            'admin/departments/index',
            'admin.layouts',
            [
                'title' => 'Quản lý phòng ban',
                'departments' => $this->departmentService->findAll()
            ]
        );
    }
}