<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use App\Services\Interfaces\DepartmentServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class DepartmentController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private DepartmentServiceInterface $departmentService){}
	
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