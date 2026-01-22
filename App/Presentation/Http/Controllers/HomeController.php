<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Facades\CriteriaFacade;
use App\Business\Facades\EvidenceFacade;
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
        private EvidenceFacade $evidenceService
    ) {}
    public function index(): mixed
    {
        $standards = $this->standardService->findAll();
        $criteriaByStandard = $this->criteriaService->groupCriteriaWithStandard();
        $evidenceByCriteria = $this->evidenceService->groupByCriteria();

        return $this->view(
            'homepage/main',
            'homepage.layouts',
            [
                'title' => 'Homepage',
                'standards' => $standards->toArray(),
                'criteriaByStandard' => $criteriaByStandard,
                'evidenceByCriteria' => $evidenceByCriteria
            ]
        );
    }

    public function show2(string $link): mixed
    {
        $standards = $this->standardService->findAll();
        $criteriaByStandard = $this->criteriaService->groupCriteriaWithStandard();
        $evidenceByCriteria = $this->evidenceService->groupByCriteria();

        return $this->view(
            'homepage/show',
            'homepage.layouts',
            [
                'link' => $link,
                'standards' => $standards->toArray(),
                'criteriaByStandard' => $criteriaByStandard,
                'evidenceByCriteria' => $evidenceByCriteria
            ]
        );
    }
}
