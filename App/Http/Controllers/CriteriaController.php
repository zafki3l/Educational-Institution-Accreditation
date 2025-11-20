<?php 
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\CriteriaRequest;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\DepartmentServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class CriteriaController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private CriteriaRequest $criteriaRequest, 
                                private CriteriaServiceInterface $criteriaService,
                                private StandardServiceInterface $standardService,
                                private DepartmentServiceInterface $departmentService) {}

    public function index(): mixed
    {
        $role = $_SESSION['user']['role_id'];
        $viewPrefix = User::isAdmin($role) ? 'admin' : 'staff';
        
        $standard_id = $_GET['standard_id'] ?? null;
        $search = $_GET['search'] ?? null;
        
        return $this->view(
            (string) $viewPrefix . '/criterias/index', 
            (string) $viewPrefix .'.layouts', 
            [
                'title' => User::isAdmin($role) ? 'Cập nhật tiêu chí' : 'Danh sách tiêu chí',
                'standards' => $this->standardService->findAll(),
                'criterias' => $this->criteriaService->listCriterias($search, $standard_id)
            ]
        );
    }

    public function create()
    {
        $standards = $this->standardService->findAll();
        $departments = $this->departmentService->findAll();
        
        return $this->view(
            'admin/criterias/create',
            'admin.layouts',
            [
                'title' => 'Thêm tiêu chí',
                'standards' => $standards,
                'departments' => $departments
            ]
        );
    }

    public function store(): void
    {
        $request = $this->criteriaRequest->createRequest();

        $this->criteriaService->createCriteria($request);

        $this->redirect('/admin/criterias');
    }

    public function destroy(string $id): void
    {
        $this->criteriaService->deleteCriteria($id);

        $this->redirect('/admin/criterias');
    }
}