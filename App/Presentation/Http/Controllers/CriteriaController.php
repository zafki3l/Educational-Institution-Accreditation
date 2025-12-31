<?php 
namespace App\Presentation\Http\Controllers;

use App\Business\Facades\CriteriaFacade;
use App\Business\Facades\DepartmentFacade;
use App\Presentation\Http\Requests\Criteria\CreateCriteriaRequest;
use App\Domain\Entities\Models\User;
use App\Business\Facades\StandardFacade;
use Core\Controller;
use Traits\HttpResponseTrait;

class CriteriaController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private CriteriaFacade $criteriaService,
                                private StandardFacade $standardService,
                                private DepartmentFacade $departmentService) {}

    public function index(): mixed
    {
        $filter = [
            'standard_id' => $_GET['standard_id'] ?? null,
            'department_id' => $_GET['department_id'] ?? null
        ];

        $role = $_SESSION['user']['role_id'];
        $viewPrefix = User::isAdmin($role) ? 'admin' : 'staff';
        
        $search = $_GET['search'] ?? null;
        
        return $this->view(
            (string) $viewPrefix . '/criterias/index', 
            (string) $viewPrefix .'.layouts', 
            [
                'title' => User::isAdmin($role) ? 'Cập nhật tiêu chí' : 'Danh sách tiêu chí',
                'departments' => $this->departmentService->findAll(),
                'standards' => $this->standardService->findAll(),
                'criterias' => $this->criteriaService->list($search, $filter)->toArray()
            ]
        );
    }

    public function create(): mixed
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
        $request = new CreateCriteriaRequest($_POST);

        $this->criteriaService->create($request);

        $this->redirect('/admin/criterias');
    }

    public function destroy(string $id): void
    {
        $this->criteriaService->delete($id);

        $this->redirect('/admin/criterias');
    }
}