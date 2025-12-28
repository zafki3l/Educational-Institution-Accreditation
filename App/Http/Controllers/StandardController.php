<?php 

namespace App\Http\Controllers;

use App\Http\Requests\Standard\CreateStandardRequest;
use App\Domain\Entities\Models\User;
use App\Services\Implementations\Department\DepartmentService;
use App\Services\Implementations\Standard\Facade\StandardFacade;
use Core\Controller;
use Traits\HttpResponseTrait;

class StandardController extends Controller
{
    use HttpResponseTrait;
    public function __construct(private StandardFacade $standardService,
                                private DepartmentService $departmentService) {}

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