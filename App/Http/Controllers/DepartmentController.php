<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Core\Controller;
use Traits\HttpResponseTrait;

class DepartmentController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private Department $department){}
	
    public function index()
    {
        return $this->view(
            'admin/departments/index',
            'admin.layouts',
            [
                'title' => 'Quản lý phòng ban',
                'departments' => $this->department->getAllDepartment()
            ]
        );
    }
}