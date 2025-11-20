<?php

namespace App\Http\Controllers;

use App\Http\Requests\MilestoneRequest;
use App\Models\User;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\MilestoneServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class MilestoneController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private MilestoneRequest $milestoneRequest,
                                private StandardServiceInterface $standardService,
                                private CriteriaServiceInterface $criteriaService,
                                private MilestoneServiceInterface $milestoneService) {}
                                
    public function index()
    {
        $standard_id = $_GET['standard_id'] ?? null;
        $criteria_id = $_GET['criteria_id'] ?? null;
        $search = $_GET['search'] ?? null;

        $milestones = $this->milestoneService->listMilestones($search, $standard_id, $criteria_id);
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
        $request = $this->milestoneRequest->createMilestone();

        $this->milestoneService->createMilestone($request);

        $this->redirect('/admin/milestones');
    }

    public function destroy(string $milestone_id): void
    {
        $this->milestoneService->deleteMilestone($milestone_id);

        $this->redirect('/admin/milestones');
    }
}