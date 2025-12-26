<?php

namespace App\Http\Controllers;

use App\Services\Implementations\Criteria\CriteriaService;
use App\Services\Implementations\Evidence\Facade\EvidenceFacade;
use App\Services\Implementations\Milestone\MilestoneService;
use App\Services\Implementations\Standard\StandardService;
use App\Services\Implementations\User\Facade\UserFacade;
use Core\Controller;
use Traits\HttpResponseTrait;

/**
 * Class Admin Controller
 */
class AdminController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private UserFacade $userService,
                                private StandardService $standardService,
                                private CriteriaService $criteriaService,
                                private MilestoneService $milestoneService,
                                private EvidenceFacade $evidenceService) {}

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
