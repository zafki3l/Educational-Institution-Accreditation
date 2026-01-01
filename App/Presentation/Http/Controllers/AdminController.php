<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Facades\CriteriaFacade;
use App\Business\Facades\EvidenceFacade;
use App\Business\Facades\MilestoneFacade;
use App\Business\Facades\StandardFacade;
use App\Business\Facades\UserFacade;
use App\Presentation\Http\Traits\HttpResponse;
use Core\Controller;

/**
 * Class Admin Controller
 */
class AdminController extends Controller
{
    use HttpResponse;

    public function __construct(private UserFacade $userService,
                                private StandardFacade $standardService,
                                private CriteriaFacade $criteriaService,
                                private MilestoneFacade $milestoneService,
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
