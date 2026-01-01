<?php 

namespace App\Presentation\Http\Controllers;

use App\Business\Facades\DepartmentFacade;
use App\Presentation\Http\Requests\Standard\CreateStandardRequest;
use App\Domain\Entities\Models\User;
use App\Business\Facades\StandardFacade;
use App\Presentation\Http\Traits\HttpResponse;
use Core\Controller;

class StandardController extends Controller
{
    use HttpResponse;
    public function __construct(private StandardFacade $standardService,
                                private DepartmentFacade $departmentService) {}

    public function index()
    {
        $standards = $this->standardService->list();
        $departments = $this->departmentService->findAll();

        $role = $_SESSION['user']['role_id'];
        $viewPrefix = User::isAdmin($role) ? 'admin' : 'staff';
        
        return $this->view(
            (string) $viewPrefix . '/standards/index', 
            (string) $viewPrefix .'.layouts', 
            [
                'title' => User::isAdmin($role) ? 'Cập nhật tiêu chuẩn' : 'Danh sách tiêu chuẩn',
                'standards' => $standards,
                'departments' => $departments
            ]
        );
    }

    public function store(): void
    {
        $request = new CreateStandardRequest($_POST);

        $this->standardService->create($request);

        $this->redirect('/admin/standards');
    }

    public function destroy(string $id): void
    {
        $this->standardService->delete($id);

        $this->redirect('/admin/standards');
    }
}