<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Facades\DepartmentFacade;
use Core\Controller;
use Traits\HttpResponseTrait;

class DepartmentController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private DepartmentFacade $departmentService) {}
	
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