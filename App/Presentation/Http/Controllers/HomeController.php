<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Facades\CriteriaFacade;
use App\Business\Facades\MilestoneFacade;
use App\Business\Facades\StandardFacade;
use Core\Controller;

/**
 * Class HomeController
 * Handles Homepage logics
 */
class HomeController extends Controller
{
    public function __construct(
        private StandardFacade $standardService,
        private CriteriaFacade $criteriaService,
        private MilestoneFacade $milestoneService
    ) {}
    public function index(): mixed
    {
        $standards = $this->standardService->findAll();
        $criteriaByStandard = $this->criteriaService->groupCriteriaWithStandard();
        $milestoneByCriteria = $this->milestoneService->groupMilestoneWithCriteria();

        return $this->view(
            'homepage',
            'homepage.layouts',
            [
                'title' => 'Homepage',
                'standards' => $standards->toArray(),
                'criteriaByStandard' => $criteriaByStandard,
                'milestoneByCriteria' => $milestoneByCriteria
            ]
        );
    }
}