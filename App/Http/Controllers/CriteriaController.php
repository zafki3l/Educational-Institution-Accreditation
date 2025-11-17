<?php 
namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\User;
use App\Http\Requests\CriteriaRequest;
use App\Services\Interfaces\CriteriaServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class CriteriaController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private CriteriaRequest $criteriaRequest, 
                                private CriteriaServiceInterface $criteriaService){}

    public function index(): mixed
    {
        $search = $_GET['search'] ?? null;

        $criterias = $this->criteriaService->listCriterias($search);

        $role = $_SESSION['user']['role_id'];
        $redirect_to = User::isAdmin($role) ? 'admin' : 'staff';

        return $this->view(
            (string) $redirect_to . '/criterias/index', 
            (string) $redirect_to .'.layouts', 
            [
                'title' => User::isAdmin($role) ? 'Cập nhật tiêu chí' : 'Danh sách tiêu chí',
                'criterias' => $criterias
            ]
        );
    }

    public function create()
    {
        return $this->view(
            'admin/criterias/create',
            'admin.layouts',
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