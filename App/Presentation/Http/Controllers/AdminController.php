<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Modules\Criteria\CriteriaFacade;
use App\Business\Modules\Evidence\EvidenceFacade;
use App\Business\Modules\Milestone\MilestoneFacade;
use App\Business\Modules\Standard\StandardFacade;
use App\Business\Modules\User\UserFacade;
use App\Presentation\Http\Traits\HttpResponse;
use Core\Controller;

/**
 * Class Admin Controller
 */
class AdminController extends Controller
{
    use HttpResponse;

    public function __construct(
        private UserFacade $userService,
        private StandardFacade $standardService,
        private CriteriaFacade $criteriaService,
        private MilestoneFacade $milestoneService,
        private EvidenceFacade $evidenceService
    ) {}

    public function dashboard(): mixed
    {
        $users = $this->userService->count();
        $standards = $this->standardService->count();
        $criterias = $this->criteriaService->count();
        $milestones = $this->milestoneService->count();
        $evidences = $this->evidenceService->count();

        return $this->view(
            'admin/dashboard/main',
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
