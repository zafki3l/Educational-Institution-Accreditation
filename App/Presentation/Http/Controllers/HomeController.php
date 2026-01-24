<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Modules\Criteria\CriteriaFacade;
use App\Business\Modules\Evidence\EvidenceFacade;
use App\Business\Modules\Standard\StandardFacade;
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
        $isAuth = isset($_SESSION['user']);
        return $this->view(
            'homepage/main',
            'homepage.layouts',
            [
                'isAuth' => $isAuth,
                'title' => 'Trang chủ'
            ]
        );
    }

    public function evidenceList(): mixed
    {
        $standards = $this->standardService->findAll();
        $criteriaByStandard = $this->criteriaService->groupCriteriaWithStandard();
        $evidenceByCriteria = $this->evidenceService->groupByCriteria();

        return $this->view(
            'find_evidence/main',
            'homepage.layouts',
            [
                'title' => 'Homepage',
                'standards' => $standards->toArray(),
                'criteriaByStandard' => $criteriaByStandard,
                'evidenceByCriteria' => $evidenceByCriteria
            ]
        );
    }

    public function showEvidence(string $link): mixed
    {
        $standards = $this->standardService->findAll();
        $criteriaByStandard = $this->criteriaService->groupCriteriaWithStandard();
        $evidenceByCriteria = $this->evidenceService->groupByCriteria();

        return $this->view(
            'find_evidence/show',
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
