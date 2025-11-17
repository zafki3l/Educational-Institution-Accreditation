<?php

namespace App\Http\Controllers;

use App\Http\Requests\MilestoneRequest;
use App\Models\User;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\MilestoneServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class MilestoneController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private MilestoneRequest $milestoneRequest,
                                private CriteriaServiceInterface $criteriaService,
                                private MilestoneServiceInterface $milestoneService) {}
    public function index()
    {
        $criterias = $this->criteriaService->findAll();

        $role = $_SESSION['user']['role_id'];
        $redirect_to = User::isAdmin($role) ? 'admin' : 'staff';

        return $this->view(
            (string) $redirect_to . '/milestones/index', 
            (string) $redirect_to .'.layouts', 
            [
                'title' => User::isAdmin($role) ? 'Cập nhật tiêu chí' : 'Danh sách tiêu chí',
                'criterias' => $criterias
            ]
        );
    }

    public function getMilestonesByCriteria(string $criteria_id): mixed
    {
        $search = null;
        $milestones = $this->milestoneService->listMilestone($search, $criteria_id);
        
        $role = $_SESSION['user']['role_id'];
        $redirect_to = User::isAdmin($role) ? 'admin' : 'staff';

        return $this->view(
            (string) $redirect_to . '/milestones/listMilestones', 
            (string) $redirect_to .'.layouts', 
            [
                'title' => User::isAdmin($role) ? 'Cập nhật tiêu chí' : 'Danh sách tiêu chí',
                'milestones' => $milestones,
                'criteria_id' => $criteria_id
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