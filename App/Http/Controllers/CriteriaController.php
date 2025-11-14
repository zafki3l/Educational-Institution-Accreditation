<?php 
namespace App\Http\Controllers;

use App\Database\Models\Criteria;
use App\Http\Requests\CriteriaRequest;
use App\Services\Interfaces\CriteriaServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class CriteriaController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private CriteriaRequest $criteriaRequest, 
                                private CriteriaServiceInterface $criteriaService){}

     public function index()
    {
        $search = $_GET['search'] ?? null;

        $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $data = $this->criteriaService->listCriterias($search, $current_page);

        return $this->view(
            'staff/criterias/index',
            'staff.layouts',
            [
                'title' => 'QUẢN LÝ TIÊU CHÍ',
                'criterias' => $data['criterias'],
                'current_page' => $data['current_page'],
                'total_pages' => $data['total_pages'],
                'result_per_page' => $data['result_per_page']
            ]
        );
    }
}
?>