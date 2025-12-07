<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\EvidenceServiceInterface;
use App\Services\Interfaces\MilestoneServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

/**
 * Class Admin Controller
 */
class AdminController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private UserServiceInterface $userService,
                                private StandardServiceInterface $standardService,
                                private CriteriaServiceInterface $criteriaService,
                                private MilestoneServiceInterface $milestoneService,
                                private EvidenceServiceInterface $evidenceService) {}

    public function dashboard(): mixed
    {
        $users = $this->userService->count();
        $standards = $this->standardService->count();
        $criterias = $this->criteriaService->count();
        $milestones = $this->milestoneService->count();
        $evidences = $this->evidenceService->count();

        return $this->view(
            'admin/dashboard',
            'admin.layouts',
            [
                'title' => 'Admin Dashboard',
                'users' => $users,
                'standards' => $standards,
                'criterias' => $criterias,
                'milestones' => $milestones,
                'evidences' => $evidences
            ]
        );
    }
}
