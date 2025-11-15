<?php 

namespace App\Http\Controllers;

use App\Http\Requests\StandardRequest;
use App\Services\Interfaces\StandardServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class StandardController extends Controller
{
    use HttpResponseTrait;
    public function __construct(private StandardServiceInterface $standardService,
                                private StandardRequest $standardRequest) {}
    public function index()
    {
        $standards = $this->standardService->listStandards();

        return $this->view(
            'admin/standards/index', 
            'admin.layouts', 
            [
                'title' => 'Cập nhật tiêu chuẩn',
                'standards' => $standards
            ]
        );
    }

    public function store(): void
    {
        $request = $this->standardRequest->createRequest();

        $this->standardService->createStandard($request);

        $this->redirect('/admin/standards');
    }

    public function destroy(string $id): void
    {
        $this->standardService->deleteStandard($id);
        
        $this->redirect('/admin/standards');
    }
}