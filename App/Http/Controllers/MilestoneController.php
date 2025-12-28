<?php

namespace App\Http\Controllers;

use App\Http\Requests\Milestone\CreateMilestoneRequest;
use App\Domain\Entities\Models\User;
use App\Services\Implementations\Criteria\CriteriaService;
use App\Services\Implementations\Milestone\MilestoneService;
use App\Services\Implementations\Standard\Facade\StandardFacade;
use Core\Controller;
use Traits\HttpResponseTrait;

class MilestoneController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private StandardFacade $standardService,
                                private CriteriaService $criteriaService,
                                private MilestoneService $milestoneService) {}
                                
    public function index()
    {
        $filter = [
            'standard_id' => $_GET['standard_id'] ?? null,
            'criteria_id' => $_GET['criteria_id'] ?? null
        ];

        $search = $_GET['search'] ?? null;

        $milestones = $this->milestoneService->list($search, $filter);

        $standards = $this->standardService->findAll();
        $criterias = $this->criteriaService->findAll();

        $role = $_SESSION['user']['role_id'];
        $viewPrefix = User::isAdmin($role) ? 'admin' : 'staff';

        return $this->view(
            (string) $viewPrefix . '/milestones/index', 
            (string) $viewPrefix .'.layouts', 
            [
                'title' => User::isAdmin($role) ? 'Cập nhật tiêu chí' : 'Danh sách tiêu chí',
                'criterias' => $criterias,
                'standards' => $standards,
                'milestones' => $milestones
            ]
        );
    }

    public function create()
    {
        $criterias = $this->criteriaService->findAll();
        
        return $this->view(
            'admin/milestones/create',
            'admin.layouts',
            [
                'title' => 'Thêm mốc đánh giá',
                'criterias' => $criterias,
            ]
        );
    }

    public function store(): void
    {
        $request = new CreateMilestoneRequest($_POST);

        $this->milestoneService->create($request);

        $this->redirect('/admin/milestones');
    }

    public function destroy(string $milestone_id): void
    {
        $this->milestoneService->delete($milestone_id);

        $this->redirect('/admin/milestones');
    }
}